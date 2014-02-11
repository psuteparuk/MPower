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
		<link rel="stylesheet" href="assets/css/elements.css" type="text/css">
		<link rel="stylesheet" href="assets/css/colorbox.css" type="text/css">
		<link rel="stylesheet" href="assets/css/quiz.css" type="text/css">
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.timer.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_student.js"></script>
		<script>
			$(document).ready(function(){
				$(".quiz_cbox").colorbox({
					rel:'quiz_cbox',
					scrolling:false,
					escKey:false,
					arrowKey:false,
					overlayClose:false,
					loop:false,
					innerWidth:'50%',
					innerHeight:'50%',
					current:'Question {current} of {total}',
					next:'Next',
					onComplete:function(){
						$("#cboxPrevious").css("display", "none");
						$("#cboxPrevious").attr("disabled", "disabled");
						$("#cboxNext").css("display", "none");
						$("#cboxNext").attr("disabled", "disabled");
						$("#cboxNext").attr("form", "quiz_form");
						$("#cboxNext").attr("type", "submit");
						$("form input:radio").change(function(){
							if ($("form input:radio[name='answers']").is(":checked")) {
								$("#cboxNext").removeAttr("disabled");
								$("#cboxNext").css("display", "");
							}
						});
						if ($("#questionno_input").val() == $("#numQuestions_input").val()) {
							$("#cboxNext").click(function(){
								var dest_arr = $("#quiz_form").attr("action").split("?");
								var dest = dest_arr[1].split("&");
								window.location = "quiz_result.php?" + dest[0];
							});
						}
					}
				});
				
				var countTime = new (function(){
					var	incrementTime = 1000,
						currentTime = parseInt($("#timelimit_input").val()),
						elapsedTime = 0,
						updateTimer = function(){
							$("#countdown").val(formatTime(currentTime));
							$("#elapsed").val(elapsedTime);
							if (currentTime == 0) {
								countTime.Timer.stop();
								timerComplete();
								return;
							}
							currentTime -= incrementTime / 1000;
							elapsedTime += incrementTime / 1000;
							if (currentTime < 0) currentTime = 0;
						},
						timerComplete = function(){
							alert("Oops! Timeout");
						},
						init = function(){
							countTime.Timer = $.timer(updateTimer, incrementTime, true);
						};
					$("#quiz_start").click(function(){
						$(init);
					});
				});
				
				function pad(number, length) {
					var str = "" + number;
					while (str.length < length) str = "0" + str;
					return str;
				}
				function formatTime(time) {
					var min = parseInt(time / 60),
						sec = parseInt(time) - (min * 60);
					return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2);
				}
			});
		</script>
	</head>
	
	<body>
		<!-- header -->
		<?php include 'header.php'; ?>
		
		<!-- content -->
		<div class="wrapper row2">
			<div id="container">
				<div class="full-canvas">
					<!-- content body -->
					<aside id="left_column">
						<nav>
							<ul>
							<li><a href="index.php"><h2>Home</h2></a></li>
							<li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
							<li class="selected"><a href="quiz.php"><h2>Quizzes</h2></a></li>
							<li><a href="report.php"><h2>Report</h2></a></li>
							<li><a href="achievement.php"><h2>Achievement</h2></a></li>
							<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
							</ul>
						</nav>
					</aside>
					
					<!-- main content -->
					<div id="content">
						<div id="section_header_div">
							<header id="section_header">
								<hgroup>
								<?php
								if (isset($quizid)) {
									include 'db/dbconfig.php';
									$quiztitle_query = mysql_query('SELECT * FROM quiz WHERE id='.$quizid);
									$quiztitle = mysql_fetch_array($quiztitle_query);
									echo '<h1 id="huh">'.$quiztitle['title'].'</h1>';
									mysql_close();
								} else
									echo '<h1>Your Quizzes</h1>';
								?>
								</hgroup>
							</header>
						</div>
						
						<div id="quiz_links_div">
							<aside id="quiz_links">
								<nav>
								<?php
									if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) { //
										include 'db/dbconfig.php';
										$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
										$user = mysql_fetch_array($user_query);
										if ($user['status'] != 's') { echo 'Permission Denied'; die(); } //
										if (!isset($quizid)) {
											$courses_query = mysql_query('SELECT DISTINCT subjectid FROM quiz ORDER BY subjectid');
											$numCourses = mysql_num_rows($courses_query);
											echo '<ul>';
											for ($i = 0; $i < $numCourses; ++$i) {
												$course = mysql_fetch_array($courses_query);
												$subject_query = mysql_query('SELECT * FROM subject WHERE id='.$course['subjectid']);
												$subject = mysql_fetch_array($subject_query);
												echo ($i == $numCourses-1) ? '<li class="last">' : '<li>';
												echo '<a class="quizzes_link_dropdown" id="'.$subject['name'].'_quizzes" href="#"><h2>'.$subject['name'].'</h2></a>';
												$quizzes_query = mysql_query('SELECT * FROM quiz WHERE subjectid='.$course['subjectid']);
												$numQuizzes = mysql_num_rows($quizzes_query);
												echo '<div class="quiz_dropdown" id="'.$subject['name'].'_quiz_dropdown">';
												for ($j = 0; $j < $numQuizzes; ++$j) {
													$quiz = mysql_fetch_array($quizzes_query);
													if ($j == $numQuizzes-1) echo '<div class="subquiz_dropdown last" id="'.$quiz['title'].'_quiz">';
													else echo '<div class="subquiz_dropdown" id="'.$quiz['title'].'_quiz">';
													echo '<h2>'.$quiz['title'].'</h2>';
													$complete = mysql_query('SELECT * FROM history WHERE userid='.$user['id'].' and quizid='.$quiz['id']);
													if (mysql_num_rows($complete) != 0) {
														echo '<h2 style="color:green; font-weight:bold"><a href=quiz_result.php?quizid='.$quiz['id'].'>Complete</a></h2>';
													} else {
														echo '<a class="btn takequiz" href="quiz.php?quizid='.$quiz['id'].'">Take Quiz</a>';
													}
													echo '<br />';
													echo '<p># of Questions: '.$quiz['noquestion'].'&nbsp;&nbsp;&nbsp;&nbsp;';
													$minute = floor($quiz['timelimit'] / 60);
													$second = floor($quiz['timelimit'] - 60*$minute);
													echo 'Time Limit: '.$minute.' mins '.$second.' secs<br />';
													echo 'Date Created: '.$quiz['datecreation'].'</p>';
													echo '</div>';
												}
												echo '</div>';
												echo '</li>';
											}
											echo '</ul>';
											mysql_close();
										} else {
											$questions_query = mysql_query('SELECT * FROM question WHERE quizid='.$quizid.' ORDER BY id');
											$numQuestions = mysql_num_rows($questions_query);
											for ($i = 0; $i < $numQuestions; ++$i) {
												if ($i > 0) echo '<a class="quiz_cbox btn" style="display:none;" href="quiz_student_take.php?quizid='.$quizid.'&amp;questionno='.($i+1).'"></a>';
												else echo '<a class="quiz_cbox btn" id="quiz_start" href="quiz_student_take.php?quizid='.$quizid.'&amp;questionno=1">Start</a>';
											}
											$timelimit_query = mysql_query('SELECT * FROM quiz WHERE id='.$quizid);
											$timelimit = mysql_fetch_array($timelimit_query);
											echo '<input type="hidden" id="timelimit_input" name="timelimit_input" value="'.$timelimit['timelimit'].'" />';
											mysql_close();
											$quizid = null;
										}
									} else {
										echo 'Please log in to see quizzes';
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