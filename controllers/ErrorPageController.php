<?php

class ErrorPageController extends Controller
{
    public function actionError404() {
        $this->view->generate('error404.php', 'templateView.php');
        return true;
    }
}