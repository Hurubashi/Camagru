<html>

<head>
    <title>Registrration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<body>

<body>

<div class="form">
    <form action="" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="username" id="username" placeholder="Username" minlength="3" required>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="cPassword" id="cPassword" placeholder="Confirm password" required>
        <br><br>
        <a href=""><input type="submit" value="Sign Up"></a><br>
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

    $result = $userManager->register($_POST["username"], $_POST["email"], $_POST["password"]);
}

?>

<script>

    var result = "<?php echo $result ?>";
    if (result) {
        message(result);
    }

</script>