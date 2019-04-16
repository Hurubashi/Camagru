
<header class="head">

    <div class="mainFrame menu-wrapper">
        <nav class="navbar">
            <a href="home">Home</a>
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


