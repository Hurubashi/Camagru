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
<body>

<?php include_once (ROOT . '/views/header.php'); ?>

<div class="container">
    <?php

    include_once ROOT . '/models/PhotoPostModel.php';

    $manager = new PhotoPostModel;
    $posts = $manager->fetchPhotoPosts();

    foreach ($posts as $elem) {

        // Photo and its info
        echo "<div class='photoPost' name='photoPost' id='$elem->id'>";
            echo "<div class='postInfo' name='postInfo'>";
                echo "<img class='photo' src='$elem->photoURL'>";
                echo "Posted by $elem->username";
                echo "$elem->creationTime<br>";
                echo "<button name='like'>Like $elem->likes</button> ";
                $num = $manager->countComments($elem->id);
                echo "<button name='commentButton' onclick='showHideCommentForm(this)'>Comment $num</button>";
            echo "</div>";

            // Hidden panel that opens with click on commentButton
            echo "<div class='comment-form' name='commentForm' hidden>";
                // Previous comments
                echo "<div class='old-comments'>";
                    $posts = $manager->fetchCommentsById($elem->id);
                    foreach ($posts as $elem) {
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

    function sendComment(param){
        let parent = param.parentElement.parentElement;
        let form = parent.getElementsByClassName('comment-form');
        let text = form[0].getElementsByTagName('textarea');
        let data = [];
        data['text'] = text[0].value;
        data['photoId'] = parent.id;
        let callBackFunc = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText != false) {
                    var comments = parent.getElementsByClassName('old-comments');
                    comments[0].innerHTML = this.responseText;
                }
            }
        };
        ajaxRequest(data, 'saveComment', callBackFunc);


        /********************************************/
        let autor = "<?php echo $_SESSION['username'] ?>";
        let time = new Date();

        var options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric'
        };
        time = time.toLocaleString("ru", options);
        createCommentElement(form[0], autor, time,text[0].value);
        /********************************************/
    }

    function showHideCommentForm(param) {
        let parent = param.parentElement.parentElement;
        let form = parent.getElementsByClassName('comment-form');
        form[0].hidden = !form[0].hidden;
    }

    function createCommentElement(parent, autor, time, text) {
        var btn = document.createElement("div");
        var p = document.createElement("p");
        btn.className = 'orange';
        btn.appendChild(p);

        p.innerHTML = 'autor: ' + autor + 'time: ' + time + 'text: ' + text;
        parent.appendChild(btn);
    }
</script>


</body>

</html>
