<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
	session_start();
	require_once "../gonggong/fengzhuang/DBDA.class.php";
	$db = new DBDA();
	@$uid = $_SESSION["uid"];
	 $touxiang = $_SESSION["pic"];
	@$name = $_POST["name"];
	@$sex = $_POST["sex"];
	@$pacode = $_POST["pacode"];
	@$date = $_POST["date"];
	//@$jdfname = "";
	
		
	//判断有没有头像上传，
	
	//如果为空，用原来的头像
	
	//
	if(!empty($_FILES["pic"])){
		
		if(($_FILES["pic"]["type"]=="image/jpeg" || $_FILES["pic"]["type"]=="image/png")&&$_FILES["pic"]["size"]<=1048576 ){
	
	//防止文件名重复
	//1.文件夹的方式  2018-2-6/zhangsan/11.txt 2018-2-6/lisi/11.txt
	//2.修改文件名  162152612516.jpg
	$pname = $_FILES["pic"]["name"];
	$datestr = time();
	$suiji = rand(0,100);
	$filename = "./img/{$datestr}{$suiji}{$pname}";
	
	//转换编码格式
	$fnamegb = iconv("UTF-8","gb2312",$filename);
	
	//第一个代表临时文件的路径，第二个代表存到哪个位置
	move_uploaded_file($_FILES["pic"]["tmp_name"],$fnamegb); 
	
	//取出用户名
	//$uid = $_SESSION["uid"];
	
	//找到头像路径
	//     /代表www目录
	//做成动态获取的绝对路径
	
	//把相对路径转换成绝对路径
	$jdfname = realpath($filename);
	$jdfname = str_replace("\\","/",$jdfname);
	$rootpath = $_SERVER['DOCUMENT_ROOT'];
	
	$jdfname = str_replace($rootpath,"/",$jdfname);
		
	//查询用户是否填写信息
	$sql = "select * from info where username = '{$uid}'";
	$result = $db->query($sql);
	if(empty($result)){
		$sql = "insert into info values('{$uid}','{$name}','{$sex}','{$date}','{$pacode}','{$jdfname}')";
		$result1 = $db->query($sql,1);
		
		}else{
			$sql = "update info set name='{$name}',sex='{$sex}',acode='{$pacode}',birthday='{$date}',pic='{$jdfname}' where username='{$uid}'";
		    $result2 = $db->query($sql,1);
			}
		
		
		}}else{
			$jdfname = $touxiang;
			//查询用户是否填写信息
	$sql = "select * from info where username = '{$uid}'";
	$result = $db->query($sql);
	if(empty($result)){
		$sql = "insert into info values('{$uid}','{$name}','{$sex}','{$date}','{$pacode}','{$jdfname}')";
		$result1 = $db->query($sql,1);
		
		}else{
			$sql = "update info set name='{$name}',sex='{$sex}',acode='{$pacode}',birthday='{$date}',pic='{$jdfname}' where username='{$uid}'";
		    $result2 = $db->query($sql,1);
			}
				
			}
	
header("location:../niu/main.php");
	
	//require_once "../crud/DBDA.class.php";
	//$db = new DBDA();
	//$sql = "update users set pic='{$jdfname}' where uid='{$uid}'";
	
	
	

/*}else if(empty($_FILES["pic"])){
		$jdfname ="";
	}
	$sql = "select * from info where username = '{$uid}'";
	if(empty($db->query($sql))){
		$sql = "insert into info values('{$uid}','{$name}','{$sex}','{$date}','{$pacode}','{$jdfname}')";	
	}else{
		//$jdfname = $_SESSION["pic"];
		$sql = "update info set name='{$name}',sex='{$sex}',acode='{$pacode}',birthday='{$date}',pic='{$jdfname}' where username='{$uid}'";
	}	
	
	if($db->query($sql,1)){
		header("location:../niu/main.php");
		//echo $jdfname;	
	}else{echo "FALSE";}*/
/*	echo $pacode;
	echo "<br>";
	echo $date;*/
	