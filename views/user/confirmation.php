<?php

include_once (ROOT . '/models/UserModel.php');
$userManager = new UserModel;

if (isset($_GET["user"]) && isset($_GET["confirmation"])) {
    $result = $userManager->confirmEmail($_GET["user"], $_GET["confirmation"]);
} else if (!isset($_SESSION['m_username'])) {
    $result = "You need to log in fist";
} else {
    $result = "Something went wrong";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Confirmation</title>
    <link href="/components/css/form.css" rel="stylesheet" type="text/css" />
</head>

<body class="bodyLogin">

<div class="form" style="height: 250px">
    <form>
        <h2 style="color: white">
            <?php echo $result; ?>
        </h2>
        <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/user/login'?>" style="text-decoration: none" onclick="">Go to Log In page</a>
        <br><br>
    </form>
</div>

</body>

</html>

