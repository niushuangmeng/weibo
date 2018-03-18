<?php
	require_once "../gonggong/fengzhuang/DBDA.class.php";
	$ids = $_GET["ids"];
	$db = new DBDA();
	$sql = "delete from message where ids={$ids} ";
	if($db->query($sql,1)){
		header("location:message.php");	
	}