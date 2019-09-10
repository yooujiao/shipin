<?php

	//忽略警告
	//error_reporting(E_ERROR); 
	//ini_set("display_errors","Off");

	//这里两句话很重要，第一句话告诉浏览器返回的数据是xml格式
	header("Content-Type: text/html;charset=utf-8");
	//告诉浏览器不要缓存数据
	header("Cache-Control: no-cache");
	
	session_start();
	
	function getLastTime(){
		
		//首先看看cookie有没有上传登录信息
		//date_default_timezone_set("Asia/Chongqing");
		if(!empty($_COOKIE['lastVisit'])){
			
			return "上次登录时间:".$_COOKIE['lastVisit'];
			//更新时间
			setCookie("lastVisit",date("Y-m-d H:i:s"),time()+24*3600*30);
		}else{
			//说明用户是第一次登录
			return "你是第一次登录。";
			//更新时间
			setCookie("lastVisit",date("Y-m-d H:i:s"),time()+24*3600*30);
		}
		
	}
	
	function getCookieVal($key){
		
		if(empty($_COOKIE[$key])){
			return "";
		}else{
			return $_COOKIE[$key];
		}
	}

	//把验证用户是否合法封装函数
	$loginName=$_SESSION['userName'];
	function checkUserValidate(){
		
		//print_r($_SESSION);
		//session_start();
		//先写在封
		global $loginName;
		if(empty($loginName)){
			header("Location:user_login01.php?errno=3");
			exit;
		}
	}

	function referer(){
		//没有防止
		//获取referer
		if(isset($_SERVER['HTTP_REFERER']))
		{
			//取出来
			//判断$_SERVER['HTTP_REFERER']是不是以http://localhost/php/shipin/http开始->函数
				
			//strpos()函数 查找字符数首次出现的位置
			if(strpos($_SERVER['HTTP_REFERER'],'http://localhost/php/shipin')==0)
			{
				//echo '小红的帐号信息......';	
			}
			else
			{
				//跳转到警告页面
				//echo '你是非法盗链者';
				header("Location:index.php");
			}
		}
		else
		{
			//跳转到警告页面
			//echo '你是非法盗链者';
			header("Location: warning.php");	
		}
		
		//所以一般来说，只有通过 <a></a> 超链接以及 POST 或 GET 表单访问的页面，$_SERVER['HTTP_REFERER'] 才有效。
	}
?>