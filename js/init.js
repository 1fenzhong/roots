jQuery.noConflict();
(function($){
	$(function(){
		var is_single = ($('body.single').length);
		
		$('#header').css("visibility", "hidden");
		var setGrid = function () {
			return $("#grid-wrapper").vgrid({
				easeing: "easeOutQuint",
				time: 800,
				delay: 260,
				selRefGrid: "#grid-wrapper div.x1",
				selFitWidth: ["#container", "#footer"],
				gridDefWidth: 290 + 15 + 15 + 5,
				forceAnim: !is_single
			});
		};
		
		setTimeout(setGrid, 300);
		setTimeout(function() {
			$('#header').hide().css("visibility", "visible").fadeIn(500);
		}, 500);
		
		$(window).load(function(e){
			setTimeout(function(){ 
				// prevent flicker in grid area - see also style.css
				$("#grid-wrapper").css("paddingTop", "0px");
				if (is_single) {
					var anim_msec = $("#single-wrapper").height();
					if (anim_msec < 1000) anim_msec = 1000;
					if (anim_msec > 3000) anim_msec = 3000;
					$("#single-wrapper").css("paddingTop", "0px").hide().slideDown(anim_msec);
				}
			}, 1000);
		});

	}); // end of document ready
})(jQuery); // end of jQuery name space 
