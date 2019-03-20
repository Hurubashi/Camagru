<?php
/**
 * Created by PhpStorm.
 * User: mrybak
 * Date: 3/20/19
 * Time: 6:03 PM
 */

class MainController
{
    public function actionIndex() {
        include_once(ROOT . "/views/Main.php");
        return true;
    }
}