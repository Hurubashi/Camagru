<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
    <link href="/components/css/photoPost.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<?php

include_once ROOT . '/models/PostingManager.php';

$manager = new PostingManager;
$posts = $manager->fetchPhotoPosts();

foreach ($posts as $elem) {
    echo "
    <div class='photoPost' name='photoPost'>  
        <div class='postInfo' name='postInfo'>
        <img class='photo' src='$elem->photoURL'>
            Posted by $elem->username
            $elem->creationTime
            <br>
            <button name='like' id='like'>Like $elem->likes</button>            
            <button name='comment' id='comment'>Comment $elem->comments</button>
        </div>
        <form class='comment-form' name='commentForm' id='commentForm' hidden onsubmit='sendMessage();'>
            <textarea name='message' style='max-width: 300px'></textarea>
            <button type='submit'>Comment</button>
        </form>
    </div>
    ";
}

?>

</div>

<script>

    let likes = document.getElementsByName('like'),
        comments = document.getElementsByName('comment'),
        commentForms = document.getElementsByName('commentForm');

    var var_i = 0;
    for (const elem of comments) {

        const const_i = var_i;
        elem.addEventListener('click', function () {
            commentForms[const_i].hidden = !commentForms[const_i].hidden;
        });

        var_i++;
    }


    var_i = 0;
    for (const elem of likes) {

        const const_i = var_i;
        elem.addEventListener('click', function () {
            console.log('like num:', const_i);
        });

        var_i++;
    }
    
    function sendMessage() {
        
    }
</script>

</body>

</html>
