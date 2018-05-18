function apiTest() {
    $.ajax({
        type: "GET",
        url: "https://api.magicthegathering.io/v1/cards?name=inalla",
        data: {},
        success: function (data) { 
            var response = JSON.parse(data);
            $("#jsonCode").html(JSON.stringify(response, null, "\t"));
            $("#cardImage").html("<img src='" + response.cards[0].imageUrl + "'>");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        },
        dataType: "text"
    });
}

function loadSQLCode() {
    $.ajax({
        type: "GET",
        url: "create-db.sql",
        data: {},
        success: function (data) { 
            $("#sqlCode").html(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        },
        dataType: "text"
    });
}

function createHash(str) {
    var deferred = $.Deferred();

    $.ajax({
        type: "GET",
        url: "hasher.php",
        data: { data: str },
        success: function (data) { 
            deferred.resolve(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown); 
        },
        dataType: "text"
    });

    return deferred.promise();
}

function createUserHash() {
    var str = $("#userInput").val();
    
    createHash(str).done(function (hashed) {
        $("#hashed").html(hashed);
    });
}