<?php

class PostingManager extends Model
{
    public static function saveImage($userId, $username, $imagePath) {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo (ownerId, username, photoURL) VALUES (:ownerId, :username, :photoURL)";
            $stmt = Database::$pdo->prepare($sql);

            $stmt->execute(['ownerId' => $userId, 'username' => $username, 'photoURL' => $imagePath]);

        }
    }
}