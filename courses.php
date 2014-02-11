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
	
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/mpower.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/popbox.min.js"></script>
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
					<?php
						if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
							include 'db/dbconfig.php';
							$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
							$user = mysql_fetch_array($user_query);
							mysql_close();
							if ($user['status'] == 't') { // student
								echo '<div style="padding:15px">
									<input style="float:left;" type="button" class="btn btn-primary" value="Create Video" onclick="window.location.href='."'video\_create.php'".';" />
									<br/><br/>
									</div>';
							}
						}
					?>
						<!-- search form -->
						<div>
							<form method="get" class="search">
								<select name="search_field">
									<option value="title">Title</option>
									<option value="subject">Subject</option>
									<option value="description">Description</option>
								</select>
								<input autocomplete="off" name="q" size="27" placeholder="Search" type="text" />
								<input name="search" class="btn btn-success" type="submit" />
							</form>
						</div>
						<p>
							<table cellpadding="10">
							<?php
								include 'db/dbconfig.php';
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
									echo '</tr>';
								}
								mysql_close();
							?>
							</table>
						</p>
					</div>
					<div class="clear"></div>
				</div>
				</div>
			</div>
		</div>
		
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