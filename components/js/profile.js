/************************************************/
/********** Init Variables **********************/
/************************************************/

const edit = {
    none: 0,
    name: 1,
    email: 2,
    password: 3
};

var userWant = edit.none;

/************************************************/
/********** Getting Elements by Id **************/
/************************************************/

let inputsDiv = document.getElementById('inputsDiv'),
    confirm = document.getElementById('confirm'),
    cancel = document.getElementById('cancel'),
    changeNameButton = document.getElementById('changeName'),
    changeEmailButton = document.getElementById('changeEmail'),
    changePasswordButton = document.getElementById('changePassword');

/************************************************/
/********** Creating Elements *******************/
/************************************************/

let header = document.createElement('h2');

let password = document.createElement('input');
password.type = "password";
password.placeholder = "Password";
password.id = "password";
password.required = true;

let newName = document.createElement('input');
newName.placeholder = "New Username";
newName.id = "username";
newName.minLength = 3;
newName.required = true;

let newEmail = document.createElement('input');
newEmail.placeholder = "New Email";
newEmail.id = "email";
newEmail.required = true;
newEmail.onkeyup = function () {
    validateEmail(newEmail);
};

let newPassword = document.createElement('input');
newPassword.placeholder = "New Password";
newPassword.type = "password";
newPassword.id = "newPassword";
newPassword.required = true;

let cNewPassword = document.createElement('input');
cNewPassword.placeholder = "Confirm New Password";
cNewPassword.type = "password";
cNewPassword.id = "cNewPassword";
cNewPassword.required = true;

newPassword.onkeyup = function () {
  validatePassword(newPassword, cNewPassword);
};

cNewPassword.onkeyup = function () {
    validatePassword(newPassword, cNewPassword);
};

/************************************************/
/********** Change Name *************************/
/************************************************/

function createChangeNameInputs() {
    header.textContent = "Change Name";
    password.placeholder = "Password";

    newName.value = "";
    password.value = "";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(newName);
    inputsDiv.appendChild(password);
}

function changeName() {
    userWant = edit.name;
    clearInputsDiv();
    switchButtons();
    createChangeNameInputs();
}

/************************************************/
/********** Change Email ************************/
/************************************************/

function createChangeEmailInputs() {
    header.textContent = "Change Email";
    password.placeholder = "Password";

    newEmail.value = "";
    password.value = "";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(newEmail);
    inputsDiv.appendChild(password);
}

function changeEmail() {
    userWant = edit.email;
    clearInputsDiv();
    switchButtons();
    createChangeEmailInputs();
}

/************************************************/
/********** Change Password *********************/
/************************************************/

function createChangePasswordInputs() {
    header.textContent = "Change Password";
    password.placeholder = "Old Password";

    newPassword.value = "";
    cNewPassword.value = "";
    password.value = "";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(newPassword);
    inputsDiv.appendChild(cNewPassword);
    inputsDiv.appendChild(password);
}

function changePassword() {
    userWant = edit.password;
    clearInputsDiv();
    switchButtons();
    createChangePasswordInputs();
}

/************************************************/
/*************** Send Form **********************/
/************************************************/

function sendForm() {
    let data = [];
    data['userWant'] = userWant;
    data['password'] = password.value;
    switch (userWant) {
        case edit.name:
            data['newUsername'] = newName.value;
            break;
        case edit.email:
            data['email'] = newEmail.value;
            break;
        case edit.password:
            data['newPassword'] = newPassword.value;
            break;
    }
    ajaxRequest(data, 'editProfile', done);
}

function done() {
    if (this.readyState == 4 && this.status == 200 && this.responseText != false) {
        if (this.responseText === "Done!") {
            switch (userWant) {
                case edit.name:
                    const currentName = document.getElementById('currentName');
                    currentName.innerText = "Username: " + newName.value;
                    break;
                case edit.email:
                    const currentEmail = document.getElementById('currentEmail');
                    currentEmail.innerText = "Email:: " + newEmail.value;
                    break;
            }
            cancelEditing();
        }
        message(this.responseText);
    }
}

/************************************************/
/********** Cancel Editing **********************/
/************************************************/

function cancelEditing() {
    userWant = edit.none;
    clearInputsDiv();
    switchButtons();
}

/************************************************/
/********** Support Functions *******************/
/************************************************/

function clearInputsDiv() {
    while (inputsDiv.firstChild) {
        inputsDiv.firstChild.remove();
    }
}

function switchButtons() {
    confirm.hidden = !confirm.hidden;
    cancel.hidden = !cancel.hidden;
    changeNameButton.hidden = !changeNameButton.hidden;
    changeEmailButton.hidden = !changeEmailButton.hidden;
    changePasswordButton.hidden = !changePasswordButton.hidden;
}
