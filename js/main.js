$(document).ready(function () {
	$(".panel-menu").on("click", "div", function () {
		$(this).toggleClass("active").siblings("div").removeClass("active")
		if ($(this).hasClass("active")) {
			$(".popup-menu, .overlay").show();
			$(".popup-menu > div").hide();
			$(".popup-menu > div").eq($(this).index()).show();
		} else{
			$(".popup-menu, .overlay").hide();
		}
	});

	$(".main-nav").on("click", "a", function () {
		
	})
})