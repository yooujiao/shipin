<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<?php

//设置编码
header("content-type:text/html;charset=utf-8");

$userPassword=md5($_POST['password']);
$newPassword=$_POST['newPassword'];
$userNewPassword=md5($newPassword);
//print_r($_POST);

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
	
	 
/*$sq = "insert into video (videoName)  values('$userId')";
//编写SQL，执行SQL添加数据
$sq = "insert into user_info (userId,userName,userAge)  values('$userId','$userName','$userAge')";
	
//把sql语句发给dbms，执行得到结果集
$is_ok = mysql_query($sq,$con);
	 
if($is_ok == true)
{
	echo '数据添加成功';	
}else
{
	echo '数据添加失败';
}*/
session_start();
$userName = $_SESSION["userName"];
//写sql语句，查询数据
$sql = "select userName,userPassword from user_info where userName='$userName' and userPassword='$userPassword'";
$res = mysql_query($sql,$con);
$res_num = mysql_num_rows($res);
	 
if($res_num>=1)
{
	mysql_query("update user_info set userPassword='$userNewPassword' where userName='$userName'");
	echo "密码修改成功<br><br>新密码修改为：".$newPassword;
}
else
{
	/*echo "<script type='text/javascript'>
			location='javascript:history.back()';
			alert('原密码错误，请重新填写');
		</script>";*/
	echo $userName."，你的原密码错误";
}
?>