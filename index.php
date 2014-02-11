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
		<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.colorbox-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/jquery.timer.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/quiz_student.js"></script>
	</head>
	
	<body>
		<!-- header -->
		<?php include 'header.php'; ?>
		
						
								<?php
									include 'db/dbconfig.php';
									if (isset($_SESSION['login_user'])) {
										echo '<!-- content -->
										<div class="wrapper row2">
											<div id="container">
												<div class="full-canvas">
													<!-- content body -->
													<aside id="left_column">
														<nav>
															<ul>
															<li class="selected"><a href="index.php"><h2>Home</h2></a></li>
															<li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
															<li><a href="quiz.php"><h2>Quizzes</h2></a></li>
															<li><a href="report.php"><h2>Report</h2></a></li>
															<li><a href="achievement.php"><h2>Achievement</h2></a></li>
															<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
															</ul>
														</nav>
													</aside>
					
													<!-- main content -->
													<div id="content"><h1>Recent Video</h1>
												<div>
													<p>
														<table cellpadding="10">';
										$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
										$user = mysql_fetch_array($user_query);
										$query = 'SELECT * FROM video';
										if (isset($_GET['search_field'])) {
											$query = $query.' WHERE '.$_GET['search_field'].' LIKE "%'.$_GET['q'].'%"';
										}
										$query = $query.' ORDER BY date DESC';
										$video_query = mysql_query($query);	
										$numVideos = mysql_num_rows($video_query);
										for ($i = 0; $i < $numVideos;) {
											$video = mysql_fetch_array($video_query);
											$video_link = substr($video['link'], -11);
											$video_link = 'http://www.youtube.com/embed/'.$video_link; 
											echo '<tr><td valign="top"><div>';
											echo '<iframe title="Video" class="youtube-player" width="320" height="195" type="text/html" src="';
											echo $video_link.'" frameborder="0" allowFullScreen></iframe>';	
											echo '<p><b>Title</b>: '.$video['title'].'<br/><b>Subject</b>: '.$video['subject'].'<br/>';
											echo '<b>Date</b>: '.$video['date'].'<br/>'.$video['description'];
											echo '</div></td>';
											if($i != $numVideos-1) {
												$video = mysql_fetch_array($video_query);
												$video_link = substr($video['link'], -11);
												$video_link = 'http://www.youtube.com/embed/'.$video_link; 
												echo '<td valign="top"><div>';
												echo '<iframe title="Video" class="youtube-player" width="320" height="195" type="text/html" src="';
												echo $video_link.'" frameborder="0" allowFullScreen></iframe>';	
												echo '<p><b>Title</b>: '.$video['title'].'<br/><b>Subject</b>: '.$video['subject'].'<br/>';
												echo '<b>Date</b>: '.$video['date'].'<br/>'.$video['description'];
												echo '</div></td>';
											}
											$i = $i + 2;
											if($i == 4) $i = $numVideos;
											echo '</tr>';
										}
										echo '</table><br/><br/><h1>Recent Quiz</h1><br/>';
										$quizzes_query = mysql_query('SELECT * FROM quiz ORDER BY datecreation DESC');
										$numQuizzes = mysql_num_rows($quizzes_query);
						
										for ($j = 0; $j < $numQuizzes; ++$j) {
											$quiz = mysql_fetch_array($quizzes_query);	
											echo '<div><h2>'.$quiz['title'].'</h2>';
											$complete = mysql_query('SELECT * FROM history WHERE userid='.$user['id'].' and quizid='.$quiz['id']);
											if (mysql_num_rows($complete) != 0) echo '<h2 style="color:green; font-weight:bold; float:right;">Complete</h2>';
											else echo '<a style="float:right;" class="btn takequiz" href="quiz.php?quizid='.$quiz['id'].'">Take Quiz</a>';
											echo '<br />';
											echo '<p># of Questions: '.$quiz['noquestion'].'&nbsp;&nbsp;&nbsp;&nbsp;';
											$minute = floor($quiz['timelimit'] / 60);
											$second = floor($quiz['timelimit'] - 60*$minute);
											echo 'Time Limit: '.$minute.' mins '.$second.' secs<br />';
											echo 'Date Created: '.$quiz['datecreation'].'<br /></p>';
											echo '</div>';
											if ($j == 3) $j = $numQuizzes;
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
															<li class="selected"><a href="index.php"><h2>Home</h2></a></li>
															<li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
															<li><a href="quiz.php"><h2>Quizzes</h2></a></li>
															<li><a href="report.php"><h2>Report</h2></a></li>
															<li><a href="achievement.php"><h2>Achievement</h2></a></li>
															<li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
															</ul>
														</nav>
													</aside>
													
										<!-- main content -->
										<div id="content"><h1>Please log in</h1>';
								}
										mysql_close();
								?>
								
							</p>
						</div>
						
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
		</div>
		
		<!-- footer -->
		<?php include 'footer.php'; ?>
	
	<script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap-transition.js"></script>
    <script src="bootstrap/js/bootstrap-alert.js"></script>
    <script src="bootstrap/js/bootstrap-modal.js"></script>
    <script src="bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="bootstrap/js/bootstrap-tab.js"></script>
    <script src="bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="bootstrap/js/bootstrap-popover.js"></script>
    <script src="bootstrap/js/bootstrap-button.js"></script>
    <script src="bootstrap/js/bootstrap-collapse.js"></script>
    <script src="bootstrap/js/bootstrap-carousel.js"></script>
    <script src="bootstrap/js/bootstrap-typeahead.js"></script>
	</body>
	
</html>