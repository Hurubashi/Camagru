<?php

class UserModel extends Model
{
    public function get_data() {
        return array(

            array(
                'Year' => '2012',
                'Site' => 'http://DunkelBeer.ru',
                'Description' => 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'
            ),
            array(
                'Year' => '2012',
                'Site' => 'http://ZopoMobile.ru',
                'Description' => 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'
            ),
            // todo
        );
    }

    public function checkEnteredData($username, $password) {
        echo "Checking data $username , $password";
    }

    public function createUser($username, $email, $password, $rePassword) {
        echo "Checking data: $username , $email, $password, $rePassword";

        $password = md5($password);
        $pdo = connect_db();
        $sql = "INSERT INTO user(username, email, password, verification_key) 
                VALUES (:username, :email, :password, :verif)";
        $stmt= $pdo->prepare($sql);

        $bytes = openssl_random_pseudo_bytes(32);
        $hash = bin2hex($bytes);
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'verif' => $hash]);

        $this->send_email($email, $hash);
    }

    private function send_email($address, $link){
//        ini_set("SMTP", "aspmx.l.google.com");
//        ini_set("sendmail_from", "c@gmail.com");
        $message = "Follow the link to confirm registration $link";
        $headers = "From: yatrahal@ukr.net";

        mail($address, "Registration at camagru", $message, $headers);
        echo "Check your email now....<BR/>";
    }

}
