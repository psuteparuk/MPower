<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MPower</title>
		<!--<meta charset="iso-8859-1">-->
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- stylesheets -->
		<link href="assets/css/bootstrap.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/layout.css" type="text/css">
	
		<link rel="stylesheet" href="assets/css/popbox.css" type="text/css">
		<link rel="stylesheet" href="assets/css/quiz.css" type="text/css">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.chained.remote.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_teacher.js"></script>
		<script>
			$(document).ready(function(){
				for (var i = 1; i < 7; ++i) $("#subject_input_level_"+i).hide();
				
				var subjectLevel = 0;
				$("#subject_input_level_1").remoteChained("#subject_input_level_0", "quiz_subject_select.php");
				$("#subject_input_level_0").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_1").show(); subjectLevel = 0; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_1").hide();
				});
				$("#subject_input_level_2").remoteChained("#subject_input_level_1", "quiz_subject_select.php");
				$("#subject_input_level_1").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_2").show(); subjectLevel = 1; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_2").hide();
				});
				$("#subject_input_level_3").remoteChained("#subject_input_level_2", "quiz_subject_select.php");
				$("#subject_input_level_2").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_3").show(); subjectLevel = 2; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_3").hide();
				});
				$("#subject_input_level_4").remoteChained("#subject_input_level_3", "quiz_subject_select.php");
				$("#subject_input_level_3").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_4").show(); subjectLevel = 3; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_4").hide();
				});
				$("#subject_input_level_5").remoteChained("#subject_input_level_4", "quiz_subject_select.php");
				$("#subject_input_level_4").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_5").show(); subjectLevel = 4; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_5").hide();
				});
				$("#subject_input_level_6").remoteChained("#subject_input_level_5", "quiz_subject_select.php");
				$("#subject_input_level_5").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_6").show(); subjectLevel = 5; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_6").hide();
				});
				$("#subject_input_level_7").remoteChained("#subject_input_level_6", "quiz_subject_select.php");
				$("#subject_input_level_6").bind("change", function(event){
					if ($("option:selected", this).val() != "") { $("#subject_input_level_7").show(); subjectLevel = 6; $("#subjectlevel_input").val(subjectLevel); }
					else $("#subject_input_level_7").hide();
				});
				
				var numQuestions = 0;
				var totalQuestions = 0;
				var indQuestions = new Array();
				$("#add_button").click(function(){
					$("#quiz_create_form").append(
						'<div class="quiz_create" id="quiz_create-' + (++numQuestions) + '" style="display:none;">' + 
						'<input type="button" class="btn btn-remove" id="remove_button-' + numQuestions + '" value="Remove" />' + 
						'<div class="quiz_create_input">' + 
						'<label for="subsubject_input-' + numQuestions + '">Subject</label>' + 
						'<select id="subsubject_input-' + numQuestions + '" name="subsubject_input-' + numQuestions + '">' + 
						'<option value="">--</option>' + 
						'</select>' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input">' + 
						'<label for="problem_input-' + numQuestions + '">Problem</label>' + 
						'<textarea cols="40" rows="5" id="problem_input' + numQuestions + '" name="problem_input-' + numQuestions + '" placeholder="Problem Statement" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input quiz_create_choice">' + 
						'<label class="quiz_create_choice-' + numQuestions + '" for="choiceA_input-' + numQuestions + '">Choice A</label>' + 
						'<textarea cols="40" rows="2" id="choiceA_input' + numQuestions + '" name="choiceA_input-' + numQuestions + '" />' + 
						'<input type="radio" id="answerA_input-' + numQuestions +'" name="answer_input-' + numQuestions + '" value="0" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input quiz_create_choice">' + 
						'<label class="quiz_create_choice-' + numQuestions + '" for="choiceB_input-' + numQuestions + '">Choice B</label>' + 
						'<textarea cols="40" rows="2" id="choiceB_input' + numQuestions + '" name="choiceB_input-' + numQuestions + '" />' + 
						'<input type="radio" id="answerB_input-' + numQuestions +'" name="answer_input-' + numQuestions + '" value="0" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input quiz_create_choice">' + 
						'<label class="quiz_create_choice-' + numQuestions + '" for="choiceC_input-' + numQuestions + '">Choice C</label>' + 
						'<textarea cols="40" rows="2" id="choiceC_input' + numQuestions + '" name="choiceC_input-' + numQuestions + '" />' + 
						'<input type="radio" id="answerC_input-' + numQuestions +'" name="answer_input-' + numQuestions + '" value="0" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input quiz_create_choice">' + 
						'<label class="quiz_create_choice-' + numQuestions + '" for="choiceD_input-' + numQuestions + '">Choice D</label>' + 
						'<textarea cols="40" rows="2" id="choiceD_input' + numQuestions + '" name="choiceD_input-' + numQuestions + '" />' + 
						'<input type="radio" id="answerD_input-' + numQuestions +'" name="answer_input-' + numQuestions + '" value="0" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input quiz_create_choice">' + 
						'<label class="quiz_create_choice-' + numQuestions + '" for="choiceE_input-' + numQuestions + '">Choice E</label>' + 
						'<textarea cols="40" rows="2" id="choiceE_input' + numQuestions + '" name="choiceE_input-' + numQuestions + '" />' + 
						'<input type="radio" id="answerE_input-' + numQuestions +'" name="answer_input-' + numQuestions + '" value="0" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input">' + 
						'<label for="explanation_input-' + numQuestions + '">Explanation</label>' + 
						'<textarea cols="40" rows="2" id="explanation_input' + numQuestions + '" name="explanation_input-' + numQuestions + '" />' + 
						'</div>' + 
						'<br />' + 
						'<div class="quiz_create_input">' + 
						'<label for="time_input-' + numQuestions + '">Expected Time</label>' + 
						'<input type="text" class="time_input" id="time_minute_input' + numQuestions + '" size="10" name="time_minute_input-' + numQuestions + '" />mins&nbsp;' + 
						'<input type="text" class="time_input" id="time_second_input' + numQuestions + '" size="10" name="time_second_input-' + numQuestions + '" />secs&nbsp;' + 
						'</div>' + 
						'</div>'
					);
					$("#quiz_create-" + numQuestions).slideDown();
					totalQuestions++;
					$("#show_num_questions").text('Number of Questions: ' + totalQuestions);
					$("#noquestion_input").val(totalQuestions);
					indQuestions.push(numQuestions);
					
					$("#remove_button-" + numQuestions).click(function(){
						var idarr = $(this).attr('id').split("-");
						$(this).parent().remove();
						totalQuestions--;
						$("#show_num_questions").text('Number of Questions: ' + totalQuestions);
						$("#noquestion_input").val(totalQuestions);
						indQuestions.splice(indQuestions.indexOf(parseInt(idarr[1])), 1);
					});
					
					var selectAnswer = ".quiz_create_choice-" + numQuestions;
					$(selectAnswer).click(function(){
						$(selectAnswer).removeClass("answer_choice");
						$(selectAnswer).siblings("textarea").removeClass("answer_choice_textarea");
						$(this).addClass("answer_choice");
						$(this).siblings("textarea").addClass("answer_choice_textarea");
						$(this).siblings("input[type=radio]").prop("checked", true);
					});
					
					$("#subsubject_input-"+numQuestions).remoteChained("#subject_input_level_"+subjectLevel, "quiz_subject_select.php");
				});
				
				
			});
		</script>
	</head>
	
	<body>
		<!-- header -->
		<?php include 'header.php'; ?>
		<?php include 'video_teacher_submit.php'; ?>
		<!-- content -->
		<div class="wrapper row2">
			<div id="container">
				<div class="full-canvas">
					<!-- content body -->
					<aside id="left_column">
						<nav>
							<ul>
							<li><a href="index.php"><h2>Home</h2></a></li>
							<li class="selected"><a href="courses.php"><h2>Courses / Videos</h2></a></li>
							<li><a href="quiz.php"><h2>Quizzes</h2></a></li>
							<li><a href="report.php"><h2>Report</h2></a></li>
							<li><a href="achievement.php"><h2>Achievement</h2></a></li>
							<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
							</ul>
						</nav>
					</aside>
					
					<!-- main content -->
					<div id="content">
						<div id="quiz_header_div">
							<header id="quiz_header">
								<hgroup>
								<h1>New Video</h1>
								</hgroup>
							</header>
						</div>
						
						<div id="quiz_links_div">
							<aside id="quiz_links">
								<nav>
								<?php
									if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
										include 'db/dbconfig.php';
										$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
										$user = mysql_fetch_array($user_query);
										if ($user['status'] != 't') { echo 'Permission Denied'; die(); }
										echo '<form action="video_create.php" method="post" id="video_create_form">';
										echo '<div class="quiz_create">';
										echo '<label for="title_input">Title*</label>';
										echo '<input type="text" id="title_input" name="title" size="25" />';
										echo '<label for="link_input">Link</label>';
										echo '<input type="text" id="link_input" name="link" size="25" />';
										echo '<label for="subject_input">Subject</label>';
										echo '<select id="subject_input_level_0" name="subject_level_0">';
										echo '<option selected="selected" value="">--</option>';
										$subject_query = mysql_query('SELECT * FROM subject WHERE parentid IS NULL');
										$numSubjects = mysql_num_rows($subject_query);
										for ($i = 0; $i < $numSubjects; ++$i) {
											$subject = mysql_fetch_array($subject_query);
											echo '<option value="'.$subject['name'].'">'.$subject['name'].'</option>';
										}
										echo '</select>';
										for ($i = 1; $i < 7; ++$i) {
											echo '<select id="subject_input_level_'.$i.'" name="subject_level_'.$i.'" disabled="disabled">';
											echo '<option value="">--</option>';
											echo '</select>';
										}
										echo '<label for="description_input">Description </label>';
										echo '<textarea id="description_input" name="description" cols="100" rows="5"></textarea>';
										echo '</div>';
										echo '<input type="hidden" id="noquestion_input" name="noquestion" value="0" />';
										echo '<input type="hidden" id="subjectlevel_input" name="subjectlevel" value="0" />';
										
										echo '<input type="submit" class="btn btn-success" id="submit_button" value="Create Video" />';
										echo '</form>';
										mysql_close();
									}
								?>
								</nav>
							</aside>
						</div>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
		<!-- footer -->
		<?php include 'footer.php'; ?>
	</body>
	
</html>