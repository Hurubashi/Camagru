<?php

session_start();
if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    include (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    $result = $userManager->
                register($_POST["username"], $_POST["email"], $_POST["password"]);
    echo $result;
}