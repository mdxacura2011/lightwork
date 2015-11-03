<?php

class indexclass extends core {

    function getTitle() {
        return 'Заголовок';
    }

    function getContent() {
        $limit = QUANTITY_NEWS;
        $page = 1;
        $to = 0;

        if(isset($_GET['page'])) {
            $page_num = $this->toInteger($_GET['page']);
            if($page_num > 0) {
                $page = $page_num;
            }
        }
        $result = "";
        $to = $page*$limit-$limit;
        $quantity_all_news = $this->hereBase->quantityAllNews();
        $quantity_all_news = $quantity_all_news->rowCount();
        $gCR = $this->hereBase->getContentResume($limit, $to);
        $last_page = ceil($quantity_all_news / $limit);

        if($page > $last_page) {
            throw new Exception("Страница не найдена");
            exit;
        }

        $rows = $gCR->fetch();
        do {
            $s = $this->hereBase->getUserAvatar($rows['id_users']);
            $row = $s->fetch();

            $result .= $this->getView(
                "reference_image", $row['avatar'],
                "header", $rows['specialty'],
                "here_content", $rows['education'],
                "id_resume", $rows['id']
            );
        }
        while($rows = $gCR->fetch());

        $result .= $this->pageNav($page, $quantity_all_news);

        return $result;
    }
}