function loadSearchResults(cards) {
    var container = $("#resultsContainer");
    var template = document.getElementById("cardTemplate");

    container.html("");

    cards.forEach(function (card) {
        var clone = document.importNode(template.content, true);
        
        clone.querySelector(".card-image img").src = card.imageUrl ? card.imageUrl : "images/blank-card.jpg";
        clone.querySelector(".card-name").innerText = card.name;
        clone.querySelector(".card-cost .cost-container").innerHTML = convertManaCostToSymbols(card.manaCost);
        clone.querySelector(".card-type").innerText = card.type;
        clone.querySelector(".card-set .ss").classList.add("ss-" + card.set.toLowerCase());
        clone.querySelector(".card-set .ss").classList.add("ss-" + RARITY[card.rarity]);
        clone.querySelector(".card-set .card-set-name").innerText = card.set;
        clone.querySelector(".card-desc").innerText = card.text;
        // clone.querySelector(".card-desc").innerText = card.text ? parseForManaSymbols(card.text) : "";

        $(container).append(clone);
    });

    //set click listeners on cards
    $(".card-image img").each(function (index) {
        $(this).click(function() {
            toggleResultsCardSize(this);
        });
    });
}

function createSaveButtons(cards) {
    $('.card-save').each(function(index) {
        var buttonElm = document.createElement('button');
        buttonElm.setAttribute('id', 'btnSave_' + cards[index].multiverseid);
        buttonElm.setAttribute('value', cards[index].multiverseid);
        buttonElm.setAttribute('onclick', 'onSaveButtonClick(value)');
        buttonElm.innerHTML = "Save";
        $(this).append(buttonElm);
    });
}

function onSaveButtonClick(value) {
    $.ajax({
        type: "POST",
        url: "save-card.php",
        data: {id: value},
        success: function (data) { 
            if (data != null) {
                if (data.error == null) {
                    if (data == 0) {
                        $('#btnSave_' + value).html('Already saved!');
                    } else {
                        $('#btnSave_' + value).html('Saved!');
                    }

                    $('#btnSave_' + value).prop('disabled', true);
                }
            }
        },
        error: function(request, textStatus, errorThrown) { 
            if (request.status === 404) {
                deferred.resolve({ error: "Something" });
            }
        },
        dataType: "json"
    });
}