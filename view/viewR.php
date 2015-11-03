<?php

class viewR {
    public $users;
    public $info;

    public function __construct($info, $users) {
        $this->info = $info;
        $this->users = $users;
    }

    public function viewResume() {
        $row = $this->info->fetch();
        $rows = $this->users->fetch();

        $experience = nl2br($row['experience']);
        $education = nl2br($row['education']);
        $additionally = nl2br($row['additionally']);
        $cOut = "
        <div class='row'>
            <div class='col-sm-5 col-sm-offset-3'>
                <h1>{$rows['surname']} {$rows['name']} <small>{$rows['datar']}</small></h1>
            </div>
        </div>
        <br />
        <div class='row'>

                <div class='col-sm-5'>
                       <img src='{$rows['avatar']}' class='img-rounded'>
                </div>
                <div class='col-sm-7'>
                    <br />
                    <h3><strong>Должность:</strong> {$row['specialty']}</h3>
                    <h3><strong>Зарплата грн/мес:</strong> {$row['salary']}</h3>
                    <h3><strong>Город:</strong> {$row['city']}</h3>
                    <br />
                    <h3><strong>Телефон:</strong> {$rows['tel']}</h3>
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
        ";
        return $cOut;
    }
}