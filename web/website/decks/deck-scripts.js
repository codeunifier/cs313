var showInputs = false;

function onNewDeckButtonClick() {
    showInputs = !showInputs;

    if (showInputs) {
        loadFormats();
    
        $("#btnNewDeck").removeClass('fa-plus');
        $("#btnNewDeck").addClass('fa-minus');
    } else {
        $("#btnNewDeck").removeClass('fa-minus');
        $("#btnNewDeck").addClass('fa-plus');
    }
    
    $("#newDeckInputsContainer")
        .stop(true, true)
        .animate({
            height:"toggle",
            opacity:"toggle"
        }, 600);
}

function getFormatData() {
    var deferred = $.Deferred();

    //only make an api call if it's needed

    var cookie = getCookie('mtg-formats');

    if (cookie) {
        console.log("Grabbing cookie from the cookie jar: mtg-formats");
        deferred.resolve(JSON.parse(cookie));
    } else {
        var mtg = new mtgApi();

        mtg.getFormats().done(function (response) {
            var formats = response.formats;

            for (var i = formats.length - 1; i >= 0; i--) {
                if (formats[i].includes("Block")) {
                    formats.splice(i, 1);
                }
            }

            //this index may need to be changed if the format list ever changes
            formats[0] += " (Casual)";

            //name, value, days
            console.log("Baking cookie: mtg-formats");
            
            setCookie('mtg-formats', JSON.stringify(formats), 7);
            deferred.resolve(formats);
        });
    }

    return deferred.promise();
}

function checkCreateDeckInputs() {
    var checkboxEnabled = false;

    $(".color-input input").each(function() {
        if($(this).is(":checked")) {
            checkboxEnabled = true;
        }
    });

    setCreateButtonDisable(!checkboxEnabled || $("#nameContainer input").val() == "");
}

function setCreateButtonDisable(shouldDisable) {
    $("#submitContainer input").prop("disabled", shouldDisable);
}