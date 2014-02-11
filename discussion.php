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
		<link rel="stylesheet" href="assets/css/popbox.css" type="text/css">
		
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
			echo '<!-- content -->
                    <div class="wrapper row2">
                        <div id="container">
                            <div class="full-canvas">
                                <!-- content body -->
                                <aside id="left_column">
                                    <nav>
                                        <ul>
                                        <li><a href="index.php"><h2>Home</h2></a></li>
                                        <li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
                                        <li><a href="quiz_student.php"><h2>Quizzes</h2></a></li>
                                        <li><a href="report.php"><h2>Report</h2></a></li>
                                        <li class="selected"><a href="achievement.php"><h2>Achievement</h2></a></li>
                                        <li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
                                        </ul>
                                    </nav>
                                </aside>
                                
                                <!-- main content -->
                                <div id="content">
                                    Discussion Forum
                                </div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- footer -->
                    <?php include "footer.php"; ?>';
			echo '';
		} else {
			
			echo '<!-- content -->
                    <div class="wrapper row2">
                        <div id="container">
                            <div class="full-canvas">
                                <!-- content body -->
                                <aside id="left_column">
                                    <nav>
                                        <ul>
                                        <li><a href="index.php"><h2>Home</h2></a></li>
                                        <li><a href="courses.php"><h2>Courses / Videos</h2></a></li>
                                        <li><a href="quiz_student.php"><h2>Quizzes</h2></a></li>
                                        <li><a href="report.php"><h2>Report</h2></a></li>
                                        <li class="selected"><a href="achievement.php"><h2>Achievement</h2></a></li>
                                        <li class="last"><a href="discussion.php"><h2>Discussion Forum</h2></a></li>
                                        </ul>
                                    </nav>
                                </aside>
                                
                                <!-- main content -->
                                <div id="content">
                                    Discussion Forum
                                </div>
                                
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- footer -->
                    <?php include "footer.php"; ?>';
			echo '';
		}
        ?>

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