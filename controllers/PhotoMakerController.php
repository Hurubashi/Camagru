<?php


class PhotoMakerController extends Controller
{
    public function actionMakePhoto() {
        $this->view->generate('/photomaker/makePhoto.php', 'templateView.php');
    }

    public function actionSaveImg() {
        $this->view->generate('/photomaker/saveImg.php', 'templateView.php');
    }
}