<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>

<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
$blogid = $_GET["code"];
?>
<form role="form" action="addpinglun.php" method="post">
  <div class="form-group" style="display:none">
    <label for="name">文本框</label>
    <textarea class="form-control" rows="3" name="blogid"><?php echo "{$blogid}";  ?></textarea>
  </div>
  <div class="form-group">
    <label for="name">评论</label>
    <textarea class="form-control" rows="3" name="pinglun"></textarea>
  </div>
  <button class="btn btn-default" type="submit">提交评论</button>
</form>
<table class="table">
  <caption>评论列表</caption>
  <thead>
    <tr>
      <th>评论人</th>
      <th>评论内容</th>
    </tr>
  </thead>
  <tbody>
    
 
<?php
include("../gonggong/fengzhuang/DBDA.class.php");
$db = new DBDA();
//查询好友与自己的微博，按发表时间降序排序
$sql = "select * from pinglun where blogids = '{$blogid}'";//查询关注者，查询关注者的微博
$arr = $db->query($sql);
//var_dump($arr);
foreach($arr as $v){
	echo "<tr>
      <td>{$v[3]}</td>
      <td>{$v[2]}</td>
    </tr>";
	}

?>
 </tbody>
</table>
</body>
</html>