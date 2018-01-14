$(document).ready(function() {
    if($(".splash").is(":visible")) {
        $(".content").css({"opacity":"0"});
    }

    $(".splash-arrow").click(function() {
        $(".splash").slideUp("800", function() {
            $(".content").delay(100).animate({"opacity":"1.0"},800);
        });
    });
});

$(window).scroll(function() {
    $(window).off("scroll");
    $(".splash").slideUp("800", function() {
        $("html, body").animate({"scrollTop":"0px"},100);
        $(".content").delay(100).animate({"opacity":"1.0"},800);
    });
});