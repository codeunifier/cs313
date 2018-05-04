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