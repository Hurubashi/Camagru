<?php

class UserModel
{
    /*----------------------------------------------------------------------------------------------*/
    //************************************** Public functions **************************************//
    /*----------------------------------------------------------------------------------------------*/

    // Return error text or NULL if login successful
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
                $_SESSION['username'] = $user->username;
                $_SESSION['id'] = $user->id;
                return "Success";
            } else {
                return "Wrong password";
            }
        }
    }

    // Return error text or NULL if registration successful
    public function register($username, $email, $password) {
        if (Database::pdo_is_connected()) {
            if ($this->usernameIsUsed($username)) {
                return "Username already taken";
            }
            if ($this->emailIsUsed($email)) {
                return "Email already used";
            }
            $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
            $sql = "INSERT INTO user(username, email, password, hashcode) 
                                VALUES (:username, :email, :password, :hashcode)";
            $stmt= Database::$pdo->prepare($sql);
            $bytes = openssl_random_pseudo_bytes(32);
            $hashcode = bin2hex($bytes);
            try {
                $result = $stmt->execute(['username' => $username, 'email' => $email,
                    'password' => $password, 'hashcode' => $hashcode]);
            } catch (PDOException $e) {
                return "Something went wrong";
            }
            if ($result) {
                $confirmationLink = $this->createConfirmationLink($username, $hashcode);
                $this->send_email($email, $confirmationLink);
                return "Success";
            }
        }
        return "Cannot connect to database";
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

    public function findUserBy($title, $value) {
        $sql = "SELECT * FROM user WHERE $title = :$title";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute([$title => $value]);
        $user = $stmt->fetch();
        return $user;
    }

    public function changeName($id, $password, $newUsername) {
        $user = $this->findUserBy('id', $id);
        $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
        if ($password == $user->password) {
            if ($this->usernameIsUsed($newUsername)) {
                return "This username is already taken!";
            }
            $sql = 'UPDATE user SET username = :username WHERE id = :id';
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['username' => $newUsername, 'id' => $id]);
            return "Done!";
        } else {
            return "Wrong Password";
        }
    }

    public function changeEmail($id, $password, $newEmail) {
        $user = $this->findUserBy('id', $id);
        $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
        if ($password == $user->password) {
            if ($this->usernameIsUsed($newEmail)) {
                return "This email is already taken!";
            }
            $sql = 'UPDATE user SET email = :email WHERE id = :id';
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['email' => $newEmail, 'id' => $id]);
            return "Done!";
        } else {
            return "Wrong Password";
        }
    }

    public function changePassword($id, $password, $newPassword) {
        $user = $this->findUserBy('id', $id);
        $password = crypt($password, '$2a$07$YourSaltIsA22ChrString$');
        if ($password == $user->password) {
            $sql = 'UPDATE user SET password = :password WHERE id = :id';
            $stmt = Database::$pdo->prepare($sql);
            $newPassword = crypt($newPassword, '$2a$07$YourSaltIsA22ChrString$');
            $stmt->execute(['password' => $newPassword, 'id' => $id]);
            return "Done!";
        } else {
            return "Wrong Password";
        }
    }

    /*----------------------------------------------------------------------------------------------*/
    //************************************** Private functions *************************************//
    /*----------------------------------------------------------------------------------------------*/

    private function usernameIsUsed($username) {
        $user = $this->findUserBy("username", $username);
        if ($user == NULL) {
            return false;
        } else {
            return true;
        }

    }

    private function emailIsUsed($email) {
        $user = $this->findUserBy("email", $email);
        if ($user == NULL) {
            return false;
        } else {
            return true;
        }
    }


    private function activateUser($id) {
        $sql = 'UPDATE user SET active = :active WHERE id = :id';
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute(['active' => 1, 'id' => $id]);
    }

    private function createConfirmationLink($username, $hashcode) {
        $arr = array('user' => $username, 'confirmation' => $hashcode);
        return 'http://' . $_SERVER['HTTP_HOST'] . '/confirmation?' . http_build_query($arr);
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
