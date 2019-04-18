let inputsDiv = document.getElementById('inputsDiv'),
    confirm = document.getElementById('confirm'),
    cancel = document.getElementById('cancel'),
    changeNameButton = document.getElementById('changeName'),
    changeEmailButton = document.getElementById('changeEmail'),
    changePasswordButton = document.getElementById('changePassword');


/************************************************/
/********** Change Name *************************/
/************************************************/
function createChangeNameInputs() {

    var header = document.createElement('h2');
    header.textContent = "Change Name";

    var nameInput = document.createElement('input');
    nameInput.placeholder = "New Username";
    nameInput.id = "username";

    var passwordInput = document.createElement('input');
    passwordInput.type = "password";
    passwordInput.placeholder = "Password";
    passwordInput.id = "password";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(nameInput);
    inputsDiv.appendChild(passwordInput);

}

function changeName() {
    clearInputsDiv();
    switchButtons();
    createChangeNameInputs();

    let newUsername = document.getElementById('username'),
        password = document.getElementById('password');

}

/************************************************/
/********** Change Email ************************/
/************************************************/

function createChangeEmailInputs() {

    var header = document.createElement('h2');
    header.textContent = "Change Email";

    var emailInput = document.createElement('input');
    emailInput.placeholder = "New Email";
    emailInput.id = "username";

    var passwordInput = document.createElement('input');
    passwordInput.type = "password";
    passwordInput.placeholder = "Password";
    passwordInput.id = "password";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(emailInput);
    inputsDiv.appendChild(passwordInput);

}

function changeEmail() {
    clearInputsDiv();
    switchButtons();
    createChangeEmailInputs();

    let newEmail = document.getElementById('email'),
        password = document.getElementById('password');

}

/************************************************/
/********** Change Password *********************/
/************************************************/

function createChangePasswordInputs() {

    var header = document.createElement('h2');
    header.textContent = "Change Password";

    var newPassword = document.createElement('input');
    newPassword.placeholder = "New Password";
    newPassword.type = "password";
    newPassword.id = "newPassword";

    var cNewPassword = document.createElement('input');
    cNewPassword.placeholder = "Confirm New Password";
    cNewPassword.type = "password";
    cNewPassword.id = "cNewPassword";

    var passwordInput = document.createElement('input');
    passwordInput.type = "password";
    passwordInput.placeholder = "Old Password";
    passwordInput.id = "password";

    inputsDiv.appendChild(header);
    inputsDiv.appendChild(newPassword);
    inputsDiv.appendChild(cNewPassword);
    inputsDiv.appendChild(passwordInput);

}

function changePassword() {
    clearInputsDiv();
    switchButtons();
    createChangePasswordInputs();

    let newEmail = document.getElementById('email'),
        password = document.getElementById('password');
}

/************************************************/
/********** Cancel Editing **********************/
/************************************************/

function cancelEditing() {
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