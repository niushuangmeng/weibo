<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<script src="../gonggong/bootstrap/js/bootstrap.min.js"></script>
<script src="../gonggong/bootstrap/js/jquery-1.11.2.min.js"></script>
<link href="../gonggong/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div style="width:100%; height:500px; ">
    <div style="width:600px; margin:auto">
        <!--<h2 align="center">请登录</h2>-->
        <div style="padding: 100px 100px 100px; ">
            <h3 align="center">请登录</h3>
            <form class="bs-example bs-example-form" role="form" method="post" action="loginpost.php">
                <div class="input-group">
                    <span class="input-group-addon">用户名</span>
                    <input type="text" class="form-control" placeholder="请输入用户名" name="uid">
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;&nbsp;码</span>
                    <input type="password" class="form-control" placeholder="请输入密码" name="pwd">
                </div>
                <br />
                <input class="btn btn-default" type="submit" value="登录">
                <a  class="btn btn-default" href="./register.php" role="button" >注册</a>
            </form>
        </div>
    </div>
</div>
</body>

</html>