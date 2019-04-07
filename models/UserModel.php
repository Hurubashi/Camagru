<?php

class UserModel extends Model
{

    function __destruct()
    {
        echo "DESTRUCTOR IOPTA!!!!";
        // TODO: Implement __destruct() method.
    }
    /*----------------------------------------------------------------------------------------------*/
    //************************************** Public functions **************************************//
    /*----------------------------------------------------------------------------------------------*/

    public function login($username, $password) {
        if (Database::pdo_is_connected()) {
            $user = $this->findUserBy("username", $username);
            if ($user == NULL) {
                return "No such user";
            } else if ($user->active == false) {
                return "Confirm you account via link on your email";
            }
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
            if ($password == $user->password) {
                return NULL;
            } else {
                return "Wrong password";
            }
        }
    }

    public function register($username, $email, $password) {
        if (Database::pdo_is_connected()) {
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
            $sql = "INSERT INTO user(username, email, password, hashcode) 
                                VALUES (:username, :email, :password, :hashcode)";
            $stmt= Database::$pdo->prepare($sql);
            $bytes = openssl_random_pseudo_bytes(32);
            $hashcode = bin2hex($bytes);
            $result = $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password, 'hashcode' => $hashcode]);

            if ($result) {
                $confirmationLink = $this->createConfirmationLink($username, $hashcode);
                $this->send_email($email, $confirmationLink);
                return true;
            }
        }
        return false;
    }

    public function confirmEmail($username, $hashcode) {
        $user = $this->findUserBy("username", $username);
        if (Database::pdo_is_connected() && $user->hashcode == $hashcode) {
            $this->activateUser($user->id);
            return "Confirmation successful";
        } else {
            return "Something went wrong :(";
        }

    }

    /*----------------------------------------------------------------------------------------------*/
    //************************************** Private functions *************************************//
    /*----------------------------------------------------------------------------------------------*/
    private function activateUser($id) {
        $sql = 'UPDATE user SET active = :active WHERE id = :id';
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute(['active' => 1, 'id' => $id]);
    }

    private function createConfirmationLink($username, $hashcode) {
        $arr = array('user' => $username, 'confirmation' => $hashcode);
        return 'http://' . $_SERVER['HTTP_HOST'] . '/user/confirmation?' . http_build_query($arr);
    }

    private function findUserBy($title, $value) {
        $sql = "SELECT * FROM user WHERE $title = :$title";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute([$title => $value]);
        $user = $stmt->fetch();
        return $user;
    }

    private function send_email($address, $link){
//        Uncomment to setup your own SMTP server
//        ini_set("SMTP", "aspmx.l.google.com");
//        ini_set("sendmail_from", "c@gmail.com");
        $message = "Follow the link to confirm registration $link";
        $headers = "From: camagru@fakemail.com";

        mail($address, "Registration at camagru", $message, $headers);
    }
}
