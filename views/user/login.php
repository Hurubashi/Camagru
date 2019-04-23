
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
    <link href="/components/css/infoMsg.css" rel="stylesheet" type="text/css" />
</head>

<?php include_once (ROOT . '/views/header.php'); ?>

<body class="bodyLogin">

<div class="form">
    <form onsubmit="event.preventDefault(); return sendForm();">
        <h2 style="color: white">Log In</h2>
        <input type="text" id="username" placeholder="Username" required>
        <input type="password" id="password" placeholder="Password" required>
        <br><br>
        <a href=""><input type="submit" value="Log In"></a><br>
        <br>
        <br><br><br><br><br>
        Don't have account? <a href="registration">&nbsp;Sing Up</a>
        <div id="msg"></div>
    </form>
</div>

</body>

<script src="/components/js/ajaxRequest.js"></script>
<script src="/components/js/infoMsg.js"></script>
<script src="/components/js/loginSendForm.js"></script>

</html>

