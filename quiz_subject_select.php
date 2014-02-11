<?php
//if (isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])) {
	include 'db/dbconfig.php';
	
	for ($i = 0; $i < 7; ++$i) {
		if (!isset($_GET['subject_input_level_'.$i]) || empty($_GET['subject_input_level_'.$i])) continue;
		$parentid = $_GET['subject_input_level_'.$i];
		$arr = array();
		$subject_query = mysql_query('SELECT * FROM subject WHERE parentid='.$parentid.' ORDER BY id');
		$numSubjects = mysql_num_rows($subject_query);
		for ($j = 0; $j < $numSubjects; ++$j) {
			$subject = mysql_fetch_array($subject_query);
			$arr[''.$subject['id']] = ''.$subject['name'];
		}
		$arr[''] = '--';
		echo json_encode($arr);
		break;
	}
	
//} else {
//	alert("no user!");
//}
?>