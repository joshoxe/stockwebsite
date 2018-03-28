function validateLogin() {
    var user = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;

    console.log(user);

    if (user == "" || password == "") {
        alert("Please fill in username and password");
        return false;
    }
}

function validateAddItem() {
    var name = document.forms["itemForm"]["addItemName"].value;
    var console = document.forms["itemForm"]["addItemConsole"].value;
    var stock = document.forms["itemForm"]["addItemStock"].value;
    var price = document.forms["itemForm"]["addItemPrice"].value;

    if (name == "" || console == "") {
        alert("Please fill in name and console");
        return false;
    }

    if (isNaN(stock) || isNaN(price)) {
        alert("Stock and price should be numeric");
        return false;
    }
}

function validateDelete() {
    var name = document.forms["deleteForm"]["removeName"].value;

    if (name == "") {
        alert("Please fill in a name");
        return false;
    }
}

