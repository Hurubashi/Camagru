<?php

class UserController extends Controller
{
    public function actionLogin() {
        $this->view->generate('/user/login.php', 'templateView.php');
    }

    public function actionRegistration() {
        $this->view->generate('/user/registration.php', 'templateView.php');
    }

    public function actionConfirmation() {
        $this->view->generate('/user/confirmation.php', 'templateView.php');
    }

}