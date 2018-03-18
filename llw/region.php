<?php
	session_start();
	$uid = $_SESSION["uid"];
	require "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$sql = "select acode from info where username='{$uid}'";
	$qu = $db->strquery($sql);
	if(empty($qu)){
		echo 0;
	}else{
		$sql = "select parentareacode from chinastates where areacode='{$qu}'";
		$shi = $db->strquery($sql);
		$sql = "select parentareacode from chinastates where areacode='{$shi}'";
		$sheng = $db->strquery($sql);
		$str = $sheng."|".$shi."|".$qu;
		echo $str;
	}