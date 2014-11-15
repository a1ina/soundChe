(function($) {
//ÐžÐ±Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° ÐºÐ»Ð¸ÐºÐ° Ð½Ð° ÑÑ‚Ñ€ÐµÐ»ÐºÑƒ Ð²Ð¿Ñ€Ð°Ð²Ð¾
    $(document).on('click', ".carousel-button-right",function(){
        var carusel = $(this).parents('.carousel');
        right_carusel(carusel);
        return false;
    });
//ÐžÐ±Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ° ÐºÐ»Ð¸ÐºÐ° Ð½Ð° ÑÑ‚Ñ€ÐµÐ»ÐºÑƒ Ð²Ð»ÐµÐ²Ð¾
    $(document).on('click',".carousel-button-left",function(){
        var carusel = $(this).parents('.carousel');
        left_carusel(carusel);
        return false;
    });
    function left_carusel(carusel){
        var block_width = $(carusel).find('.carousel-block').outerWidth();
        $(carusel).find(".carousel-items .carousel-block").eq(-1).clone().prependTo($(carusel).find(".carousel-items"));
        $(carusel).find(".carousel-items").css({"left":"-"+block_width+"px"});
        $(carusel).find(".carousel-items").animate({left: "0px"}, 200);
        $(carusel).find(".carousel-items .carousel-block").eq(-1).remove();
    }
    function right_carusel(carusel){
        var block_width = $(carusel).find('.carousel-block').outerWidth();
        $(carusel).find(".carousel-items").animate({left: "-"+ block_width +"px"}, 200);
        setTimeout(function () {
            $(carusel).find(".carousel-items .carousel-block").eq(0).clone().appendTo($(carusel).find(".carousel-items"));
            $(carusel).find(".carousel-items .carousel-block").eq(0).remove();
            $(carusel).find(".carousel-items").css({"left":"0px"});
        }, 300);
    }

    $(function() {
//Ð Ð°ÑÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ð¸Ñ€ÑƒÐ¹Ñ‚Ðµ ÑÑ‚Ñ€Ð¾ÐºÑƒ Ð½Ð¸Ð¶Ðµ, Ñ‡Ñ‚Ð¾Ð±Ñ‹ Ð²ÐºÐ»ÑŽÑ‡Ð¸Ñ‚ÑŒ Ð°Ð²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ñ‡ÐµÑÐºÑƒÑŽ Ð¿Ñ€Ð¾ÐºÑ€ÑƒÑ‚ÐºÑƒ ÐºÐ°Ñ€ÑƒÑÐµÐ»Ð¸
//	auto_right('.carousel:first');
    })

// ÐÐ²Ñ‚Ð¾Ð¼Ð°Ñ‚Ð¸Ñ‡ÐµÑÐºÐ°Ñ Ð¿Ñ€Ð¾ÐºÑ€ÑƒÑ‚ÐºÐ°
    function auto_right(carusel){
        setTimeout(function(){
            right_carusel(carusel);
            auto_right(carusel);
        }, 3000)
    }
})(jQuery);