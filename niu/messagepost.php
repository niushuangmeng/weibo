<?php 
session_start();
$uidfrom = $_SESSION["uid"];
$uidto = $_POST["uidto"];
$content = $_POST["message"];

require "../gonggong/fengzhuang/DBDA.class.php";
$db = new DBDA();
$sql = "insert into message values(0,'{$uidfrom}','{$uidto}','{$content}',now(),0)";
if($db->query($sql,1)){
	echo 1;	
}
