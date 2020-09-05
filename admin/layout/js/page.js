$(document).ready(function(){



// Debut animation de form login
$('.login').slideDown(2000);


$('.confirm').click(function(){

return confirm('Are you sure');

});

//Fin animation de login
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
$('[placeholder]').focus(function(){

$(this).attr('data-text',$(this).attr('placeholder'));
$(this).attr('placeholder','');

}).blur(function(){
$(this).attr('placeholder',$(this).attr('data-text'));


});

$('.cat h3').click(function(){

	$(this).next('.full-view').fadeToggle(100);
	
});
$('.option span').click(function(){

$(this).addClass('active').siblings('span').removeClass('active');

if ($(this).data('view')==='full') {
	$('.cat .full-view').fadeIn(200);

}
else{
	$('.cat .full-view').fadeOut(200);
}

});
//page dahbord +
$('.toggle-info').click(function(){
$(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);

if ($(this).hasClass('selected')) {
	$(this).html("<i class='fa fa-minus'></i>");
}
else{$(this).html("<i class='fa fa-plus'></i>");

}

});



});

