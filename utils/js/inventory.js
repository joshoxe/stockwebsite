
function addEventListeners() {
    addTableEventListeners();
    this.addEventListener('click', function() {
        resetTable();
    })
}

function addTableEventListeners() {
    // Add a double click event listener for every cell in our inventory table
    // used to change the cell to an input field for changing data
    var row = document.getElementById("inventory_table").rows;

    for (var i = 0; i < row.length; i++) {
        for (var j = 0; j < row[i].cells.length; j++) {
            row[i].cells[j].addEventListener('dblclick', function() {
                cellClick(this);
            })
        }
    }
}

function cellClick(cell) {
    // Change the clicked cell to an input field

    // Don't change if the cell is already an input field
    if(cell.children.length > 0) {
        if (cell.children[0].getAttribute("type") == "text") {
            return;
        }
    }
    cell.innerHTML = "<input type='text' name='edit' value = '" + cell.innerHTML + "'>";
    // Add an event listener for the Enter key, for submitting the input data 
    cell.addEventListener('keypress', function(e) {
        cellEnter(e.which, this);
    })
}

function cellEnter(key, cell) {
    // Get each field for the updated element and send it to the server
    if (key === 13) {
        // The row of the clicked cell contains all information for the item
        // loop through and create an object
        var item = {"id":cell.getAttribute("item")};
        console.log(item['id']);
        var row = cell.parentNode.rowIndex;
        var table = document.getElementById("inventory_table").rows;

        for (var i = 0; i < table[row].cells.length; i++) {
            if (table[row].cells[i].children.length > 0) {
                // An object of item name => item value
                item[table[row].cells[i].getAttribute("name")] = table[row].cells[i].children[0].value;
            } else {
            item[table[row].cells[i].getAttribute("name")] = table[row].cells[i].innerHTML;
            }
        }
        
        updateRecord(item['id'], item['name'], item['console'], item['qty'], item['price']);
        cell.innerHTML = "<td>" + document.getElementsByName("edit")[0].value + "</td>";
    }
}

function resetTable() {
    // TODO: There is a bug with selecting fields where multiple inputs can be created at the same time
    // need this function to reset all cells to table cells when the screen is clicked
    var fields = document.getElementsByName("edit");
    fields[0].innerHTML = "h";

}

function updateRecord(id, name, console, qty, price) {
    // Use AJAX to send a POST request to the server to update a record
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../utils/php/inventory_database.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send("updateId=" + id + "&updateName=" + name + "&updateConsole=" + console + "&updateQty=" + qty + "&updatePrice=" + price);
}