<!DOCTYPE html>
<head lang="zh_CN">
<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!-- 禁止将数字变为电话号码 -->
<meta name="format-detection" content="telephone=no"/>
<!-- 允许全屏模式浏览，隐藏浏览器导航栏 -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- link标签，它支持用户将网页创建快捷方式到桌面时，其图标变为我们自己定义的图标。 -->
<link rel="apple-touch-icon-precomposed" href="http://3gimg.qq.com/wap30/info/info5/img/logo_icon.png">
<meta charset="utf-8">
<title>用户登录页面</title>
<?php

	require_once 'require.php';
	require_once 'info_js.php';
	
	/*echo "session<br/>";
	print_r($_SESSION);
	echo "<br/>get<br/>";
	print_r($_GET);*/
?>
<script type="text/javascript">
var url_pc="./css/login_pc.css";
var url_phone="./css/login_phone.css";
window.onload=function(){
	wangye(url_pc, url_phone);
	errInfo();
}
//判断是手机进入网页还是电脑进入网页
function wangye(url_pc, url_phone)
{
	/*var a = escape("中国"+"px");
	alert(a);
	alert(unescape(a));*/
	
	var screenWith_v=window.screen.width/640;
	document.documentElement.style.fontSize=screenWith_v*20+"px";
	//alert(screenWith_v*20+"px");
	
	var system ={};  
    var p = navigator.platform;       
    system.win = p.indexOf("Win") == 0;  
    system.mac = p.indexOf("Mac") == 0;  
    system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);     
    if(system.win||system.mac||system.xll){//如果是电脑跳转到百度
		document.getElementById("link").href=url_pc;
        //window.location.href="http://www.baidu.com/";  
    }else{  //如果是手机,跳转到谷歌
		document.getElementById("link").href=url_phone;
        //window.location.href="http://www.google.cn/";  
    }
	
	//判断浏览器是否支持离线缓存
	/*if(window.applicationCache){
        //alert("支持离线缓存");
    }
    else{
        alert("不支持离线缓存");
    }*/
}
function openClosePage()
{
	var a = document.getElementById("form02");
	if(a.style.display == "none")
	{
		a.style.display = "block";	
	}
	else
	{
		if(confirm('确定要放弃密码重置?'))
		{
			a.style.display = "none";
		}
	}
}
/*返回*/
function back_page_f(){
	if(confirm('是否要放弃登录，然后返回页面？')){
		history.back();//返回但不刷新
		/*if(history.back()){
			history.back();
			//window.history.go(-1);	
		}else{
			window.location.href="SearchUI.php";
		}*/
	}
}
/*回到首页*/
function BackPage(){
	if(confirm('是否要放弃登录，然后回到首页？')){
		return true;
	}
	return false;
}
/*关闭*/
function close_page_f(){
	if(confirm('确定要关闭网页')){
		/***第一种关闭网页的方法***/
		//window.opener = null;
		//window.open('', '_self');
		//window.close();
		
		/***第二种关闭网页的方法***/
		open(location, '_self').close();
	}	
}
</script>
<link id="link" type="text/css" rel="stylesheet">
</head>
<body>
<!-- 登录界面 -->
<form class="form01" action="user_login02.php" method="post">
	<table>
	<tr>
	<td class="left_c">
		<a onclick="back_page_f()">返回</a>
		<a href="index.php" onclick="return BackPage()">首页</a>
	</td>
	<th>用户登录</th>
	<td class="right_c">
		<span onclick="close_page_f()">关闭</span>
	</td>
	</tr>
	<tr><td></td>
		<td class="user_input">
			<input type="text" name="userName"value="<?php echo getCookieVal("user_name");?>" placeholder="用户名/邮箱">
		</td><td></td>
		<!-- <td><input type="text" name="userId"></td> -->
	</tr>
	<tr><td></td>
		<td class="user_input">
			<input type="password" name="userPassword" placeholder="密码">
		</td><td></td>
	</tr>
	<tr><td></td>
		<td class="user_input">
		<input type="text" name="checkcode" placeholder="验证码">
		</td><td></td>
	</tr>
	<tr><td></td>
		<td>
		<img src="./checkCode.php" onclick="this.src='./checkCode.php?aa='+Math.random()"/>
		</td><td></td>
	</tr>
	<tr><td></td>
		<td class="js-checkbox">
			<input type="checkbox" name="keep" value="yes" checked="checked"/>
			<label for="remember">记住用户名</label>
			<!-- <input type="password" name="userPassword" placeholder="密码"> -->
		</td><td></td>
	</tr>
	
	<tr><td></td>
		<td class="login">
			<input type="submit" value="登录">
		</td><td></td>
	</tr>
	<tr><td></td>
		<td class="res_back_password">
			<a href="user_reg01.php">注册</a>
			<a onclick="openClosePage()">找回密码</a>
		</td><td></td>
	</tr>
	<tr><td></td>
		<td id="errInfo">
			
		</td><td></td>
	</tr>
	</table>
</form>

<!-- 找回密码界面 -->
<form class="form02" id="form02" action="get_back_password.php" method="post" style="display:none">
<table>
	<tr>
		<th colspan="2">用户密码重置</th>
	</tr>
	<tr>
		<td class="enterUserName" colspan="2">
			<input type="text" name="userName" placeholder="请输入用户名">
		</td>
		<!-- <td><input type="text" name="userId"></td> -->
	</tr>
	<!-- <tr>
		<td>
			<input type="password" name="userPassword" placeholder="密码">
		</td>
	</tr> -->
	<tr>
		<td class="set_password" colspan="2">
			<input type="submit" value="重置密码">
		</td>
	</tr>
	<tr>
		<td class="close_page">
			<a onclick="openClosePage()">关闭页面</a>
		</td>	
	</tr>
</table>
</form>
</body>
</html>
<?php
	//session_start();
	$_SESSION['num']=$_GET['num'];
	//echo $_SESSION['num'];
	//print_r($_GET);
?>
