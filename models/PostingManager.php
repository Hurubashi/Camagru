<?php

class PostingManager extends Model
{
    public function saveImage($userId, $username, $imagePath) {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo (ownerId, username, photoURL) 
                    VALUES (:ownerId, :username, :photoURL)";
            $stmt = Database::$pdo->prepare($sql);

            $stmt->execute(['ownerId' => $userId,
                'username' => $username, 'photoURL' => $imagePath]);

        }
    }

    public function fetchPhotoPosts() {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT * FROM photo";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }
    }

    public function addComment() {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo_comment(ownerId, photoId, username, text) 
                    VALUES (:ownerId, :photoId, :username, :text)";
            $stmt = Database::$pdo->prepare($sql);

            $stmt->execute(['ownerId' => $userId, 'photoId' => $photoId,
                        'username' => $username, 'text' => $text]);
        }
    }


}