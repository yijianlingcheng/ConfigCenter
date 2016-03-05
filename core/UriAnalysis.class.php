<?php

/**
 * Created by PhpStorm.
 * Author: wuxiang
 * Date: 16/2/25
 * Time: 上午12:30
 */
class UriAnalysis
{
    public static function run($header = array(), $cookie = array(), $server = array(), $get = array(), $post = array(), $files = array())
    {
        self::getCookieInfo($cookie);
        self::getServerInfo($server);
        self::getHeaderInfo($header);
        self::getGetInfo($get);
        self::getPostInfo($post);
        self::getFilesInfo($files);
        self::getSessionInfo($cookie);

        return true;
    }

    public static function getHeaderInfo($header)
    {
        $_SERVER['HEADER'] = $header;
    }

    public static function getCookieInfo($cookie)
    {
        global $_COOKIE;
        $_COOKIE = $cookie;
    }

    public static function getServerInfo($server)
    {
        global $_SERVER;
        $_SERVER = $server;
    }

    public static function getGetInfo($get)
    {
        global $_GET;
        $_GET = $get;
    }

    public static function getPostInfo($post)
    {
        global $_POST;
        $_POST = $post;
    }

    public static function getFilesInfo($files)
    {
        global $_FILES;
        $_FILES = $files;
    }

    public static function getSessionInfo($cookie)
    {
        global $_SESSION;
        $_SESSION = array($cookie);
    }
}