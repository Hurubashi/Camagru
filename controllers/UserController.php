<?php

class UserController extends Controller
{
    public function actionLogin() {
        $this->view->generate('/user/login.php', 'templateView.php');
    }

    public function actionRegistration() {
        $this->view->generate('/user/registration.php', 'templateView.php');
    }

    public function actionCongrat() {
        $this->view->generate('/user/congrat.php', 'templateView.php');
    }

}