var addModelToCart = function (model) {
    var count = document.getElementById("modelCount_" + model).value;

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: { "model": model, "count": count },
        success: function (msg) {
            console.log("Model " + model + " added to cart");
            console.log(msg);
        }
    });
}