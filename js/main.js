

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
		var mas = [];
		var a = "";

		$(document).ready(function(){
		  $(".filter-tag").on("click", function() {
  	 	a = $(this).text().slice(1);
			mas = $(".filter-search li").text().split("#").slice(1);

  		if (mas.indexOf(a) == -1){
				$(".filter-search div ul").prepend("<li>" + this.textContent + "</li>");
			}

		 	$(".filter-search li").on("click", function() {
		    $(this).remove();
		  });
		});
	});

/*-----------------------Article----------------------*/

/*$( function() {
  
  $('.content').isotope({
    layoutMode: 'fitColumns',
    itemSelector: '.article'
  });
});
*/


