

/*-----------------------SideBar----------------------*/
$(document).ready(function(){
	var lol;
  $(".navigation span").click(function(){
  	lol = $(this).next();

  	if (lol.text() != ""){
	    $(this).next().toggle("slide", {direction: "right"}, 500);
	  	$(".navigation span").toggle("slide", {direction: "left"}, 500);
		}
  });
 	$(".filter").click(function () {
 		$(".filter-menu").slideToggle(100);
 	});
/*-----------------------Filter----------------------*/
var mas = [];
var a = "";

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
