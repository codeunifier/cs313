<?php
    session_start();

    if (isset($_POST["search"])) {
        $searchText = $_POST["search"];
    } else {
        $searchText = "";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Infinite Springs</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="/website/mtg-icons/css/mana.css" rel="stylesheet" type="text/css" />
        <link href="/website/mtg-set-icons/css/keyrune.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="/website/style.css"> 
        <script type="text/javascript" src="/website/mtg-endpoints.js"></script>
        <script type="text/javascript" src="/website/scripts.js"></script>
        <script type="text/javascript" src="/website/search/search-scripts.js"></script>
        <link rel="stylesheet" href="/website/search/search-styles.css">
        <script type="text/javascript">
            loadHeader().done(function(html) {
                $("#headerPlaceholder").html(html);
            });

            var mtg = new mtgApi();

            mtg.searchCards("name=<?php echo($searchText); ?>").done(function(results) {
                if (results.cards.length == 0) {
                    $("#cardPlaceholder").html("No cards found from search: <?php echo($searchText); ?>");
                } else {
                    loadSearchResults(results.cards);
                    createSaveButtons(results.cards);
                }
            });
        </script>
    </head>
    <body>
        <header>
            <div id="headerPlaceholder"></div>
        </header>
        <template id="cardTemplate">
            <div class="card-result">
                <div class="card-image"><img class='card-img-small' src=""></div>
                <div class="details-container">
                    <div class="card-name"></div>
                    <div class="card-cost"><div class="cost-container"></div></div>
                    <div class="card-type"></div>
                    <div class="card-set"><span class='card-set-name'></span><i class='ss ss-grad ss-onehalfx'></i></div>
                    <div class="card-desc"></div>
                    <div class="card-save"></div>
                    <div class="card-pwrtgh"></div>
                </div>
            </div>
        </template>
        <div id="searchContainer">
            <div id="resultsText"><span>Showing results for: "<?php echo($searchText); ?>"</span></div>
            <div id="resultsContainer">
                <div>Loading search results...</div>
            </div>
        </div>
        <footer></footer>
    </body>
</html>