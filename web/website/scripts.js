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