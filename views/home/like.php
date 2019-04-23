<?php
session_start();
include_once ROOT . '/models/PhotoPostModel.php';

$manager = new PhotoPostModel;
$result = $manager->like();

if ($result) {

    $post = $manager->fetchOnePhotoPostData($_POST['photoId']);

    echo "<img class='photo mainFrame' src='$post->photoURL'>";
    echo "Posted by $post->username ";
    echo "$post->creationTime<br>";
    echo "<button name='like' onclick='like(this)'>Like $post->likes</button>";
    echo "<button name='commentButton' onclick='showHideCommentForm(this)'>Comment $post->comments</button>";

} else {
    echo false;
}


