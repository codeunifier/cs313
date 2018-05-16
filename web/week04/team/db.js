function loadDatabaseScript() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("sqlScript").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "sql-script-updated.sql", true);
    xhttp.send();
}