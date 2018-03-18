<?php
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$username = $_POST["haoyou"];
$sql = "select * from info where username = '{$username}'";

$attr = $db->Query($sql);
var_dump($attr);

if(empty($attr))
{
	echo "您查找的用户不存在";
}
else
{
	echo "";
	//header("location:info.php");
}