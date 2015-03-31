

$(document).ready(function(){
	var masMenu = $(".icon-menu").siblings();
	/*----------------icon-menu-----------------------------*/		
	  $(".icon-menu li").click(function(){
			var listIndex = $(this).index();
	  	/*----------close-open----------------*/	
	  	if (masMenu[listIndex].classList.contains("hidden") == false){
	  		masMenu.addClass("hidden");
	  		$(".icon-menu li").removeClass("active");
	  		return false;
	  	}
	  	if ($(".sidebar").css("height") == "96px") {	  		
		  	$(".navigation li div").css("right", "auto");
				$(".toggle-menu").hide().css("right", "-288px");
	  	} else {
	  		$(".navigation li div").css("left", "auto");
				$(".toggle-menu").hide().css("left", "288px");
	  	}
	  	masMenu.addClass("hidden");
	  	masMenu[listIndex].classList.remove("hidden");
	  	$(".icon-menu li").removeClass("active");
	  	$(this).addClass("active");
	  });
	  $(".login div").click(function(){
	  	masMenu.addClass("hidden");
	  	$(".registration").removeClass("hidden");
	  });


	
	if ($(".sidebar").css("height") == "96px") {
		var menuActive = "";
		/*-----------------------Toggle-slim-menu----------------------*/
	  $(".navigation li div").click(function(){
	  	if ($(this).next().text() != ""){
	  		$(".navigation li div").animate({right: "+=288px"}, 300);
	  		$(this).next().show().animate({right: "+=288px"}, 300);
	  	}
	  });
	} else {
		/*-----------------------Toggle-menu----------------------*/
	  $(".navigation li div").click(function(){
	  	if ($(this).next().text() != ""){
	  		$(".navigation li div").animate({left: "-=288px"}, 300);
	  		$(this).next().show().animate({left: "-=288px"}, 300);
	  	}
	  });
	}

});


	
	  


