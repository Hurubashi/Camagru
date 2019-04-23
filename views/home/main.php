<html>
<head>
    <title>Main</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/photoPost.css" rel="stylesheet" type="text/css" />
    <link href="/components/css/makePhoto.css" rel="stylesheet" type="text/css" />
    <link href="/components/css/infoMsg.css" rel="stylesheet" type="text/css" />
</head>

<?php include_once (ROOT . '/views/header.php'); ?>
<body>

<div class="container mainFrame">
    <?php

    include_once ROOT . '/models/PhotoPostModel.php';

    $manager = new PhotoPostModel;
    $posts = $manager->fetchAllPhotoPostsData();
    echo "<div id=\"msg\"></div>";
    foreach ($posts as $post) {

        // Photo and its info
        echo "<div class='photoPost mainFrame' name='photoPost' id='$post->id'>";
            echo "<div class='postInfo' name='postInfo'>";
                echo "<img class='photo mainFrame' src='$post->photoURL'>";
                echo "Posted by $post->username ";
                echo "$post->creationTime<br>";
                echo "<button name='like' onclick='like(this)'>Like $post->likes</button> ";
                echo "<button name='commentButton' onclick='showHideCommentForm(this)'>Comment $post->comments</button>";
            echo "</div>";

            // Hidden panel that opens with click on commentButton
            echo "<div class='comment-form' name='commentForm' hidden>";
                // Previous comments
                echo "<div class='old-comments'>";
                    $comments = $manager->fetchCommentsById($post->id);
                    foreach ($comments as $elem) {
                        echo "<p style=\"display:inline\">$elem->username </p><p style=\"display:inline\">$elem->creationTime</p>";
                        echo "<p style='word-wrap: break-word'>$elem->text</p><br>";
                    }
                echo "</div>";
            // Filed to create new comment
                echo "<textarea name='message' class='mainFrame' style='min-width: 100%; max-width: 100%; min-height: 30px'></textarea>";
                echo "<button class='actionButton' type='submit' onclick='sendComment(this)'>Send</button>";
            echo "</div>";
        echo "</div>";
    }

    ?>
</div>

<script src="/components/js/infoMsg.js"></script>
<script src="/components/js/ajaxRequest.js"></script>
<script src="/components/js/home.js"></script>

</body>

</html>
