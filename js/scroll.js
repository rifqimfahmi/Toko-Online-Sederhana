$(".innerNav a.animate").click(function(e){
	e.preventDefault();
	var href = $(this).attr("href");
	$("html, body").animate({
		scrollTop: $(href).offset().top -50
	}, 900);
});

$(document).ready(function(){
	$(window).scroll(function(){
		var navigation = $(".navigation").offset();

		if($(this).scrollTop() > 100){
			$(".toTop").fadeIn();
		} else {
			$(".toTop").fadeOut();
		}
	});
	$(".toTop").click(function(){
		$("html, body").animate({
			scrollTop: 0
		}, 500);
	});
});

$(document).ready(function() {
  var navpos = $('.navigation').offset();
  console.log(navpos.top);
    $(window).bind('scroll', function() {
      if ($(window).scrollTop() > navpos.top) {
        $('.navigation').addClass('fixed');
       }
       else {
         $('.navigation').removeClass('fixed');
       }
    });
});
