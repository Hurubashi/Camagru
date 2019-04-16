<?php

class PhotoPostModel
{
    public function fetchPhotoPosts() {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT * FROM photo";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute();
            $posts = $stmt->fetchAll();
            return $posts;
        }
        return NULL;
    }

    public function fetchPostWithId($id) {
        if (Database::pdo_is_connected()) {
            $sql = "SELECT * FROM photo WHERE id = :$id";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute();
            $posts = $stmt->fetch();
            return $posts;
        }
        return NULL;
    }

    public function saveComment() {
        if (Database::pdo_is_connected()) {
            $sql = "INSERT INTO photo_comment(ownerId, photoId, username, text) 
                    VALUES (:ownerId, :photoId, :username, :text)";
            $stmt = Database::$pdo->prepare($sql);
            $stmt->execute(['ownerId' => $_SESSION['id'], 'photoId' => $_POST['photoId'],
                        'username' => $_SESSION['username'], 'text' => $_POST['text']]);
            return true;
        }
        return false;
    }

    public function fetchCommentsById($postId) {
        if (Database::pdo_is_connected()) {
            $result = $this->findCommentsBy('photoId', $postId);
            return $result;
        }
        return NULL;
    }


    private function findCommentsBy($title, $value) {
        $sql = "SELECT * FROM photo_comment WHERE $title = :$title";
        $stmt = Database::$pdo->prepare($sql);
        $stmt->execute([$title => $value]);
        $comments = $stmt->fetchAll();
        return $comments;
    }

    public function countComments($photoId) {

        $comments = $this->findCommentsBy('photoId', $photoId);
        return (count($comments));

        //        SELECT FROM `photo` INNER JOIN `photo_comment` ON `photo.id` = `photo_comment.photoId`
//        $sql = "SELECT FROM photo INNER JOIN photo_comment ON photo.id = photo_comment.photoId";
//        $stmt = Database::$pdo->prepare($sql);
//        $stmt->execute();
//        $comments = $stmt->fetchAll();
//        return (count($comments));
    }
}