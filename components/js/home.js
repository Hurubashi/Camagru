function like(param) {
    if (checkLoginStatus() === false) {
        return;
    }
    let parent = param.parentElement.parentElement;
    let postInfo = parent.getElementsByClassName('postInfo');
    let data = [];
    data['photoId'] = parent.id;
    let callBackFunc = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != false) {
                postInfo[0].innerHTML = this.responseText;
            }
        }
    };
    ajaxRequest(data, 'like', callBackFunc);
}

function sendComment(param){
    if (checkLoginStatus() === false) {
        return;
    }
    let parent = param.parentElement.parentElement;
    let form = parent.getElementsByClassName('comment-form');
    let oldComments = form[0].getElementsByClassName('old-comments');
    let text = form[0].getElementsByTagName('textarea');
    if (text[0].value == "") {
        return;
    }
    let data = [];
    data['text'] = text[0].value;
    data['photoId'] = parent.id;
    let callBackFunc = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != false) {
                text[0].value = "";
                oldComments[0].innerHTML = this.responseText;
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

function checkLoginStatus() {
    if (sessionStorage.getItem('status') != null) {
        return true;
    } else {
        window.location.href = "confirmation";
        return false;
    }
}