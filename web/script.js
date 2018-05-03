var faded = false;

var onButtonClick = function () {
    alert("Clicked!");
}

var onJSChangeColorClick = function () {
    var colorText = getColor();
    document.getElementById("jsColorChanger").style.backgroundColor = colorText;
}

var getColor = function () {
    return document.getElementById("jsColorInput").value;
}

var onJQChangeColorClick = function () {
    var colorText = $("#jqColorInput").val();
    $("#jqColorChanger").css("background-color", colorText);
}

var onFadeToggleClick = function () {
    faded = !faded;

    if (faded) {
        $(".toggle-fade").fadeOut();
    } else {
        $(".toggle-fade").fadeIn();
    }
}
