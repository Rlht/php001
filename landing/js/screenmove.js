var $arrow = $("#arrow");
var $off = $("main").offset().top;

$("#arrow").on("click", function () {
    $("body,html").animate({
        scrollTop: $off
    }, 1200)
})
