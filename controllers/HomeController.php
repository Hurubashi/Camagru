<?php

class HomeController
{
    public function actionMain() {
        include_once ROOT . '/views' . '/home/main.php';
        return true;
    }

    public function actionSaveComment() {
        include_once ROOT . '/views' . '/home/saveComment.php';
        return true;
    }

}