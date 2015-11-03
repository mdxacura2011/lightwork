<?php

class edit extends core {
    function getTitle() {
        return 'Редактирование данных';
    }

    function getContent() {

        if(!isset($_SESSION['id'])) {
            header("Location: ?option=indexclass");
            exit;
        }

        if($this->hereBase->selectInfo($_SESSION['id'])) {
            if(isset($_POST['editresume'])) {
                $specialty = $this->sift($this->clearString($_POST['specialty']));
                $salary = $this->sift($this->clearString($_POST['salary']));
                $city = $this->sift($this->clearString($_POST['city']));
                $experience = $this->sift($this->clearString($_POST['experience']));
                $education = $this->sift($this->clearString($_POST['education']));
                $additionally = $this->sift($this->clearString($_POST['additionally']));
                $id_users = $_SESSION['id'];
                $this->hereBase->editInfo($experience, $education, $additionally, $id_users, $specialty, $salary, $city);
                header("Location: ?option=personalArea");
            }
            $editRes = $this->hereBase->infoResume($_SESSION['id']);
            $objectArea = new editcontent($editRes);
            return $objectArea->editData();
        }
    }
}