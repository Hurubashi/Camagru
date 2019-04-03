<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<body class="bodyLogin">

<div class="form">
    <form action="" method="post">
        <h2 style="color: white">Log In</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <br><br>
        <a href=""><input type="submit" value="Log In"></a><br>
        <br>
        <div id="container">
            <a href="#" style=" margin-right: 0px; font-size: 13px;
            font-family: Tahoma, Geneva, sans-serif;">Reset password</a>
            <a href="#" style=" margin-right: 0px; font-size: 13px;
            font-family: Tahoma, Geneva, sans-serif;">Forgot password</a>
        </div>
        <br><br><br><br><br>
        Don't have account? <a href="registration">&nbsp;Sing Up</a>
    </form>
</div>

</body>


</html>

<?php

if ($_POST) {
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;
    $userManager->checkEnteredData($_POST["username"], $_POST["password"]);
}

?>