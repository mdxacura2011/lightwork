<?php
session_start();
$dir_name = str_replace('\\', '/', dirname(__FILE__));
define('ROOT', $dir_name);
define('QUANTITY_NEWS', 2);

function __autoload($c) {
    switch($c) {
        case (file_exists(ROOT . '/controller/'.$c.'.php')):
            require_once ROOT . '/controller/'.$c.'.php';
            break;
        case (file_exists(ROOT . '/model/'.$c.'.php')):
            require_once ROOT . '/model/'.$c.'.php';
            break;
        case (file_exists(ROOT . '/view/'.$c.'.php')):
            require_once ROOT . '/view/'.$c.'.php';
            break;
    }
}

$option = 'indexclass';

if(isset($_GET['option'])) {
    $opt = $_GET['option'];
    $path = ROOT.'/controller/'.$opt.'.php';

    if(file_exists($path)) {

        if(class_exists($option)) {
            $option = trim(strip_tags($_GET['option']));
        }
    }
}

$y = new $option();
$y->getBody();
