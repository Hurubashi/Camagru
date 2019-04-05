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
        <input type="text" name="username" placeholder="Username" minlength="3" required>
        <input type="text" name="email" placeholder="Email" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$" required>
        <input type="password" name="password" id="password" placeholder="Password" pattern="(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$" required>
        <input type="password" name="cPassword" id="cPassword" placeholder="Confirm password" pattern="(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$" required>
        <br><br>
        <a href=""><input type="submit" value="Sign Up" onclick="validatePassword();"></a><br>
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

<script>
    var password = document.getElementById("password")
        , confirm_password = document.getElementById("cPassword");

    console.log(password.value);
    console.log(confirm_password.value);
    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

</html>

<?php

if ($_POST) {
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    $is_created = $userManager->createUser($_POST["username"], $_POST["email"],
                                $_POST["password"], $_POST["cPassword"]);
    if ($is_created) {
        echo "Congrats!";
    } else {
        echo $is_created;
    }
}

?>