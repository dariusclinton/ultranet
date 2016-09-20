$(function () {
    $('#tabsWithStyle').tabs();

    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("active").addClass("btn-default");
        // $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("active");
    });

    jQuery("#slider1").revolution({
        sliderType: "standard",
        sliderLayout: "fullwidth",
        delay: 5000,
        lazyLoad: "off",
        //debugMode:true,
        navigation: {
            arrows: {enable: false}
        },
        gridheight: 400
    });

    $("#add-institution").click(function (ev) {
        ev.preventDefault();
        $("#select-institution-form").slideUp(500);
        $("#add-institution-block").fadeOut(200);
        $("#cancel-add-institution-block").fadeIn(200);
        $("#add-institution-form").slideDown(500);
    });

    $("#cancel-add-institution").click(function (ev) {
        ev.preventDefault();
        $("#select-institution-form").slideDown(500);
        $("#add-institution-block").fadeIn(200);
        $("#cancel-add-institution-block").fadeOut(200);
        $("#add-institution-form").slideUp(500);
    });
});