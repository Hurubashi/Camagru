<?php

session_start();
include_once ROOT . '/models/PhotoPostModel.php';

$manager = new PhotoPostModel;
$result = $manager->saveComment();

if ($result) {
//    $comments = $manager->fetchCommentsById($_POST['photoId']);
    $postInfo = $manager->fetchPostWithId($_POST['photoId']);

    echo "<div class='postInfo' name='postInfo'>";
    echo "<img class='photo' src='$postInfo->photoURL'>";
    echo "Posted by $postInfo->username";
    echo "$postInfo->creationTime<br>";
    echo "<button name='like'>Like $postInfo->likes</button> ";
//    $num = $manager->countComments($postInfo->id);
    echo "<button name='commentButton' onclick='showHideCommentForm(this)'>Comment $postInfo->comments</button>";
    echo "</div>";

    // Hidden panel that opens with click on commentButton
    echo "<div class='comment-form' name='commentForm' hidden>";
    // Previous comments
    echo "<div class='old-comments'>";
    $comments = $manager->fetchCommentsById($postInfo->id);
    foreach ($comments as $elem) {
        echo "<p>$elem->text</p><br>";
    }
    echo "</div>";
    // Fields to create new comment
    echo "<textarea name='message' style='max-width: 300px'></textarea>";
    echo "<button type='submit' onclick='sendComment(this)'>Send</button>";
    echo "</div>";

} else {
    echo false;
}

?>
