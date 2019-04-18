<?php
session_start();
include_once ROOT . '/models/PhotoPostModel.php';

$manager = new PhotoPostModel;
$result = $manager->like();

if ($result) {

    $post = $manager->fetchOnePhotoPostData($_POST['photoId']);

    echo "<div class='postInfo' name='postInfo'>";
    echo "<img class='photo' src='$post->photoURL'>";
    echo "Posted by $post->username ";
    echo "$post->creationTime<br>";
    echo "<button name='like' onclick='like(this)'>Like $post->likes</button>";
    echo "<button name='commentButton' onclick='showHideCommentForm(this)'>Comment $post->comments</button>";
    echo "</div>";

    // Hidden panel that opens with click on commentButton
    echo "<div class='comment-form' name='commentForm' hidden>";
    // Previous comments
    echo "<div class='old-comments'>";
    $comments = $manager->fetchCommentsById($post->id);
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


