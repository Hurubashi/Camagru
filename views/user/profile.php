<html>
<head>
    <title>Main</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<?php
include_once (ROOT . '/views/header.php');
include_once (ROOT . '/models/UserModel.php');

$userManager = new UserModel;
$user = $userManager->findUserBy('id', $_SESSION['id']);


?>

<body>

<div class="form" style="height: 500px">
    <div>
        <h2 style="color: white">Profile</h2>
        <?php
        echo "<p style='text-align: left'>Username: $user->username</p>";
        echo "<p style='text-align: left'>Email: $user->email</p>";
        ?>
        <br>
        <div id="inputsDiv"></div>
        <br>
        <input type="button" id="confirm" onclick="" value="Confirm" hidden>
        <input type="button" id="cancel" onclick="cancelEditing()" value="Cancel" hidden>
        <input type="button" id="changeName" onclick="changeName()" value="Change Name">
        <input type="button" id="changeEmail" onclick="changeEmail()" value="Change Email">
        <input type="button" id="changePassword" onclick="changePassword()" value="Change Password">
        <div id="msg"></div>
    </div>
</div>

<script src="/components/js/profile.js"></script>

</body>

</html>