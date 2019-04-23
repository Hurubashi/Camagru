function sendForm() {

    let username = document.getElementById('username');
    let password = document.getElementById('password');
    let data = [];

    data['username'] = username.value;
    data['password'] = password.value;

    ajaxRequest(data, 'manageLogin', done);

}

function done() {
    if (this.readyState == 4 && this.status == 200
        && this.responseText != false)
    {
        if (this.responseText === "Success") {
            sessionStorage.setItem('status', 'loggedIn');
            window.location.href = "home";
        } else {
            message(this.responseText);
        }
    }
}