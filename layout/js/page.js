$(document).ready(function(){



// Debut animation de form login

$('.confirm').click(function(){

return confirm('Are you sure');

});

//Debut show and hidden password

$('.show-password').hover(function(){



	$('.password').attr('type','text');
},
	function(){
   $('.password').attr('type','password');

	}

);
//Fin show and hidden password
//Debut show and hidden text-placeholder


$('.login h3 span').click(function(){

	$(this).addClass('selected').siblings().removeClass('selected');
	$('.login form').hide();
	$('.'+$(this).data('class')).fadeIn(100);
});
$('.live-name').keyup(function(){

	$('.caption h3').text($(this).val());
});
$('.prix').keyup(function(){

	$('.item-box span').text('$'+$(this).val());
});
$('.live-description').keyup(function(){

	$('.caption p').text($(this).val());
});



$(' .item-box ').mouseenter(function(){


	$(' .item-box .pull-right').fadeIn(500);
});
$(' .item-box ').mouseleave(function(){


	$(' .item-box .pull-right').fadeOut(500);
});
});

