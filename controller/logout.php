<?php

class logout extends core {

    function getTitle() {
        return 'Выход';
    }

    function getContent() {
        if(isset($_SESSION['name'])) {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['ava']);
            unset($_SESSION['surname']);
            unset($_SESSION['surnameN']);
            unset($_SESSION['datar']);
            unset($_SESSION['avatar']);
            header("Location: ?option=indexclass");
            exit;
        } else {
            header("Location: ?option=indexclass");
            exit;
        }
        return "";
    }
}
