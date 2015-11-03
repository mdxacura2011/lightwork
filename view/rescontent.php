<?php

class rescontent {
    public $eeai;

    public function __construct($eeai) {
        $this->eeai = $eeai;
    }

    public function conclusion() {
        $rows = $this->eeai->fetch();
        $s = $_SESSION['surname'];
        $n = $_SESSION['name'];
        $t = $_SESSION['tel'];
        $d = $_SESSION['datar'];
        $a = $_SESSION['avatar'];
        $specialty = $rows['specialty'];
        $salary = $rows['salary'];
        $city = $rows['city'];
        $experience = nl2br($rows['experience']);
        $education = nl2br($rows['education']);
        $additionally = nl2br($rows['additionally']);
        $cOut = "
        <div class='row'>
            <div class='col-sm-5 col-sm-offset-3'>
                <h1>$s $n <small>$d</small></h1>
            </div>
        </div>
        <br />
        <div class='row'>

                <div class='col-sm-5'>
                       <img src='$a' class='img-rounded'>
                </div>
                <div class='col-sm-7'>
                    <br />
                    <h3><strong>Должность:</strong> $specialty</h3>
                    <h3><strong>Зарплата грн/мес:</strong> $salary</h3>
                    <h3><strong>Город:</strong> $city</h3>
                    <br />
                    <h3><strong>Телефон:</strong> $t</h3>
                </div>
        </div>
        <div class='row'>
            <div class='col-sm-5 col-sm-offset-3'>
                <h1>Опыт работы</h1>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-6 col-sm-offset-1'>
                <p>$experience</p>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-5 col-sm-offset-3'>
                <h1>Образование</h1>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-6 col-sm-offset-1'>
                <p>$education</p>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-5 col-sm-offset-3'>
                <h1>Дополнительно</h1>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-6 col-sm-offset-1'>
                <p>$additionally</p>
            </div>
        </div>
        <br />
        <br />
        <div class='row'>
            <div class='col-sm-6 col-sm-offset-1'>
                <p>
                    <a class='btn btn-default' href='?option=edit' role='button'>Редактировать</a>
                    <a class='btn btn-default' href='#' onclick=\"del()\" role='button'>Удалить</a>
                </p>
            </div>
        </div>

        ";
        return $cOut;
    }
}