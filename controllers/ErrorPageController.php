<?php

class ErrorPageController
{
    public function actionError404() {
        include_once ROOT . '/views' . '/error404.php';
        return true;
    }

}