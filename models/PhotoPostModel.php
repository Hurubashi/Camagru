<?php

class PhotoPostModel
{
    public function fetchAllPhotoPostsData() {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT photo.id, photo.userId, photo.username,
                    COUNT(DISTINCT photo_comment.id) as comments,
                    COUNT(DISTINCT photo_like.id) as likes,
                    photo.photoURL, photo.creationTime
                    FROM `photo`
                    LEFT JOIN photo_like on photo_like.photoId = photo.id
                    LEFT JOIN photo_comment on photo_comment.photoId = photo.id
                    GROUP BY photo.id DESC";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute();
            $postData = $stmt->fetchAll();
            return $postData;

        }
        return NULL;
    }

    public function fetchOnePhotoPostData($photoId) {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT photo.id, photo.userId, photo.username,
                    COUNT(DISTINCT photo_comment.id) as comments,
                    COUNT(DISTINCT photo_like.id) as likes,
                    photo.photoURL, photo.creationTime
                    FROM `photo`
                    LEFT JOIN photo_like on photo_like.photoId = photo.id
                    LEFT JOIN photo_comment on photo_comment.photoId = photo.id
                    WHERE photo.id = :id
                    GROUP BY photo.id";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['id' => $photoId]);
            $postData = $stmt->fetch();
            return $postData;
        } else {
            return NULL;
        }
    }

    public function saveComment() {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo_comment(userId, photoId, username, text) 
                    VALUES (:userId, :photoId, :username, :text)";
            $stmt = Database::$pdo->prepare($sql);
            try {
                $stmt->execute(['userId' => $_SESSION['id'], 'photoId' => $_POST['photoId'],
                    'username' => $_SESSION['username'], 'text' => $_POST['text']]);
            } catch (PDOException $e) {
                return "Something went wrong";
            }
            $photo = $this->findRowFromTableByTitle('photo', 'id', $_POST['photoId']);
            $photoOwner = $photo = $this->findRowFromTableByTitle('user', 'id', $photo->userId);


            $message = $_SESSION['username'] . "\n" . $_POST['text'];
            $headers = "From: camagru@fakemail.com";

            mail($photoOwner->email, "Your photo was commented at camagru", $message, $headers);
            return true;
        }
        return false;
    }

    public function like() {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT * FROM photo_like WHERE userId = :userId AND photoId = :photoId";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['userId' => $_SESSION['id'], 'photoId' => $_POST['photoId']]);
            $exist = $stmt->fetch();
            if (!$exist) {
                $sql = "INSERT INTO photo_like(userId, photoId) 
                    VALUES (:userId, :photoId)";
                $stmt = Database::$pdo->prepare($sql);
                $stmt->execute(['userId' => $_SESSION['id'], 'photoId' => $_POST['photoId']]);
            } else {
                $sql = "DELETE FROM photo_like WHERE userId = :userId AND photoId = :photoId";
                $stmt = Database::$pdo->prepare($sql);
                $stmt->execute(['userId' => $_SESSION['id'], 'photoId' => $_POST['photoId']]);
            }
            return true;
        }
        return false;
    }


    public function fetchCommentsById($photoId) {
        if (Database::pdo_is_connected()) {
            $result = $this->findTableByTitle('photo_comment','photoId', $photoId);
            return $result;
        }
        return NULL;
    }

    private function findRowFromTableByTitle($table, $title, $value) {
        $sql = "SELECT * FROM $table WHERE $title = :$title";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute([$title => $value]);
        $result = $stmt->fetch();
        return $result;
    }

    private function findTableByTitle($table, $title, $value) {
        $sql = "SELECT * FROM $table WHERE $title = :$title";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute([$title => $value]);
        $result = $stmt->fetchAll();
        return $result;
    }





}