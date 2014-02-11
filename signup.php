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
			<h2 class="featurette-heading"><br/>Sign Up Now. <span class="muted"><br/>It's Free!</span></h2>
		    <?php
				if(isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {
					echo '<p class="text-success"><i class="icon-ok"></i>  Thank you for signing up!</p>';
					$_SESSION['login_user']=$_POST['username'];
					include 'db/dbconfig.php';
					$sql = "INSERT INTO user (username,password,firstname,lastname,email,gender, status) VALUES ('$_POST[username]','$_POST[password]','$_POST[first_name]','$_POST[last_name]','$_POST[email]','$_POST[gender]','$_POST[status]')";
					$result = mysql_query($sql);
					mysql_close();	
				}
			?>
		 
	<?php include 'header.php'; ?>		
		<form id="problemsubmit" class="form-horizontal" method="post">
				 <div class="control-group">
					<label class="control-label" for="first_name">First Name</label>
					<div class="controls">
					  <input type="text" id="first_name" name="first_name" placeholder="First Name">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="last_name">Last Name</label>
					<div class="controls">
					  <input type="text" id="last_name" name="last_name" placeholder="Last Name">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="gender">Gender</label>
					<div class="controls">
						<input type="radio" name="gender" value="m"checked> Male  &nbsp;&nbsp;&nbsp; 
						<input type="radio" name="gender" value="f"> Female <br>
					</div>
				  </div>
				   <div class="control-group">
					<label class="control-label" for="status">Status</label>
					<div class="controls">
						<input type="radio" name="status" value="s"checked> Student  &nbsp;&nbsp;&nbsp; 
						<input type="radio" name="status" value="t"> Teacher <br>
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="username">Username</label>
					<div class="controls">
					  <input type="text" id="username" name="username" placeholder="Username">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
					  <input type="password" id="password" name="password" placeholder="Password">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="password2">Confirm Password</label>
					<div class="controls">
					  <input type="password" id="password2" name="password2" placeholder="Confirm Password">
					</div>
				  </div>
				 <div class="control-group">
					<label class="control-label" for="email">Email</label>
					<div class="controls">
					  <input type="text" id="email" name="email" placeholder="Email">
					</div>
				 </div>
				 <div class="control-group">
					<label class="control-label" for="datebirth">Date of Birth</label>
					<div class="controls">
					  <select name="dd">
						  <option>1</option>
						  <option>2</option>
						  <option>3</option>
						  <option>4</option>
						  <option>5</option>
						  <option>6</option>
						  <option>7</option>
						  <option>8</option>
						  <option>9</option>
						  <option>10</option>
						  <option>11</option>
						  <option>12</option>
						  <option>13</option>
						  <option>14</option>
						  <option>15</option>
						  <option>16</option>
						  <option>17</option>
						  <option>18</option>
						  <option>19</option>
						  <option>20</option>
						  <option>21</option>
						  <option>22</option>
						  <option>23</option>
						  <option>24</option>
						  <option>25</option>
						  <option>26</option>
						  <option>27</option>
						  <option>28</option>
						  <option>29</option>
						  <option>30</option>
						  <option>31</option>
					  </select>
					  <select name="mm">
						  <option>JAN</option>
						  <option>FEB</option>
						  <option>MAR</option>
						  <option>APL</option>
						  <option>MAY</option>
						  <option>JUN</option>
						  <option>JUL</option>
						  <option>AUG</option>
						  <option>SEP</option>
						  <option>OCT</option>
						  <option>NOV</option>
						  <option>DEC</option>
					  </select>
					  <input type="text" id="yy" name="yy" size="4" maxlength="4" placeholder="1992">
					</div>
				  </div>
				 <div class="control-group">
			      <div class="controls">
					  <label class="checkbox">
						<input type="checkbox" value="">
						Subscribe to our mailing list! 
						</label>
					</div>
				 </div>
				 <div class="control-group">
					<div class="controls">
					  <input type="hidden" name="register" value="y">
					  <button id="submitB" type="submit" class="btn btn-primary">Submit</button>
					  <button id="clearB" type="button" class="btn btn-primary" onclick="window.location.reload()">Cancel</button>
					  <span id="sproblem"></span>
					</div>
				  </div>
				</form>
	

	       
	
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
	<script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
  </body>
</html>