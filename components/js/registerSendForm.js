function sendForm() {

    let username = document.getElementById('username');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let data = [];

    data['username'] = username.value;
    data['email'] = email.value;
    data['password'] = password.value;

    ajaxRequest(data, 'manageRegistration', done);

}

function done() {
    if (this.readyState == 4 && this.status == 200
        && this.responseText != false)
    {
        if (this.responseText === "Success") {
            message('Success!! <br> Confirmation link was sent to your email');
        } else {
            message(this.responseText);
        }
    }
}