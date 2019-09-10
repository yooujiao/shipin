<?php
session_start();
$userName = $_POST["userName"];
$userPassword = md5($_POST["userPassword"]);
$checkCode=$_POST['checkcode'];
if(empty($userName)){
	
	header('Location:user_login01.php?errno=1');
	exit;
}
//获取用户是否选中了保存用户名
if(empty($_POST['keep'])){
	if(!empty($_POST['userName'])){
		setCookie("user_name",$userName,time()-100);
	}
}else{
	setCookie("user_name",$userName,time()+24*3600*30);
}
//print_r($_COOKIE);
//exit();
if(empty($_POST["userPassword"])){
	
	header('Location:user_login01.php?errno=1');
	exit;
}
//md5($userPassword);
//print_r($_POST);
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
//编写SQL，执行SQL添加数据
//$sq = "insert into user_info (userId,userName,userPassword)													values('$userId','$userName','$userPassword')";
$sq="select userName,userEmail from user_info where userName='$userName' or userEmail='$userName' limit 1";
//把sql语句发给dbms，执行得到结果集
//$is_ok=mysql_query($sql,$con);
/*if($is_ok == true)
{
	echo '数据添加成功';	
}else
{
	echo '数据添加失败';
}*/
$re=mysql_query($sq);
$re_num=mysql_num_rows($re);
if($re_num==0){
	//echo $userName.'——没有注册';
	//echo '<div><a href="user_reg01.php">现在注册</a></div>';
	header('Location:user_login01.php?errno=5&username='.$userName);
	exit;
}
$sql="select userName,userEmail,userPassword from user_info where (userName='$userName' or userEmail='$userName') and userPassword='$userPassword' limit 1";
$res=mysql_query($sql);
$res_num=mysql_num_rows($res);
if($res_num>0)
{	
	$user_info=array();
	while($row=mysql_fetch_assoc($res))
	{
		$user_info['username']=$row['userName'];//添加元素
	}
	
	$_SESSION['userName']=$user_info['username'];
	/*print_r($_SESSION);
	print_r($user_info);
	exit;*/
	
	$num=$_SESSION['num'];
	/*echo $num;
	echo $_SESSION['search'];

	exit;*/
	//header('Location:index.php');
	if($num==1){
		header('Location:index.php');
	}else{
		header('Location:user_upload.php');			
	}
	
	//释放资源
	mysql_free_result($res);
}else{
	//$_SESSION["userName"] = null;
	
	/*echo "<script type='text/javascript'>
			location='javascript:history.back()';
			alert('用户名或密码错误,请重新填写');
		</script>";*/
	//print_r($_SESSION);
	header('Location:user_login01.php?errno=2');
	exit();
}
//关闭连接
mysql_close($con);
//先看看验证码是否ok
if($checkCode!=$_SESSION['myCheckCode']){
	header("Location: user_login01.php?errno=checkcode");
	exit();
}

/*
MySQL的简单查询语句

查询：
一：查询所有数据
select * from Info 查所有数据
select Code,Name from Info 查特定列

二：根据条件查
select * from Info where Code='p001' 一个条件查询
select * from Info where Code='p001' and Nation='n001' 多条件 并关系 查询
select * from Info where Name='胡军' or Nation='n001' 多条件 或关系 查询
select * from Car where Price>=50 and Price<=60 范围查询
select * from Car where Price between 50 and 60 范围查询

三：模糊查询
select * from Car where Name like '%型' %通配符代表任意多个字符
select * from Car where Name like '%奥迪%' _通配符代表任意一个字符
select * from Car where Name like '_马%'

四：排序
select * from Car order by Price asc 按照价格升序排列
select * from Car order by Price desc 按照价格降序排列
select * from Car order by Price,Oil 按照两列进行排序，前面的为主要的

五：统计函数（聚合函数）
select count(Code) from Car 查询表中有多少条数据
select max(Price) from Car 取价格的最大值
select min(Price) from Car 取价格的最小值
select sum(Price) from Car 取价格的总和
select avg(Price) from Car 取价格的平均值

六：分组查询
select Brand from Car group by Brand having count(*)>2 查询所有系列中数量大于2的

七：分页查询
select * from Car limit 0,5 跳过几条数据取几条数据

八：去重查询
select distinct Brand from Car
*/
?>