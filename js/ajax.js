function searchmongo(searchfield) {
    if (searchfield.length == 0) { 
        document.getElementById("results").innerHTML = "Type something";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("results").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "searchmongo.php?q=" + searchfield, true);
        xmlhttp.send();
    }
}