$(function() {
   
   jQuery("#slider1").revolution({
        sliderType: "standard",
        sliderLayout: "fullwidth",
        delay: 5000,
        lazyLoad:"off",
		//debugMode:true,
        navigation: {
            arrows: {enable: false}
        },
        gridheight: 400
    });
});