$(document).ready(function(){
		$('.menu li ul.sub-menu').css('display', 'none');				   
		
		$('.main-nav .menu li').hover(
			function() { $('> ul', this).css('display', 'block');},
			function() { $('> ul', this).css('display', 'none');}
		);
		$('.main-nav .menu li').hover(
			function() { $(this).addClass("current-menu-item");},
			function() { $(this).removeClass("current-menu-item");}
		);

		$('.mobile-nav .menu li.menu-item-has-children').prepend( "<a href='#' class='navdrop'><span>subnav</span></a>" );

		$('.mobile-nav .menu .navdrop').toggle(
			function(event) { $('~ ul', this).css('display', 'block');},
			function(event) { $('~ ul', this).css('display', 'none');}
		);
	});