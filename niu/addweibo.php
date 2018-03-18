<?php
session_start();
$uid = $_SESSION["uid"];
$content = $_POST["textarea"];
//echo $username;
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
echo $content;
if(!empty($content)){
	
	$sql = "insert into blog values(0,'{$uid}','{$content}',now())";

    $result = $db->query($sql,1);
	}

header("location:main.php");
