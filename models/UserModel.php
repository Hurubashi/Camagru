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
        if (Database::$pdo == NULL) {
            return false;
        } else {
            $sql = "SELECT * FROM user WHERE username = :username";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user == NULL) {
                return "No such user";
            }
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
            if ($password == $user->password) {
                return false;
            } else {
                return "Wrong password";
            }
        }
    }

    public function createUser($username, $email, $password) {

        if (Database::$pdo == NULL) {
            return false;
        } else {
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
            $sql = "INSERT INTO user(username, email, password, verification_key) 
                VALUES (:username, :email, :password, :verif)";
            $stmt= Database::$pdo->prepare($sql);
            $bytes = openssl_random_pseudo_bytes(32);
            $hash = bin2hex($bytes);
            $result = $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'verif' => $hash]);

            if ($result) {
                $this->send_email($email, $hash);
                return true;
            }
        }
        return false;
    }

    private function send_email($address, $link){
//        Uncomment to setup your own SMTP server
//        ini_set("SMTP", "aspmx.l.google.com");
//        ini_set("sendmail_from", "c@gmail.com");

        $message = "Follow the link to confirm registration $link";
        $headers = "From: yatrahal@ukr.net";

        mail($address, "Registration at camagru", $message, $headers);
    }

}
