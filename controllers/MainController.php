<?php

class MainController extends Controller
{
    public function actionIndex() {
        $this->view->generate('main.php', 'templateView.php');
    }

}