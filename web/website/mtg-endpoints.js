var mtgApi = function () {
    return {
        getCardByMultiverse: function (id) {
            var deferred = $.Deferred();

            $.ajax({
                type: "GET",
                url: "https://api.magicthegathering.io/v1/cards/" + id,
                data: {},
                success: function (data) { 
                    if (data != null) {
                        deferred.resolve(data);
                    }
                },
                error: function(request, textStatus, errorThrown) { 
                    if (request.status === 404) {
                        deferred.resolve({ error: "Could not find card by id: " + id });
                    }
                },
                dataType: "json"
            });

            return deferred.promise();
        },
        searchCards: function(criteria) {
            var deferred = $.Deferred();

            $.ajax({
                type: "GET",
                url: "https://api.magicthegathering.io/v1/cards?" + criteria + "&page=1&pageSize=99",
                data: {},
                success: function (data) { 
                    if (data != null) {
                        deferred.resolve(data);
                    }
                },
                error: function(request, textStatus, errorThrown) { 
                    if (request.status === 404) {
                        deferred.resolve({ error: "Something" });
                    }
                    console.log("Error: " + textStatus);
                },
                dataType: "json"
            });

            return deferred.promise();
        },
        getFormats: function() {
            var deferred = $.Deferred();

            $.ajax({
                type: "GET",
                url: "https://api.magicthegathering.io/v1/formats",
                data: {},
                success: function (data) { 
                    if (data != null) {
                        deferred.resolve(data);
                    }
                },
                error: function(request, textStatus, errorThrown) { 
                    if (request.status === 404) {
                        deferred.resolve({ error: "Something" });
                    }
                },
                dataType: "json"
            });

            return deferred.promise();
        }
    }
}