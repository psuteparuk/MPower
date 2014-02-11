$(document).ready(function(){
	$(".quizzes_link_dropdown").click(function(){
		var handle = $(this).next(".quiz_dropdown");
		if (handle.is(":visible")) $(this).css("background-image","url(assets/images/orange_file.gif)");
		else $(this).css("background-image","url(assets/images/orange_file_down.gif)");
		handle.slideToggle();
	});
	
	$(".explanation_link_dropdown").click(function(){
		var handle = $(this).next(".explanation_dropdown");
		if (handle.is(":visible")) $(this).css("background-image","url(assets/images/orange_file.gif)");
		else $(this).css("background-image","url(assets/images/orange_file_down.gif)");
		handle.slideToggle();
	});
	
	$("#quiz_form").bind('submit', function(event){
		event.preventDefault();
		var url = $(this).attr('action');
		var data = $(this).serialize();
		$.ajax({
			type:'POST',
			url:url,
			data:data,
			error:function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
		event.preventDefault();
		return false;
	});
});