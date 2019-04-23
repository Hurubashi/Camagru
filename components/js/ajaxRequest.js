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