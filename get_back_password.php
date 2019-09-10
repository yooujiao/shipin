<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<?php

//设置编码
header("content-type:text/html;charset=utf-8");

$userName = $_POST['userName'];
if(empty($userName))
{
	echo "输入的用户名不能为空";
	exit;
}
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
$sql="select userName from user_info where userName='$userName'";
$res = mysql_query($sql);
$res_num = mysql_num_rows($res);
if($res_num>=1)
{
	while($row = mysql_fetch_assoc($res))
	{
		echo $row['userName'];
		//echo "<br>".$row['userPassword'];
		//echo "<br>你的密码是：".md5($row['userPassword']);
	}
	//echo "<br>你的密码是：".md5($row['userPassword']);
	//给用户更新密码
	$nowPassword = rand(100000000,999999999);
	$userPassword = md5($nowPassword);
	$sq="update user_info set userPassword='$userPassword' where userName='$userName'";
	$p=mysql_query($sq);
	if($p){
		echo '，你的密码已经重置为：'.$nowPassword.'<br><br>请及时修改密码
		<a href="user_login01.php">返回登录页面</a>'; 
	}
}
else
{
	echo $userName."，还没有注册";
}
?>

