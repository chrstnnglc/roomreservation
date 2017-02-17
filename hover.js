$(function (){
  $('a.item').hover(function(){
    $('.item').removeClass('active');
    $(this).addClass('active');
  })
  $('a.item').mouseleave(function(){
  	$(this).removeClass('active');
  })
});

$(function(){
	$('#example14').calendar({
	  inline: true
	});
})