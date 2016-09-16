$(function() {
    $('#tabsWithStyle').tabs();

    $(".btn-pref .btn").click(function() {
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
});