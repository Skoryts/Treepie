

/*-----------------------SideBar----------------------*/
$(document).ready(function(){
	var menu;
  $(".navigation span").click(function(){
  	menu = $(this).next();

  	if (menu.text() != ""){
	    $(this).next().show().animate({left: "-=288px"}, 500);
	    $(".navigation span").animate({left: "-=288px"}, 500);
		}
  });
 	$(".filter").click(function () {
 		$(".filter-menu").slideToggle(100);
 	});	
		

/*----------------icon-menu-----------------------------*/
	var textId = "";
	$(".icon-menu li").click(function(){
		textId = $(this).children("span").attr("id");
		$(this).siblings().removeClass("active");
		$(this).addClass("active");
		if (textId === "menu"){
			$(".icon-menu").siblings().addClass("hidden");
			$(".menu").removeClass("hidden");
		} else if (textId === "login") {
				$(".icon-menu").siblings().addClass("hidden");
				$(".login").removeClass("hidden");
		} else if (textId === "tags") {
				$(".icon-menu").siblings().addClass("hidden");
				$(".tags").removeClass("hidden");
		} else if (textId === "search") {
				$(".icon-menu").siblings().addClass("hidden");
				$(".search").removeClass("hidden");
		}
	});
});

