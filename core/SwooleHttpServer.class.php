<?php

/**
 * Created by PhpStorm.
 * Author: wuxiang
 * Date: 16/2/24
 * Time: 下午10:53
 */
class SwooleHttpServer
{
    private $httpServer;

    private $downLoadConfig = null;

    private $info = null;

    public function __construct($config, $setConfig, $downLoadConfig)
    {
        $this->downLoadConfig = $downLoadConfig;

        $this->httpServer = new swoole_http_server($config['address'], $config['port']);
        $this->httpServer->set($setConfig);

        $this->httpServer->on('Start', array($this, 'onStart'));
        $this->httpServer->on('request' , array( $this , 'onRequest'));
        $this->httpServer->start();
    }


    public function onStart($serv)
    {
        echo "Start\n";
    }

    public function onRequest($request, $response)
    {
        if(isset($request->get['down']) && in_array($request->get['down'], $this->downLoadConfig))
        {
            $this->download($response, ROOT_PATH.$request->get['down'], $request->get['down']);
            if(!is_null($this->info))
            {
                $response->end($this->info);
                $this->info = null;
            }
            else
            {
                $response->status(404);
                $info = "<h1>Not Found!</h1>";
            }
        }
        else
        {
            $list = array('header', 'cookie', 'server', 'get', 'post', 'files');
            foreach($list as $value)
            {
                if(!property_exists($request, $value))
                {
                    $request->{$value} = array();
                }
            }
            $info = UriAnalysis::run($request->header, $request->cookie, $request->server, $request->get, $request->post, $request->files);
            unset($_SERVER);
            unset($_COOKIE);
            unset($_GET);
            unset($_POST);
            unset($_FILES);
            unset($_SESSION);
        }
        $response->end($info);
    }

    public function download($response, $file, $name)
    {
        if(file_exists($file))
        {
            $length = filesize($file);
            $response->header('Content-type', 'application/octet-stream;charset=utf-8');
            $response->header('Accept-Ranges', 'bytes');
            $response->header('Accept-Length', $length);
            $response->header('Content-Disposition', 'attachment; filename='.$name);
            $this->info = file_get_contents($file);
        }
    }
}