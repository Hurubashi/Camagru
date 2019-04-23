<?php

class HomeController
{
    public function actionMain() {
        include_once ROOT . '/views' . '/home/main.php';
        return true;
    }

    public function actionSaveComment() {
        include_once ROOT . '/views' . '/home/ajaxSaveComment.php';
        return true;
    }

    public function actionLike() {
        include_once ROOT . '/views' . '/home/like.php';
        return true;
    }

}