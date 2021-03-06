<?php

class UserController
{
    public function actionLogin() {
        include_once ROOT . '/views' . '/user/login.php';
        return true;
    }

    public function actionRegistration() {
        include_once ROOT . '/views' . '/user/registration.php';
        return true;
    }

    public function actionConfirmation() {
        include_once ROOT . '/views' . '/user/confirmation.php';
        return true;
    }

    public function actionLogout() {
        include_once ROOT . '/views' . '/user/logout.php';
        return true;
    }

    public function actionProfile() {
        include_once ROOT . '/views' . '/user/profile.php';
        return true;
    }

    public function actionEditProfile() {
        include_once ROOT . '/views' . '/user/ajaxEditProfile.php';
        return true;
    }

    public function actionManageLogin() {
        include_once ROOT . '/views' . '/user/ajaxLogin.php';
        return true;
    }

    public function actionManageRegistration() {
        include_once ROOT . '/views' . '/user/ajaxRegistration.php';
        return true;
    }

}