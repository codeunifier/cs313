function loadSearchResults(cards) {
    var container = $("#resultsContainer");
    var template = document.getElementById("cardTemplate");

    container.html("");

    cards.forEach(function (card) {
        var clone = document.importNode(template.content, true);
        
        clone.querySelector(".card-image img").src = card.imageUrl;
        clone.querySelector(".card-name").innerText = card.name;
        clone.querySelector(".card-cost .cost-container").innerHTML = convertManaCostToSymbols(card.manaCost);
        clone.querySelector(".card-type").innerText = card.type;
        clone.querySelector(".card-set").innerText = card.set;
        clone.querySelector(".card-desc").innerText = card.text;

        $(container).append(clone);
    });
}