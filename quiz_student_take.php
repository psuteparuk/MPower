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
		<link rel="stylesheet" href="assets/css/colorbox.css" type="text/css">
		<link rel="stylesheet" href="assets/css/quiz.css" type="text/css">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.timer.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_student.js"></script>
	</head>
	
	<body>
		<?php
			include 'header.php';
			if (!isset($_GET['quizid']) || !isset($_GET['questionno'])) { echo 'Permission Denied'; die(); }
			$quizid = $_GET['quizid'];
			$qno = $_GET['questionno'];
		?>
		<div id="quiz_content">
			<?php
			//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
				include 'db/dbconfig.php';
				$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
				$user = mysql_fetch_array($user_query);
				echo '<div id="timeremain">';
				echo '<p>Time Remaining: </p>';
				echo '<input type="text" id="countdown" name="timeshow_input" form="quiz_form" disabled="disabled"></input>';
				echo '</div>';
				echo '<br /><br />';
				$questions_query = mysql_query('SELECT * FROM question WHERE quizid='.$quizid.' ORDER BY id LIMIT 1 OFFSET '.($qno-1));
				$question = mysql_fetch_array($questions_query);
				echo '<form action="quiz_student_submit.php?quizid='.$quizid.'&amp;questionno='.$qno.'" method="post" id="quiz_form">';
				echo '<table>';
				echo '<tr>';
				echo '<td valign="top">' . $qno . '.</td>';
				echo '<td valign="top">' . $question['problem'] . '</td>';
				echo '</tr>';
				
				echo '<tr>';
				echo '<td valign="top"></td>';
				echo '<td valign="top">';
				$choice = array('A','B','C','D','E');
				foreach ($choice as $j=>$c) {
					echo '<input id="choice-'.$c.'" type="radio" name="answers" value="'.$j.'" />' . $question[$c] . '<br />';
				}
				echo '</td>';
				echo '</tr>';
				echo '</table>';
				echo '<input type="hidden" id="elapsed" name="time_input" />';
				$numQuestions_query = mysql_query('SELECT * FROM question WHERE quizid='.$quizid);
				$numQuestions = mysql_num_rows($numQuestions_query);
				echo '<input type="hidden" id="numQuestions_input" name="numQuestions_input" value="'.$numQuestions.'" />';
				echo '<input type="hidden" id="questionno_input" name="questionno_input" value="'.$qno.'" />';
				echo '</form>';
				mysql_close();
			//}
			?>
		</div>
	</body>
	
</html>