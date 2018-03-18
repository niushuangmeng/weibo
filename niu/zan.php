<?php
session_start();
$uid = $_SESSION["uid"];
$blogid = $_GET["code"];
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "insert into zan values(0,'{$blogid}','{$uid}')";
$arr = $db->query($sql,1);
//var_dump($arr);
header("location:main.php");