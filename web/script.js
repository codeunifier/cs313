var addClick = function () {
    $.ajax({
        type: "POST",
        url: "click.php",
        data: {},
    }).done(function (msg) {
        $("#clickNum").html(msg);
        // alert(msg);
    });
}

var setInitialClickCount = function () {
    $.ajax({
        type: "GET",
        url: "click.php",
        data: {},
    }).done(function (count) {
        $("#clickNum").html(count);
    })
}