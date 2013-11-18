$(document).ready(function(){
		$('.menu li ul.sub-menu').css('display', 'none');				   
		$('.menu li').hover(
			function() { $('> ul', this).css('display', 'block');},
			function() { $('> ul', this).css('display', 'none');}
		);

		
		$('.menu li').hover(
			function() { $(this).addClass("current-menu-item");},
			function() { $(this).removeClass("current-menu-item");}
		);
	});