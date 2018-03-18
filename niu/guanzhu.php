<?php
session_start();
$uid = $_SESSION["uid"];
$guanzhu = $_POST["guanzhu"];
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "select user2 from friendship where user1 = '{$uid}'";
$arr = $db->query($sql);
var_dump($result);
//判断是否已经关注
foreach($arr as $v){
	if(!$v[0]==$guanzhu){
	$db = new DBDA();
    $sql = "insert into friendship values (0,'{$uid}','{$guanzhu}')";
    $arr2 = $db->query($sql);			
		}else{
			
			}
	
	}
