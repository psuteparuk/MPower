<?php
	@session_start();
	$_SESSION['invalid_login'] = false;
	if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
		include 'db/dbconfig.php';
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		$result = mysql_query("SELECT * FROM user WHERE username = '" . $username . "' and password = '" . $password ."'");
		if (mysql_num_rows($result) != 0) {
			$_SESSION['login_user'] = $username;
		} else {
			$_SESSION['invalid_login'] = true;
		}
		mysql_close();
	} 
	if(isset($_GET['logout']) && $_GET['logout'] == 'yes') {
		session_destroy();
		header("Location: index.php");
	}
?>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">Empower</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php">Get Started</a></li>
              <li><a href="syllabus.php">Syllabus</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="faq.php">FAQ</a></li>
				  <li><a href="reportproblem.php">Report a Problem</a></li>
				  <li><a href="privacy.php">Privacy Policy</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">About Us</li>
                  <li><a href="about.php">Who we are?</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </li>
            </ul>
			<ul class="nav navbar-form pull-right">
			<?php 
				if(isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
				    echo '
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$_SESSION['login_user'].'  <b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="profile.php">Profile</a></li>
						  <li><a href="setting.php">Setting</a></li>
						  <li class="divider"></li>
						  <li><a href="index.php?logout=yes">Logout</a></li>
						</ul>
					</li>';
				} else {
					echo '
					
					 <form id="loginform" class="navbar-form pull-right" method="post"">
					 <input class="span2" type="text" name="username" placeholder="';
					
					if($_SESSION['invalid_login']) {
						echo 'Invalid Username';
					} else {
						echo 'Username';
					}
					
					 
					 echo '">
					 <input class="span2" type="password" name="password" placeholder="';
					 
					 if($_SESSION['invalid_login']) {
						echo 'Invalid Password';
					} else {
						echo 'Password';
					}
					 
					 echo '">
					 <button type="submit" class="btn-primary">Sign in</button>
					 <button type="button" onclick="window.location.href=\'signup.php\';" class="btn-primary">Sign Up</button>
					 </form>';
				}
			
			?>
			</ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	
	