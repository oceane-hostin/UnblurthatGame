$(document).ready(function () {
    let navMobile = $("#nav-mobile");
    $("#show-mobile").click(function () {
        navMobile.removeClass("hidden");
    });
    $("#hide-mobile").click(function () {
        navMobile.addClass("hidden");
    });
});