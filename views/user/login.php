
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
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
    include_once (ROOT . '/models/UserModel.php');
    $userManager = new UserModel;

    if (isset($_POST["username"], $_POST["password"])) {

        $error = $userManager->login($_POST["username"], $_POST["password"]);

        if ($error == NULL) {
            $url = 'http://'. $_SERVER['HTTP_HOST'];
            header("Location: $url");
        }
    }

?>

<script>
    let error = "<?php echo $error ?>";

    if (error) {
        message(error);
    }
</script>