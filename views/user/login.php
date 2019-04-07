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
        <br><br><br><br><br>
        Don't have account? <a href="registration">&nbsp;Sing Up</a>
        <div id="msg"></div>
    </form>
</div>

</body>

<script src="/components/js/infoMsg.js"></script>
</html>

<?php

$result = NULL;

if ($_POST) {
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    $error = $userManager->login($_POST["username"], $_POST["password"]);

    if ($error == NULL) {
        $url = 'http://'. $_SERVER['HTTP_HOST'];
        header("Location: $url");
    }
}

?>

<script>
    var error = "<?php echo $error ?>";

    if (error) {
        message(error);
    }
</script>

id
ownerId
likes
likers