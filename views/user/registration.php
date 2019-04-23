<html>

<head>
    <title>Registrration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
    <link href="/components/css/infoMsg.css" rel="stylesheet" type="text/css" />
</head>

<?php include_once (ROOT . '/views/header.php'); ?>

<body>

<div class="form">
    <form onsubmit="event.preventDefault(); return sendForm();">
        <h2>Sign Up</h2>
        <input type="text" id="username"
               placeholder="Username" minlength="3" required>
        <input type="text" id="email"
               onkeyup="validateEmail(this)" placeholder="Email" required>
        <input type="password" id="password"
               onkeyup="validatePassword(this, document.getElementById('cPassword'))" placeholder="Password" required>
        <input type="password" id="cPassword"
               onkeyup="validatePassword(document.getElementById('password'), this)" placeholder="Confirm password" required>
        <br><br>
        <a href=""><input type="submit" value="Sign Up"></a><br>
        <br>
        <br><br>
        Already have account? <a href="login">&nbsp;Log In</a>
        <div id="msg"></div>
    </form>
</div>

</body>

<script src="/components/js/ajaxRequest.js"></script>
<script src="/components/js/registerSendForm.js"></script>
<script src="/components/js/userInputValidation.js"></script>
<script src="/components/js/infoMsg.js"></script>

</html>
