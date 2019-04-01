<?php
/**
 * Created by PhpStorm.
 * User: mrybak
 * Date: 3/20/19
 * Time: 4:09 PM
 */

class DragController {

    public function actionIndex() {
        include_once(ROOT . "/views/DragAndDrop.php");
        return true;
    }
}
