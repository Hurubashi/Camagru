<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
</head>

<header class="head">

    <div class="mainFrame menu-wrapper">
        <nav class="navbar">
            <a href="main">Home</a>
            <a href="makePhoto">Camera</a>
        </nav>

        <nav class="navbar right-menu">
            <?php
            session_start();
            if (isset($_SESSION['username'], $_SESSION['id'])) {
                echo "<a href=\"\">Profile</a>";
                echo "<a href=\"logout\">LogOut</a>";
            } else {
                echo "
                <a href=\"login\">LogIn</a>
                /<a href=\"registration\"> SingUp</a>
                ";
            }
            ?>
        </nav>
    </div>

</header>

<?php include ROOT . '/views/' . $content_view; ?>

</html>
