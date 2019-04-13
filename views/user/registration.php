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
        <input type="text" name="username" id="username" placeholder="Username" minlength="3" required>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="cPassword" id="cPassword" placeholder="Confirm password" required>
        <br><br>
        <a href=""><input type="submit" value="Sign Up" id="sign"></a><br>
        <br>
        <br><br>
        Already have account? <a href="login">&nbsp;Log In</a>
        <div id="msg"></div>
    </form>
    </div>

</body>

<script src="/components/js/userInputValidation.js"></script>
<script src="/components/js/infoMsg.js"></script>
</html>

<?php

if (isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    include (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    $error = $userManager->register($_POST["username"], $_POST["email"], $_POST["password"]);
}

?>

<script>
    var error = "<?php echo $error ?>";

    if (error) {
        message(error);
    } else {
        message("Success!! <br> Confirmation link was sent to your email");
    }

</script>
