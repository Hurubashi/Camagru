<?php

include_once (ROOT . '/models/UserModel.php');
$userManager = new UserModel;

$result = $userManager->confirmEmail($_GET["user"], $_GET["confirmation"]);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Confirmation</title>
    <link href="/components/css/congrat.css" rel="stylesheet" type="text/css" />
</head>

<body class="bodyLogin">

<div class="cong">
    <form>
        <h2 style="color: white">
            <?php echo $result; ?>
        </h2>
        <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST']?>" style="text-decoration: none" onclick="">Go back to Home page</a>
        <br><br>
    </form>
</div>

</body>

</html>

