<?php

class view extends core {
    function getTitle() {
        return 'Резюме';
    }

    function getContent() {
        $id = $this->toInteger($_GET['id']);
        $view_info = $this->hereBase->viewResumeInfo($id);
        $view_res_user = $this->hereBase->viewResUsers($id);
        $v = $view_res_user->fetch();
        $view_users = $this->hereBase->viewResumeUsers($v['id_users']);
        $oct = new viewR($view_info, $view_users);
        return $oct->viewResume();

    }
}