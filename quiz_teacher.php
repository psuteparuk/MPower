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
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_teacher.js"></script>
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
						<div id="quiz_header_div">
							<header id="quiz_header">
								<hgroup>
								<h1>Your Quizzes</h1>
								</hgroup>
								<input type="button" style="float:right;" class="btn btn-primary" value="Create New Quiz" onclick="window.location.href='quiz\_create.php';" />
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
												echo '<input type="button" class="btn btn-danger" value="Edit" onclick="window.location.href=\'quiz.php?edit='.$quiz['id'].'\';" />';
												echo '<input type="button" class="btn btn-success" value="View" onclick="window.location.href=\'quiz.php?view='.$quiz['id'].'\';" />';
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