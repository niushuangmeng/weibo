<?php

	require_once "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	$pacode = $_POST["pacode"];
	$sql = "select * from chinastates where parentareacode = '{$pacode}'";
	$str = $db->strquery($sql);
	echo $str;	