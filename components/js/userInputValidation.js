
/************************************************/
/*********** Password validation ****************/
/************************************************/

function validatePassword(password, cPassword){
    // Check password pattern
    let regExp = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$/;
    let result = regExp.test(password.value);
    if (result == false) {
        password.setCustomValidity("Password between 6 and 15 characters; " +
            "must contain at least one lowercase letter, one uppercase letter, " +
            "one numeric digit, but cannot contain whitespace.");
    } else {
        password.setCustomValidity("");
    }
    // Check if passwords match
    if(password.value !== cPassword.value) {
        cPassword.setCustomValidity("Passwords Don't Match");
    } else {
        cPassword.setCustomValidity('');
    }
}

/************************************************/
/*********** Email validation *******************/
/************************************************/

function validateEmail(email)
{
    let regExp = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    let result = regExp.test(email.value);
    if (result == false) {
        email.setCustomValidity("Email incorrect");
    } else {
        email.setCustomValidity("");
    }
}
