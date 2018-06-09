/*
* Inalla: 433279
* Arahbo: 433276
* Ur-Dragon: 433289
* Edgar Markov: 433277
*/

var CRITERIA_LIST = ["name", "layout", "cmc", "colors", "colorIdentity",
                "type", "supertypes", "types", "rarity", "set", 
                "setName", "text", "flavor", "artist", "number",
                "power", "toughness", "loyalty", "language",
                "gameFormat", "legality", "page", "pageSize", "orderBy",
                "random", "contains", "id", "multiverseId"];

function isArray(value) {
    return value && typeof value === 'object' && value.constructor === Array;
}

function buildCardSearchURL(criteriaToBuild) {
    var url = "";

    for (var i = 0; i < CRITERIA_LIST.length; i++) {
        if (criteriaToBuild[CRITERIA_LIST[i]]) {
            url += CRITERIA_LIST[i] + "=" + criteriaToBuild[CRITERIA_LIST[i]];
        }
    }

    return url;
}

function convertManaCostToSymbols(manaCost) {
    var html = "";

    //some cards won't have a mana cost
    if (manaCost) {
        // remove brackets
        manaCost = manaCost.split("}").join("").split("{");
        manaCost.shift();
        
        for (var i = 0; i < manaCost.length; i++) {
            html += "<i class=\"ms ms-cost ms-" + manaCost[i].toLowerCase() + "\"></i>";
        }
    }

    return html;
}

function loadHeader() {
    var deferred = $.Deferred();

    $.ajax({
        type: "GET",
        url: "/website/header.html",
        data: "",
        success: function (data) { 
            if (data != null) {
                deferred.resolve(data);
            }
        },
        error: function(request, textStatus, errorThrown) { 
            console.log("Error in loading header:");
            console.log(textStatus);
        },
        dataType: "html"
    });

    return deferred.promise();
}

function toggleResultsCardSize(e, multiverseId) {
    console.log(e);
    $(e).toggleClass("card-img-small card-img-big");
    $("#cardText_" + multiverseId + " span").toggleClass("text-visible text-hidden");
}

var RARITY = {
    "Common": "common",
    "Uncommon": "uncommon",
    "Rare": "rare",
    "Mythic Rare": "mythic"
}

// function parseForManaSymbols(oldText) {
//     var text = oldText;

//     if (text.includes)
// }