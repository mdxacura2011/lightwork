<?php

$dir_name = str_replace('\\', '/', dirname(__FILE__));
$dir_controller = str_replace('controller', '', $dir_name);
$controller_name = $dir_controller . 'model/model.php';
require_once $controller_name;

class delete extends model{

    public function del() {
        $object = new model();
        $object->delResume($_SESSION['id']);
        header("Location: ?option=indexclass");
    }
}

$obj = new delete();
$obj->del();