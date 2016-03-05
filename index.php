<?php
/**
 * Created by PhpStorm.
 * Author: wuxiang
 * Date: 16/2/24
 * Time: 下午11:16
 */

define("DS", DIRECTORY_SEPARATOR);
define("ROOT_PATH", dirname(__FILE__) . DS);

require ROOT_PATH."config/start.ini.php";
require ROOT_PATH."config/serverSet.ini.php";
require ROOT_PATH."config/downLoad.ini.php";

require ROOT_PATH."core/SwooleHttpServer.class.php";
require ROOT_PATH."core/UriAnalysis.class.php";

new SwooleHttpServer($startConfig, $serverSetConfig, $downLoadConfig);

