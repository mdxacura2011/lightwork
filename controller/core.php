<?php

abstract class core {

    protected $hereBase;

    public function __construct() {
        $this->hereBase = new model();
    }

    private function replaceStringTitle($tmp_title) {
        return str_replace('%title%', $this->getTitle(), $tmp_title);
    }

    private function replaceStringContent($tmp_content) {
        return str_replace('%content%', $this->getContent(), $tmp_content);
    }

    protected function clearString($string) {
        return trim(htmlspecialchars(stripcslashes($string)));
    }

    public function sift($string) {
        $list = array(
            "<?" => "&lt;?",
            "?>" => "?&lt;"
        );
        foreach($list as $key => $value) {
            $string = str_replace($key, $value, $string);
        }
        return $string;
    }

    private function observer($path_include) {
        ob_start();
        include $path_include;
        $text_file = ob_get_contents();
        ob_end_clean();
        return $text_file;
    }

    private function replaceString($tmp_content) {
      preg_match_all('/%(.*)%/', $tmp_content, $array_result);
       for ($i = 0; $i < count($array_result[0]); $i++) {
            $path_include = ROOT.'/controller/'.$array_result[1][$i].'.php';
           if(file_exists($path_include)) {
                $text_file = $this->observer($path_include);
                //$text_file = file_get_contents($path_include);
                $tmp_content = str_replace($array_result[0][$i], $text_file, $tmp_content);
            }
        }
        return $tmp_content;
    }

    public function getView() {
        $args = func_get_args();
        $view = ROOT . '/view/viewResume.php';

        $list = array();
        for($i = 0; $i < count($args); $i++) {
            if(!($i % 2)) {
                $list[$args[$i]] = $args[$i + 1];
            }
        }
        if(file_exists($view)) {
            $res = file_get_contents($view);
            foreach($list as $key => $value) {
                $res = str_replace('%'.$key.'%', $value, $res);
            }
            return $res;
        } else {
            throw new Exception("Нет шаблона для вывода резюме");
        }
    }

    public function toInteger($int) {
        $int = abs((int)$int);
        return $int;
    }

    public function pageNav($nPage, $quantity) {
        //< | back | 1 | 2 | {3} | 4 | 5 | forward | >
        $limit = QUANTITY_NEWS;
        $pages = ceil($quantity / $limit);
        $first = "";
        $back = "";
        $page2left = "";
        $page1left = "";
        $page = "<li class=\"active\"><a href=\"#\">{$nPage}</a></li>"; //<li><a href='#'>back</a></li>
        $page1right = "";
        $page2right = "";
        $forward = "";
        $last = "";

        $add_class = "<div class='row'>
				        <div class='col-sm-7 col-sm-offset-5'>
                            <nav>
                                <ul class='pagination'>";
        $end_add_class = "</ul></nav></div></div>";

        $uri = "?";

        foreach($_GET as $key => $value) {
            if($key != "page")
                $uri .= "{$key}={$value}&";
        }

        if($nPage > 3) {
            $first = '<li><a href="'.$uri.'page=1" >&lt;</a></li>';
        }
        //$back
        if($nPage > 1) {
            $back ='<li><a href="'.$uri.'page='.($nPage - 1).'"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
        }
        //$page2left
        if(($nPage - 2) > 0) {
            $page2left = '<li><a href="'.$uri.'page='.($nPage - 2).'">'.($nPage - 2).'</a></li>';
        }
        //$page1left
        if(($nPage - 1) > 0) {
            $page1left = '<li><a href="'.$uri.'page='.($nPage - 1).'" >'.($nPage - 1).'</a></li>';
        }
        //$page1right
        if($nPage < $pages) {
            $page1right = '<li><a href="'.$uri.'page='.($nPage + 1).'" >'.($nPage + 1).'</a></li>';
        }
        //$page2right
        if(($nPage + 1) < $pages) {
            $page2right = '<li><a href="'.$uri.'page='.($nPage + 2).'" >'.($nPage + 2).'</a></li>';
        }
        //$forward
        if($nPage < $pages) {
            $forward = '<li><a href="'.$uri.'page='.($nPage + 1).'"aria-label="Next" ><span aria-hidden="true">&raquo;</span></a></li>';
        }
        //$last
        if($nPage < ($pages - 2)) {
            $last = '<li><a href="'.$uri.'page='.$pages.'" >&gt;</a></li>';
        }

        return $add_class.$first.$back.$page2left.$page1left.$page.$page1right.$page2right.$forward.$last.$end_add_class;
    }

    public function getBody() {
        $tmp_url = ROOT . '/templates/defaultTemp/main.php';
       if(file_exists($tmp_url)) {
            $tmp = file_get_contents($tmp_url);
            $tmp = $this->replaceString($tmp);
            $tmp = $this->replaceStringTitle($tmp);
            $tmp = $this->replaceStringContent($tmp);
            echo $tmp;
        }
        else {
            echo 'Шаблон не подключен!';
        }
    }

    abstract function getContent();
    abstract function getTitle();
}