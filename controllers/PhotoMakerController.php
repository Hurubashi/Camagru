<?php


class PhotoMakerController
{
    public function actionMain() {
        include_once ROOT . '/views' . '/photomaker/main.php';
        return true;
    }

    public function actionSaveImg() {
        include_once ROOT . '/views' . '/photomaker/ajaxSaveImg.php';
        return true;
    }

    public function actionUploadImg() {
        include_once ROOT . '/views' . '/photomaker/ajaxUploadImg.php';
        return true;
    }

    public function actionSlider() {
        include_once ROOT . '/views' . '/photomaker/slider.php';
        return true;
    }
}