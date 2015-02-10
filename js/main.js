

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
});
