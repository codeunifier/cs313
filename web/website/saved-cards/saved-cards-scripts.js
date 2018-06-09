var mtg = new mtgApi();

function setCardData(multiverseId) {
    mtg.getCardByMultiverse(multiverseId).done(function(response) {
        $("#card_" + multiverseId).html("<a class='card-link'><img class='card-img-small' src=\"" + response.card.imageUrl + "\"></a>");
        $("#cardName_" + multiverseId).html("<span>" + response.card.name + "</span>");
        $("#cardCost_" + multiverseId).html("<div class='cost-container'>" + convertManaCostToSymbols(response.card.manaCost) + "</div>");
        $("#cardText_" + multiverseId).html("<span class='text-visible'>" + response.card.originalText + "</span>");

        //img click function
        $("#card_" + multiverseId + " img").click(function () {
            console.log("img clicked");
            toggleResultsCardSize(this, multiverseId);
        });
    });
}