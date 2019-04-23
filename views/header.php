
<header class="head">
    <div class="columns mainFrame">
        <div style="text-align: left; margin-left: 10px">
            <img src="/components/images/camera.png" style="height: 30px; left: 20px">
        </div>
        <nav class="navbar">
            <a href="home">Home</a>
            <a href="makePhoto">Camera</a>
            <?php
            session_start();
            if (isset($_SESSION['username'], $_SESSION['id'])) {
                echo "<a href=\"profile\">Profile</a>";
                echo "<a href=\"logout\" onclick='clearStorage()'>LogOut</a>";
            } else {
                echo "
                            <a href=\"login\">LogIn</a>
                            <a href=\"registration\"> SingUp</a>
                            ";
            }
            ?>
        </nav>
    </div>

</header>

<script>
    function clearStorage() {
        sessionStorage.clear();
    }
</script>
