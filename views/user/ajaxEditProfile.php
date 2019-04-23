<?php

session_start();
include_once ROOT . '/models/UserModel.php';

$userManager = new UserModel;

const
changeName = 1,
changeEmail = 2,
changePassword = 3;

if ($_POST['userWant'] == changeName) {
    $result = $userManager->changeName($_SESSION['id'], $_POST['password'], $_POST['newUsername']);
} else if ($_POST['userWant'] == changeEmail) {
    $result = $userManager->changeEmail($_SESSION['id'], $_POST['password'], $_POST['email']);
} else if ($_POST['userWant'] == changePassword) {
    $result = $userManager->changePassword($_SESSION['id'], $_POST['password'], $_POST['newPassword']);
}

echo $result;