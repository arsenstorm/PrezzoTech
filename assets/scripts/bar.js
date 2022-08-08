// create function to reload window when called
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
function updateDatabase(name, done) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "https://prezzo.tech/bar/update.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("name=" + name + "&done=" + done);
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
    document.querySelectorAll("#yesBtn").forEach(function(element) {
        element.addEventListener("click", function() {
            var done = element.parentNode.innerHTML;
            done = parseInt(done);
            done++;
            var name = element.parentNode.parentNode.childNodes[0].innerHTML;
            updateDatabase(name, done);
            element.parentNode.innerHTML = done + "&nbsp;&nbsp;<input type=\"button\" id=\"noBtn\" class=\"tableBtn\" value=\"Uncomplete\"></input>";
            runButtonListeners();
        });
    });
    document.querySelectorAll("#noBtn").forEach(function(element) {
        element.addEventListener("click", function() {
            var done = element.parentNode.innerHTML;
            done = parseInt(done);
            done--;
            var name = element.parentNode.parentNode.childNodes[0].innerHTML;
            updateDatabase(name, done);
            if(done == 0) {
                element.parentNode.innerHTML = done + "&nbsp;&nbsp;<input type=\"button\" id=\"yesBtn\" class=\"tableBtn\" value=\"Complete\"></input></input>";
            } else {
                element.parentNode.innerHTML = done + "&nbsp;&nbsp;<input type=\"button\" id=\"noBtn\" class=\"tableBtn\" value=\"Uncomplete\"></input>";
            }
            runButtonListeners();
        });
    });
}