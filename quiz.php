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
		<link rel="stylesheet" href="assets/css/quiz.css" type="text/css">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
	</head>
	
	<body>
	<?php
		include 'header.php';
		if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
			include 'db/dbconfig.php';
			$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
			$user = mysql_fetch_array($user_query);
			mysql_close();
			if ($user['status'] == 's') { // student
				if (isset($_GET['quizid'])) {
					$quizid = $_GET['quizid'];
					include 'quiz_student.php';
				} else {
					$quizid = null;
					include 'quiz_student.php';
				}
			} else { // teacher
				if (isset($_GET['view']) && isset($_GET['edit'])) {
					header('Location: quiz.php?view='.$_GET['view']);
				} else if (isset($_GET['view'])) {
					$viewid = $_GET['view'];
					include 'quiz_teacher_view.php';
				} else if (isset($_GET['edit'])) {
					$editid = $_GET['edit'];
					include 'quiz_teacher_edit.php';
				} else {
					include 'quiz_teacher.php';
				}
			}
		} else {
			
			echo '<!-- content -->
					<div class="wrapper row2">
						<div id="container">
							<div class="full-canvas" style="height:350px">
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
								<p><h1>Please log in to view quizzes</h1></p>
												<div class="clear"></div>
								</div>
							</div>
						</div>
						
						<!-- footer -->
						<?php include "footer.php"; ?>';
			echo '';
		}
	?>
	
	</body>
	
</html>