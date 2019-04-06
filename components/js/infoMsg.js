/*----------------------------------------------------------------------------------------------*/
// Shows massage with text passed to function
function message(text) {
    let msg = document.getElementById('msg');
    msg.className = "show";
    setTimeout(function () {
        msg.className = msg.className.replace("show", "");}, 3000);
    msg.innerHTML = text;
}