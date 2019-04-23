<?php

session_start();
include_once ROOT . '/models/PhotoPostModel.php';

$manager = new PhotoPostModel;
$result = $manager->saveComment();

if ($result) {

    $post = $manager->fetchOnePhotoPostData($_POST['photoId']);
    $comments = $manager->fetchCommentsById($post->id);

    foreach ($comments as $elem) {
        echo "<p style=\"display:inline;\">$elem->username </p><p style=\"display:inline\">$elem->creationTime</p>";
        echo "<p style='word-wrap: break-word'>$elem->text</p><br>";
    }


} else {
    echo false;
}


