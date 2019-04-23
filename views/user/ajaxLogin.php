<?php

session_start();
if (isset($_POST["username"], $_POST["password"])) {
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    $result = $userManager->login($_POST["username"], $_POST["password"]);
    echo $result;
}