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
	<script type="text/javascript" src="http://mbostock.github.com/d3/d3.js?1.27.2"></script>
    <!--<script type="text/javascript" src="http://mbostock.github.com/d3/d3.layout.js?1.27.2"></script>-->
	<script type="text/javascript" src="d3/d3.js"></script>
    <script type="text/javascript" src="d3/d3.layout.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
	<script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-146052-10']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
	<style type="text/css">

		.node rect {
		  cursor: pointer;
		  fill: #fff;
		  fill-opacity: .5;
		  stroke: #3182bd;
		  stroke-width: 1.5px;
		}

		.node text {
		  font: 10px sans-serif;
		  pointer-events: none;
		}

		path.link {
		  fill: none;
		  stroke: #9ecae1;
		  stroke-width: 1.5px;
		}
		
		.node circle {
		  cursor: pointer;
		  fill: #fff;
		  stroke: steelblue;
		  stroke-width: 1.5px;
		}
		
		#chart {
		  width: 900px;
		  float: left;
		}
		
		#syllabus-info-container {
		  width: 270px;
		  float: left;
		}
		
		#radio-toggle {
			background-color:#EFEFEF;
			border-radius:4px;
			border:1px solid #D0D0D0;
			overflow:auto;
			width:200px;
		}

		#radio-toggle label {
			float:left;
			width:100px;
			margin:0;
		}

		#radio-toggle label span {
			text-align:center;
			padding:3px 0px;
			display:block;
			cursor:pointer;
		}

		#radio-toggle label input {
			position:absolute;
			top:-20px;
		}

		#radio-toggle input:checked + span {
			background-color:#404040;
			color:#F7F7F7;
		}
		
		.info-label {
		  font-weight: bold;
		  cursor: pointer;
		}
		
		.top-priorities, #top-priorities-list p {
		  color: #e61515;
		}
		
		.medium-priorities, #medium-priorities-list p {
		  color: #dabd00;
		}
		
		.least-priorities, #least-priorities-list p {
		  color: #00f21c;
		}
		
		#top-priorities-list, #medium-priorities-list, #least-priorities-list {
			display: none;
		}
    </style>
  </head>
	
  <body data-spy="scroll" data-target=".bs-docs-sidebar">
	<?php include 'header.php'; ?>

	
	<header class="jumbotron subhead" id="overview">
		<div class="container">
		<h1>Syllabus</h1>
		<p class="lead">Browse Through Your Syllabus and See Your Progress!</p>
		</div>
	</header>
	
	<div class="container" id="radio-toggle">
		<label><input type="radio" name="toggle" checked="checked"><span id="radio1">Indented-Tree</span></label>
		<label><input type="radio" name="toggle"><span id="radio2">Tree-Flare</span></label>
	</div>
	
	<div class="container" id="main-container">
		<?php include "indentedTree.html"; ?>
	</div>
	
	<script type="text/javascript">
		if ($("input:radio[name=toggle]")[0].checked) {
			$("#main-container").empty();
			$("#main-container").load("indentedTree.html");
		}
		if ($("input:radio[name=toggle]")[1].checked) {
			$("#main-container").empty();
			$("#main-container").load("treeFlare.html");
		}
		$("#radio1").click(function() {
			if ($("input:radio[name=toggle]")[0].checked) return;
			$("input:radio[name=toggle]")[0].checked = true;
			$("input:radio[name=toggle]")[1].checked = false;
			$("#main-container").empty();
			$("#main-container").load("indentedTree.html");
		});
		$("#radio2").click(function() {
			if ($("input:radio[name=toggle]")[1].checked) return;
			$("input:radio[name=toggle]")[1].checked = true;
			$("input:radio[name=toggle]")[0].checked = false;
			$("#main-container").empty();
			$("#main-container").load("treeFlare.html");
		});
	</script>
	
	<div class="container">
		<footer>
			<p>&copy; Empower Inc., 2013</p>
		</footer>
    </div> <!-- /container -->


	
	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/prettify.js"></script>
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
    <!--<script src="bootstrap/js/bootstrap-affix.js"></script>-->
    <script src="bootstrap/js/application.js"></script>
	<script>
      !function ($) {
        $(function(){
          // carousel demo
          $('#myCarousel').carousel()
        })
      }(window.jQuery)
    </script>
	<!-- Analytics
    ================================================== -->
    <script>
      var _gauges = _gauges || [];
      (function() {
        var t   = document.createElement('script');
        t.type  = 'text/javascript';
        t.async = true;
        t.id    = 'gauges-tracker';
        t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
        t.src = '//secure.gaug.es/track.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(t, s);
      })();
    </script>
  </body>
</html>