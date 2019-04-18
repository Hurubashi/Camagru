<html>
<head>
    <title>Main</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/components/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">
    <link href="/components/css/photoPost.css" rel="stylesheet" type="text/css" />
</head>

<?php include_once (ROOT . '/views/header.php'); ?>
<body>

<div class="container">
    <?php

    include_once ROOT . '/models/PhotoPostModel.php';

    $manager = new PhotoPostModel;
    $posts = $manager->fetchAllPhotoPostsData();

    foreach ($posts as $post) {

        // Photo and its info
        echo "<div class='photoPost' name='photoPost' id='$post->id'>";
            echo "<div class='postInfo' name='postInfo'>";
                echo "<img class='photo' src='$post->photoURL'>";
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
                        echo "<p>$elem->text</p><br>";
                    }
                echo "</div>";
            // Filed to create new comment
                echo "<textarea name='message' style='max-width: 300px'></textarea>";
                echo "<button type='submit' onclick='sendComment(this)'>Send</button>";
            echo "</div>";
        echo "</div>";
    }

    ?>
</div>

<script>

    function ajaxRequest(data, managerFile, callback) {

        var request = new XMLHttpRequest();

        request.open("POST", managerFile);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        var params = [];

        for (let elem in data) {
            params = params + (elem + "=" + data[elem] + "&");
        }

        request.onreadystatechange = callback;
        request.send(params);
    }

    function like(param) {
        console.log('liked');
        let parent = param.parentElement.parentElement;
        console.log(parent);
        let data = [];
        data['photoId'] = parent.id;
        let callBackFunc = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != false) {
                    parent.innerHTML = this.responseText;
                }
            }
        };
        ajaxRequest(data, 'like', callBackFunc);
    }

    function sendComment(param){
        let parent = param.parentElement.parentElement;
        let form = parent.getElementsByClassName('comment-form');
        let text = form[0].getElementsByTagName('textarea');
        if (text[0].value == "") {
            console.log('empty');
            return;
        }
        let data = [];
        data['text'] = text[0].value;
        data['photoId'] = parent.id;
        let callBackFunc = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText != false) {
                    parent.innerHTML = this.responseText;
                }
            }
        };
        ajaxRequest(data, 'saveComment', callBackFunc);
    }

    function showHideCommentForm(param) {
        let parent = param.parentElement.parentElement;
        let form = parent.getElementsByClassName('comment-form');
        form[0].hidden = !form[0].hidden;
    }

</script>


</body>

</html>
