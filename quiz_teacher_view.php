<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MPower</title>
		<!--<meta charset="iso-8859-1">-->
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- stylesheets -->
		<link rel="stylesheet" href="assets/css/layout.css" type="text/css">
		<link rel="stylesheet" href="assets/css/elements.css" type="text/css">
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
		<?php
			if (!isset($viewid)) { echo 'Permission Denied'; die(); }
		?>
		
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
							<li class="selected"><a href="quiz_student.php"><h2>Quizzes</h2></a></li>
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
								<?php
								if (isset($viewid)) {
									include 'db/dbconfig.php';
									$quiztitle_query = mysql_query('SELECT * FROM quiz WHERE id='.$viewid);
									$quiztitle = mysql_fetch_array($quiztitle_query);
									echo '<h1>'.$quiztitle['title'].'</h1>';
									mysql_close();
								} else
									echo '<h1>Your Quizzes</h1>';
								?>
								</hgroup>
							</header>
						</div>
						
						<div id="quiz_content">
							<?php
							//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
								include 'db/dbconfig.php';
								$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
								$user = mysql_fetch_array($user_query);
								//if ($user['status'] != 't') { echo 'Permission Denied'; die(); }
								$questions_query = mysql_query('SELECT * FROM question WHERE quizid='.$viewid.' ORDER BY id');
								$numQuestions = mysql_num_rows($questions_query);
								$choice = array('A','B','C','D','E');
								echo '<br />';
								echo '<table>';
								for ($i = 0; $i < $numQuestions; ++$i) {
									$question = mysql_fetch_array($questions_query);
									echo '<tr>';
									echo '<td valign="top">' . ($i+1) . '.</td>';
									echo '<td valign="top">' . $question['problem'] . '</td>';
									echo '</tr>';
									echo '<tr></tr>';
									echo '<tr>';
									echo '<td valign="top"></td>';
									echo '<td valign="top">';
									echo '<table>';
									foreach ($choice as $j=>$c) {
										echo ($question['answer'] == $j) ? '<tr class="answer correct">' : '<tr>';
										echo '<td valign="top">' . $c . '.</td>';
										echo '<td valign="top">' . $question[$c] . '</td>';
										echo '</tr>';
									}
									echo '</table>';
									echo '</td>';
									echo '</tr>';
								}
								echo '<td colspan="2">';
								echo '<input type="button" class="btn btn-edit" value="Edit" onclick="window.location.href=\'quiz.php?edit='.$viewid.'\';" />';
								echo '<a href="quiz.php">Back to list</a>';
								echo '</td>';
								echo '</table>';
								mysql_close();
							//}
							?>
							<div class="clear"></div>
						</div>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
		<!-- footer -->
		<?php include 'footer.php'; ?>
		
		<?php $viewid = null; ?>
	</body>
	
</html>