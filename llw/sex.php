<?php
	session_start();
	$uid = $_SESSION["uid"];
	require "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$sql = "select sex from info where username='{$uid}'";
	$re = $db->query($sql);
	
	echo "{$re[0][0]}";
	