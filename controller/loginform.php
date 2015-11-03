<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 10.10.15
 * Time: 13:48
 */

$dir_name = str_replace('\\', '/', dirname(__FILE__));
$dir_controller = str_replace('controller', '', $dir_name);


$controller_name = $dir_controller . 'model/model.php';
$view_name = $dir_controller . 'view/logform.php';

require_once $controller_name;
require_once $view_name;

class loginform extends model
{

    public function forma()
    {
        if (isset($_SESSION['name'])) {
            echo '<p>Привет <b>' . $_SESSION['name'] .' '. $_SESSION['surnameN'] .'.</b><br />'.'<img src=' . $_SESSION['ava'] . " class='img-circle'>" .' ' . "<a href='?option=personalArea' id='myroom'>Личный кабинет</a>" ." <br><a href='?option=logout' style='color: #f00;'>Выход</a></p>";
        } else {
            $object = new logform();
            $result = $object->viewLogForm();
            echo $result;
        }
    }

    public function clearString($string) {
        return trim(htmlspecialchars(stripcslashes($string)));
    }

    public function handler() {
        if(isset($_POST['login-user'])) {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = $this->clearString($_POST['login']);
                $password = $this->clearString($_POST['password']);
                $password = strrev(md5($password));

                if (
                    !empty($login) &&
                    !empty($password)
                ) {
                    $obj = new model();
                    $stmt = $obj->sample($login, $password);
                    if($stmt->rowCount() > 0) {
                        $row = $stmt->fetch();
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['tel'] = $row['tel'];
                        $_SESSION['ava'] = $row['ava'];
                        $_SESSION['avatar'] = $row['avatar'];
                        $_SESSION['datar'] = $row['datar'];
                        $_SESSION['surname'] = $row['surname'];
                        $stringov = mb_substr($row['surname'],0,1,'UTF-8');
                        $_SESSION['surnameN'] = $stringov;
                        echo "<p style='color: green;'>ОК!</p><meta http-equiv='Refresh' content='0; URL=?option=indexclass'";
                    } else {
                        echo 'Нет такого пользователя';
                    }

                } else {
                    echo 'Не заполнен логин или пароль';
                }
            }
        }
    }
}

$object = new loginform();
$object->forma();
$object->handler();