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
	<?php include 'header.php'; ?>
	
	<div class="container">
	<form id="problemsubmit" class="form-horizontal" method="post">
		<fieldset>
			<legend><br/>&emsp;&emsp;&emsp;&emsp;Report a Problem!</legend>
		</fieldset>
	  <div class="control-group">
		<label class="control-label" for="inputEmail">Your Email</label>
		<div class="controls">
		  <input type="text" id="inputEmail" name="email" placeholder="Email"><div id="pemail" class="help-inline"></div>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPassword">Topic</label>
		<div class="controls">
		  <select>
		      <option>General Problem</option>
			  <option>Login</option>
			  <option>Signup</option>
			  <option>Syllabus</option>
			  <option>Quiz</option>
			  <option>My Learning Report</option>
		  </select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="inputPassword">Problem</label>
		<div class="controls">
		  <textarea rows="3" id="inputProblem" name="problem"></textarea><div id="pproblem" class="help-inline"></div>
		</div>
	  </div>
	  <div class="control-group">
		<div class="controls">
		  <input type="hidden" name="submit">
		  <button id="submitB" type="submit" class="btn btn-primary">Submit</button>
		  <button id="clearB" type="button" class="btn" onclick="window.location.reload()">Cancel</button>
		  <span id="sproblem"></span>
		</div>
	  </div>
	</form>
	
	<?php
	if(isset($_POST['problem']) && isset($_POST['email'])) {
		echo '<p class="text-success"><i class="icon-ok"></i>  Thank you for submitting your problem. We will contact you once the problem is fixed.</p>';
	}
	?>
	
		
		
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
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
	<script>
		$("#problemsubmit").submit(function() {
			var error = false;
			if ($("#inputEmail").val() == "") {
				$("#pemail").text("  Enter Valid Email").show();
				error = true;
			} else {
				$("#pemail").text("").show();
			}
			if ($("#inputProblem").val() == "") {
				$("#pproblem").text("  Enter Your Problem Here").show();
				error = true;
			} else {
				$("#pproblem").text("").show();
			}
			return !error;
		});
	</script>
  </body>
</html>