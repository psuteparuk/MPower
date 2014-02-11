<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Empower &middot; Your Personalized Learning</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	<link href="style.css" rel="stylesheet">
	<link href="bootstrap/css/prettify.css" rel="stylesheet">
	<link href="bootstrap/css/docs.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/elements.css" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons, need to fix apple icon -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

 
	<div class="container">	
		  
		 
	<?php include 'header.php'; 
		include 'db/dbconfig.php';
		if (isset($_SESSION['login_user'])) {
			echo '<div><p>';
			$user_query = mysql_query('SELECT * FROM user WHERE username="'.$_SESSION['login_user'].'"');
			$user = mysql_fetch_array($user_query);
			echo '<form id="problemsubmit" class="form-horizontal" method="post">
				 <div class="control-group">
					<label class="control-label" for="aboutyou">About You</label>
					<div class="controls">
					  <input type="text" id="aboutyou" name="aboutyou" placeholder="About You">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="Goal">Goal</label>
					<div class="controls">
					  <input type="text" id="Goal" name="Goal" placeholder="Goal">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="nickname">Nickname</label>
					<div class="controls">
					  <input type="text" id="nickname" name="nickname" placeholder="Nickname">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="address">Address</label>
					<div class="controls">
					  <input type="text" id="address" name="address" placeholder="Address">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="Phone">Phone</label>
					<div class="controls">
					  <input type="text" id="Phone" name="Phone" placeholder="Phone">
					</div>
				  </div>
				   <div class="control-group">
					<div class="controls">
					  <input type="hidden" name="register" value="y">
					  <button id="submitB" type="submit" class="btn btn-primary">Update</button>
					  <button id="clearB" type="button" class="btn btn-primary" onclick="window.location.reload()">Cancel</button>
					  <span id="sproblem"></span>
					</div>
				  </div>
				</form>';
			}
		?>		
		
		
		
				
	

	       
	
	</div>
	<div class="container">
				  <footer>
					<p>&copy; Empower Inc., 2013</p>
				  </footer>
	</div> <!-- /container -->

		
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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