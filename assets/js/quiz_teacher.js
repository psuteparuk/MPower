$(document).ready(function(){
	$(".quizzes_link_dropdown").click(function(){
		var handle = $(this).next(".quiz_dropdown");
		if (handle.is(":visible")) $(this).css("background-image","url(assets/images/orange_file.gif)");
		else $(this).css("background-image","url(assets/images/orange_file_down.gif)");
		handle.slideToggle();
	});
});