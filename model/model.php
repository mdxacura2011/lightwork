<?php

class model {

    private $user = 'root';
    private $pass = '1111111111';

    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

    public $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=resume', $this->user, $this->pass, $this->options);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e){
            echo 'ERROR:' . $e->getMessage();
        }
    }

    public function checkLogin($login) {
        $stmt = $this->db->prepare('SELECT id FROM users WHERE login = :login');
        $stmt->execute(array(':login' => $login));
        $row = $stmt->fetch();
        $res = $row['id'];
        return $res;
    }

    public function allData($lastName, $firstName, $login, $pass, $cpass, $inputEmail, $datar, $phoneNumber, $logo, $images, $date) {
        $stmt = $this->db->prepare('INSERT INTO users(surname, name, login, password, cpassword, email, tel, avatar, ava, datar, regdata) VALUES(:surname, :name, :login, :password, :cpassword, :email, :tel, :avatar, :ava, :datar, :regdata)');
        $stmt->execute(array(
            ':surname' => $lastName,
            ':name' => $firstName,
            ':login' => $login,
            ':password' => $pass,
            ':cpassword' => $cpass,
            ':email' => $inputEmail,
            ':tel' => $phoneNumber,
            ':avatar' => $logo,
            ':ava' => $images,
            ':datar' => $datar,
            ':regdata' => $date
            ));
    }

    public function sample($login, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE login = :login AND password = :password');
        $stmt->execute(array(':login' => $login, ':password' => $password));
        return $stmt;
    }

    public function selectInfo($id_users) {
        $stmt = $this->db->prepare('SELECT id FROM info WHERE id_users = :id_users');
        $stmt->execute(array(':id_users' => $id_users));
        $row = $stmt->fetch();
        $res = $row['id'];
        return $res;
    }

    public function addInfo($experience, $education, $additionally, $id_users, $specialty, $salary, $city) {
        $stmt = $this->db->prepare('INSERT INTO info(experience, education, additionally, id_users, specialty, salary, city) VALUES(:experience, :education, :additionally, :id_users, :specialty, :salary, :city)');
        $stmt->execute(array(
            ':experience' => $experience,
            ':education' => $education,
            ':additionally' => $additionally,
            ':id_users' => $id_users,
            ':specialty' => $specialty,
            ':salary' => $salary,
            ':city' => $city
        ));
    }
    public function editInfo($experience, $education, $additionally, $id_users, $specialty, $salary, $city) {
        $stmt = $this->db->prepare('UPDATE info SET experience = :experience, education = :education, additionally = :additionally, specialty = :specialty, salary = :salary, city = :city WHERE :id_users = id_users');
        $stmt->execute(array(
            ':experience' => $experience,
            ':education' => $education,
            ':additionally' => $additionally,
            ':id_users' => $id_users,
            ':specialty' => $specialty,
            ':salary' => $salary,
            ':city' => $city
        ));
    }

    public function infoResume($id_users) {
        $stmt = $this->db->prepare('SELECT * FROM info WHERE id_users = :id_users');
        $stmt->execute(array(':id_users' => $id_users));
        return $stmt;
    }

    public function delResume($id_users) {
        $stmt = $this->db->prepare('DELETE FROM info WHERE id_users = :id_users');
        $stmt->execute(array(':id_users' => $id_users));
        return $stmt;
    }

    public function getContentResume($limit, $to) {
        $stmt = $this->db->query("SELECT id, education, specialty, id_users FROM info ORDER BY id DESC LIMIT $to, $limit");
        return $stmt;
    }

    public function quantityAllNews() {
        $stmt = $this->db->query('SELECT id FROM info');
        return $stmt;
    }



    public function getUserAvatar($id) {
        $stmt = $this->db->prepare('SELECT avatar FROM users WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt;
    }

    public function viewResumeInfo($id) {
        $stmt = $this->db->prepare('SELECT * FROM info WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt;
    }

    public function viewResUsers($id) {
        $stmt = $this->db->prepare('SELECT id_users FROM info WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt;
    }

    public function viewResumeUsers($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt;
    }



}