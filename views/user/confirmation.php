
<!DOCTYPE html>
<html>

<head>
    <title>Confirmation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<?php

include_once (ROOT . '/models/UserModel.php');
include_once (ROOT . '/views/header.php');
$userManager = new UserModel;

if (isset($_GET["user"]) && isset($_GET["confirmation"])) {
    $result = $userManager->confirmEmail($_GET["user"], $_GET["confirmation"]);
} else if (!isset($_SESSION['m_username'])) {
    $result = "You need to log in fist";
} else {
    $result = "Something went wrong";
}
?>

<body class="bodyLogin">

<div class="form" style="height: 250px">
    <form>
        <h2 style="color: white">
            <?php echo $result; ?>
        </h2>
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/login'?>" style="text-decoration: none" onclick="">Go to Log In page</a>
        <br><br>
    </form>
</div>

</body>

</html>

