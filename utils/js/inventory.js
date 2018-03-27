
function addEventListeners() {
    addTableEventListeners();

    // Group together computer & mobile event types and assign each one
    var types = ['click', 'touch'];

    for (type of types) {
        this.addEventListener(type, function(e) {
            resetTable(e.target);
        })

        document.getElementById("inventory_search").addEventListener(type, function() {
            if (document.getElementById("inv_search_box").value == "Search") {
                document.getElementById("inv_search_box").value = "";
            }
        })

        document.getElementById("inv_search_box").addEventListener(type, function() {
            if (this.value == "Search") {
                this.value = "";
            }
        })

        document.getElementById("system_select").addEventListener(type, function() {
            sendSearch();
        })
    }

    document.getElementById("inv_search_box").addEventListener('keyup', function(e) {
        sendSearch();
    })
}

function addTableEventListeners() {
    // Add a double click event listener for every cell in our inventory table
    // used to change the cell to an input field for changing data
    var row = document.getElementById("inventory_table").rows;
    var timer = null;

    for (var i = 0; i < row.length; i++) {
        for (var j = 0; j < row[i].cells.length; j++) {
            // Mobile event
            row[i].cells[j].addEventListener('touchstart', function(e) {
                // Start a timer to simulate a double-touch event
                if (timer == null) {
                    timer = setTimeout(function() {
                        timer = null;
                    }, 1000)
                } else {
                    resetTable(e.target);
                    e.preventDefault();
                    clearTimeout(timer);
                    timer = null;
                    cellClick(this);
                }
            })

            // Computer event
            row[i].cells[j].addEventListener('dblclick', function() {
                cellClick(this);
            })
        }
    }
}

function sendSearch() {
    // Send an AJAX search request to dynamically retrieve items
    var search = document.getElementById("inv_search_box").value;
    var system = document.getElementById("system_select").value;

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(search);
            console.log(system);
            console.log(this.responseText);
            document.getElementById("inventory_table").innerHTML = " <table id='inventory_table'> \n" +
            "<tr> \n" +
                "<th>Name</th> \n" +
               "<th>System</th> \n" +
                "<th>Stock</th> \n" +
                "<th>Price</th> \n" +
            "</tr> \n" +
            this.responseText +
           "</table>";

           // Re-add the event listeners for the cells
           addTableEventListeners();
        }
    }

    xhttp.open("POST", "../utils/php/inventory_database.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send("searchValue=" + search + "&searchConsole=" + system);

}

function cellClick(cell) {
    // Change the clicked cell to an input field
    // Don't change if the cell is already an input field or is a header field
    if(cell.children.length > 0 || cell.tagName == "TH") {
        if (cell.children[0].getAttribute("type") == "text") {
            return;
        }
    }
    var size = cell.innerHTML.length;
    cell.innerHTML = "<input type='text' style='width:" + size + "ex' name='edit' value = '" + cell.innerHTML + "'>";
    // Add an event listener for the Enter key, for submitting the input data 
    cell.addEventListener('keypress', function(e) {
        cellEnter(e.which, this);
    })
}

function cellEnter(key, cell) {
    // Ensure correct expected input
    var table = document.getElementById("inventory_table").rows;
    var headers = table[0];
    var header = headers.cells[cell.cellIndex].innerHTML;

    switch (header) {
        // Get the table header for the clicked cell
        // ensure that stock and price input is numeric

        case "Stock":
        case "Price":
            if (isNaN(document.getElementsByName("edit")[0].value)) {
                return;
            }
            break;
    }

    // Get each field for the updated element and send it to the server
    if (key === 13) {
        // The row of the clicked cell contains all information for the item
        // loop through and create an object
        var item = {"id":cell.getAttribute("item")};
        var row = cell.parentNode.rowIndex;

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

function resetTable(el) {
    if(el.getAttribute("type")) {
        return;
    }
    // When the document is clicked anywhere, reset the entire table to remove any input fields
    var fields = document.getElementsByName("edit");
    if (fields.length > 0) {
        fields[0].parentElement.innerHTML = document.getElementsByName("edit")[0].value;
    }

}

function updateRecord(id, name, console, qty, price) {
    // Use AJAX to send a POST request to the server to update a record
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../utils/php/inventory_database.php", true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send("updateId=" + id + "&updateName=" + name + "&updateConsole=" + console + "&updateQty=" + qty + "&updatePrice=" + price);
}