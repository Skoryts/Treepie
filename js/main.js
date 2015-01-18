

/*-----------------------SideBar----------------------*/
$(document).ready(function(){
  $(".navigation span").click(function(){
    $(this).siblings(".toggle-menu").slideToggle(100);
  });
 	$(".filter").click(function () {
 		$(".filter-menu").slideToggle(100);
 	});
});
/*-----------------------Filter----------------------*/
		var mas = "";
		$(document).ready(function(){
		  $(".filter-tag").on("click", function() {
						
							if (mas != $(".filter-menu ul li")){
								$(".filter-search div ul").prepend("<li>" + this.textContent + "</li>");
								mas = $(".filter-search li");
							}
		
		 	$(".filter-search li").on("click", function() {
		    $(this).remove();
		  });
		});
	});



