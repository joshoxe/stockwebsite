function validateLogin() {
    var user = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;

    console.log(user);

    if (user == "" || password == "") {
        alert("Please fill in username and password");
        return false;
    }
}