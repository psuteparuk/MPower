<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MPower</title>
		<!--<meta charset="iso-8859-1">-->
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- stylesheets -->
		<link rel="stylesheet" href="assets/css/blueprint/screen.css" type="text/css">
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/report_quiz_result.css" />
		
		<!--[if lt IE 9]>
			<script src="scripts/html5shiv.js"></script>
		<![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" charset="utf-8" src="assets/js/d3/d3.v2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<script type="text/javascript">
		//<![CDATA[
			var numQuiz,
				timeSpent,
				timeSpentAll = [],
				allCurQuiz = [],
				dateCurQuiz = [],
				result,
				resultAll = [],
				indAll = [],
				average = [],
				w = 750,
				w_info = 200,
				h = 450,
				margin = {top:20, right:10, left:60, bottom:40 },
				barPadding = 20,
				barColor = ["green", "red", "blue"],
				legendData = ["Correct", "Incorrect", "Average"]
				legendOthers = ["Others"];
				
			var currentUser = "Lauren",
				currentQuiz,
				currentQuizDate,
				curUQInd,
				curQInd = 0;
			
			var modes = ["bars", "scatters"],
				curMode = 0;
		//]]>
		</script>
		<script type="text/javascript" src="assets/js/report_quiz_result.js"></script>
	</head>
	
	<body class="ui-widget-content" style="border:0;">
		<div class="container" style="width:1170px;">
			<div id="left-nav-container">
				<fieldset id="left-nav">
					<legend>Select a Quiz</legend>
				</fieldset>
			</div>
			<div class="span-24" id="blueprint-container">
				<div class="span-24"><br /></div>
				<div class="span-12">
					<h1>How did you do?</h1>
				</div>
				<div class="span-12 last">
					<table>
						<tr>
						<td><a id="switch-bar">Your Bars</a></td>
						<td><a id="switch-img"><img src="assets/images/switch_flipped-small.jpg" alt="Switch" height="100%" width="auto" /></a></td>
						<td><a id="switch-scatter">See Scatters</a></td>
						</tr>
					</table>
				</div>
				<div class="span-24"><br /></div>
				<div id="chart" class="span-19"></div>
				<div id="info" class="span-5 last">
					<nav><a id="toggle-avg">Toggle to See Average!</a></nav>
					<div id="legend-svg" class="span-5 last"></div>
					<div id="legend-svg-mean" class="span-5 last"></div>
					<div class="span-5 last"><br /></div>
					<div id="quiz-info-container" class="span-5 last">
						<fieldset id="quiz-info">
							<legend>Quiz Result</legend>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>