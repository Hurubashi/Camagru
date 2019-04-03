<!DOCTYPE html>
<html>

<head>
    <title>Registrration</title>
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="form">
    <form action="" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="rePassword" placeholder="Confirm password" required>
        <br><br>
        <a href=""><input type="submit" value="Sign Up"></a><br>
        <br>
        <div id="container">
            <a href="#" style=" margin-right: 0px; font-size: 13px;
            font-family: Tahoma, Geneva, sans-serif;">Reset password</a>
            <a href="#" style=" margin-right: 0px; font-size: 13px;
            font-family: Tahoma, Geneva, sans-serif;">Forgot password</a>
        </div><br><br>
        Already have account? <a href="login">&nbsp;Log In</a>
    </form>
    </div>

</body>


</html>

<?php

if ($_POST) {
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;
    $userManager->createUser($_POST["username"], $_POST["email"], $_POST["password"], $_POST["rePassword"]);
}

?>