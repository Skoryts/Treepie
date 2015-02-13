
$(document).ready(function(){
	
/*----------------Style >= 1400px-----------------------------*/
	if (screen.width >= 1400) {

		/*-----------------------SideBar----------------------*/
	  $(".navigation span").click(function(){
	  	var menu;
	  	menu = $(this).next();
	  	if (menu.text() != ""){
		    $(this).next().show().animate({left: "-=288px"}, 500);
		    $(".navigation span").animate({left: "-=288px"}, 500);
			}
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
	}
/*----------------Style <= 1399px-----------------------------*/
	if (screen.width <= 1399) {

		/*-----------------------SideBar----------------------*/
	  $(".navigation span").click(function(){
	  	var menu;
	  	menu = $(this).next();
	  	if (menu.text() != ""){
		    $(this).next().show().animate({right: "+=288px"}, 500);
		    $(".navigation span").animate({right: "+=288px"}, 500);
			}
	  });	
	  
	  /*----------------icon-menu-----------------------------*/
		var textId = "";
		$(".icon-menu li").click(function(){
			textId = $(this).children("span").attr("id");
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
			switch (textId) {
				case "menu":
					$(".icon-menu").siblings().addClass("hidden");
					$(".menu").removeClass("hidden");
					textId = "menuDown";
				break;
				case "login":
					$(".icon-menu").siblings().addClass("hidden");
					$(".login").removeClass("hidden");
					break;
				case "tags":
					$(".icon-menu").siblings().addClass("hidden");
					$(".tags").removeClass("hidden");
					break;
				case "search":
					$(".icon-menu").siblings().addClass("hidden");
					$(".search").removeClass("hidden");
					break;
			} 	
		});
	}
});

