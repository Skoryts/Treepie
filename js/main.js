
$(document).ready(function(){
	var menuActive = "";
/*----------------Style >= 1400px-----------------------------*/
	if (window.innerWidth >= 1400) {
		$(".menu").removeClass("hidden");
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
	if (window.innerWidth <= 1399) {
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
		$(".icon-menu li").click(function(){
			var textId = "";
			textId = $(this).children("span").attr("id");
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
			switch (textId) {
				case "menu":	
					if (menuActive == "menu block"){
						$(".icon-menu").siblings().addClass("hidden");
						menuActive = ""
						break;
					} else {
							$(".icon-menu").siblings().addClass("hidden");
							$(".menu").removeClass("hidden");
							menuActive = "menu " + $(".menu").css("display");
							break;
						}
				case "login":
					if (menuActive == "login block"){
						$(".icon-menu").siblings().addClass("hidden");
						menuActive = ""
						break;
					} else {
						$(".icon-menu").siblings().addClass("hidden");
						$(".login").removeClass("hidden");
						menuActive = "login " + $(".login").css("display");
						break;
					}
				case "tags":
					if (menuActive == "tags block"){
						$(".icon-menu").siblings().addClass("hidden");
						menuActive = ""
						break;
					} else {
						$(".icon-menu").siblings().addClass("hidden");
						$(".tags").removeClass("hidden");
						menuActive = "tags " + $(".tags").css("display");
						break;
					}
				case "search":
					if (menuActive == "search block"){
						$(".icon-menu").siblings().addClass("hidden");
						menuActive = ""
						break;
					} else {
						$(".icon-menu").siblings().addClass("hidden");
						$(".search").removeClass("hidden");
						menuActive = "search " + $(".search").css("display");
						break;
					}
			} 	
		});
	}
});

