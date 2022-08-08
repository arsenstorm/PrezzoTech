function reload() {
    window.location.reload();
}
// create function to reset table when called
function reset() {
    var x = confirm("Are you sure you want to reset the table?");
    if (x) {
        window.location.href = "./reset.php";
    }
}
function updateDatabase(name, amountRequired) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://prezzo.tech/stock/update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name + "&amountRequired=" + amountRequired);
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            if(xhr.responseText == "success") {
                // do nothing
            } else {
                console.log(xhr.responseText);
                //alert("Error updating database");
            }
        }
    }
}

function runButtonListeners() {
    document.querySelectorAll("#incrementBtn").forEach(function(element) {
        element.addEventListener("click", function() {
            var amountRequired = element.parentNode.innerHTML;
            amountRequired = parseInt(amountRequired);
            amountRequired++;
            var name = element.parentNode.parentNode.childNodes[0].innerHTML;
            updateDatabase(name, amountRequired);
            element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>&nbsp;&nbsp;<input type=\"button\" id=\"decrementBtn\" class=\"tableBtn\" value=\"-1\"></input>";
            runButtonListeners();
        });
    });
    document.querySelectorAll("#decrementBtn").forEach(function(element) {
        element.addEventListener("click", function() {
            var amountRequired = element.parentNode.innerHTML;
            amountRequired = parseInt(amountRequired);
            amountRequired--;
            var name = element.parentNode.parentNode.childNodes[0].innerHTML;
            updateDatabase(name, amountRequired);
            if(amountRequired == 0) {
                element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>";
            } else {
                element.parentNode.innerHTML = amountRequired + "&nbsp;&nbsp;<input type=\"button\" id=\"incrementBtn\" class=\"tableBtn\" value=\"+1\"></input>&nbsp;&nbsp;<input type=\"button\" id=\"decrementBtn\" class=\"tableBtn\" value=\"-1\"></input>";
            }
            runButtonListeners();
        });
    });
}