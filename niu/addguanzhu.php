<?php
session_start();
$user1 = $_SESSION["uid"];
$user2 = $_POST["user"];
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "insert into friendship values(0,'{$user1}','{$user2}')";
$result = $db->query($sql,1);
echo "$result";
//header("location:haoyouchuli2.php");