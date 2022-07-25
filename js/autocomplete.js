document.addEventListener("DOMContentLoaded", function(event) {

   const url = "https://api.boardgameatlas.com/api/search?client_id=OTe7e3tbBL&fields=name&name=";

    var options = {
        url: function(phrase) {
            return url + phrase;
        },
        listLocation: "games",
        getValue: "name",
        theme: "dark",
    };

    $("input#guess").easyAutocomplete(options);
    $(".form-guess").hide();

})