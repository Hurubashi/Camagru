<?php

class MainController extends Controller
{
    public function actionIndex() {
        $this->view->generate('main.php', 'templateView.php');
    }

    public function actionSlider() {
        $this->view->generate('/photomaker/slider.php', 'templateView.php');
    }

}