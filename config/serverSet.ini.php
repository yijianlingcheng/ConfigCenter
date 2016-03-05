<?php
/**
 * Created by PhpStorm.
 * Author: wuxiang
 * Date: 16/2/24
 * Time: 下午11:28
 */
$serverSetConfig = array(
    'worker_num' => 4,
    'daemonize' => false,
    'max_request' => 50000,
    'dispatch_mode' => 3
);

define("HTML_PATH", ROOT_PATH."html".DS);