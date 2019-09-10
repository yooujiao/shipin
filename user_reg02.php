<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<?php
header("content-type:text/html;charset=utf-8");
$userName = $_POST["username"];
$userSex = $_POST["sex"];
$userPassword = md5($_POST["password"]);
$userQq = $_POST["qq"];
$userEmail = $_POST["email"];
//print_r($_POST);
//echo $userPassword;
//接下来，在连接数据库 ‘db3’
//地址
$url = "localhost";
//账号
$user = "root";
//密码
$password = "root";
//连接
$con = @mysql_connect($url,$user,$password);
//判断数据库有无连接成功，连接失败会返回一个空
if(!$con)
{
	echo '连接失败';
	exit;
}
//设置编码机
mysql_query("set names 'utf8'");
//连接数据库
mysql_select_db("db3");

$sql="select userName from user_info where userName='$userName' limit 1";
$query=mysql_query($sql);
$row=mysql_num_rows($query);
if($row>0)
{
	/*echo "<script type='text/javascript'>
			location='javascript:history.back()';
			alert('注册失败，用户名已经被他人抢先注册，换一个试试');
		</script>";*/
	header('Location:user_reg01.php?errno=reg_error1&reg_username='.$userName);
	exit;
}

$sql2="select userEmail from user_info where userEmail='$userEmail' limit 1";
$res=mysql_query($sql2);
$res_num_row=mysql_num_rows($res);
if($res_num_row>0)
{
	header('Location:user_reg01.php?errno=reg_error2&reg_email='.$userEmail);
	exit;
}

//编写SQL，执行SQL添加数据
date_default_timezone_set('PRC');
$date=date('Y-m-d H:i:s',time());

$sql3="insert into user_info (userName,userSex,userPassword,userQq,userEmail,userRegDate) values ('$userName','$userSex','$userPassword','$userQq','$userEmail','$date')";

//把sql语句发给dbms，执行得到结果集
$is_ok=mysql_query($sql3);
if($is_ok==true)
{
	echo '恭喜你，注册成功！<br>你的用户名是：'.$userName.'<br>密码是：'.$_POST["password"];
	echo '<br><br><a href="user_login01.php">现在登录？</a>';
}
else
{
	echo '数据添加失败';
}
//关闭连接
mysql_close($con);
?>