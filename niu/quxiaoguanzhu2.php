<?php
session_start();
$user1 = $_SESSION["uid"];
$user2 = $_GET["user"];
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "delete from friendship where user1='{$user1}' and user2='{$user2}'";
$result = $db->query($sql,1);
//echo "$result";
header("location:guanzhuderen.php");