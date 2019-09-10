<?php

//这里两句话很重要，第一句话告诉浏览器返回的数据是xml格式
header("Content-Type: text/html;charset=utf-8");
//告诉浏览器不要缓存数据
header("Cache-Control: no-cache");

//用户安全退出
session_start();
//删除所有保存的session信息
//session_destroy();
$_SESSION["userName"]=null;
header('Location: user_login01.php');

/*echo "<script type='text/javascript'>
			if(confirm('真的要退出？')){
				window.location.href='user_login01.php';
			}else{
				history.back();
			}
	</script>";*/