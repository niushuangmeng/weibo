<?php
$id = $_GET["id"];
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
$sql = "delete from blog where ids={$id}";
$result = $db->query($sql,1);


if($result){
	header("location:wodebokemain.php");
	}else{
		echo "删除失败";
		}