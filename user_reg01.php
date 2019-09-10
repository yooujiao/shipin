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
<title>用户注册页面</title>
<?php

	require_once 'info_js.php'; 
?>
<script type="text/javascript">
window.onload=function(){
	
	var screenWith_v=window.screen.width/640;
	document.documentElement.style.fontSize=screenWith_v*20+"px";
	
	errInfo();
	wangye();
}
//表单验证
//根据下拉框变换图片
/*function img_change(thisObj){
    var imgsrc = "/bbs/img/"+ thisObj.value+".gif";
    document.getElementById("tx_change").src=imgsrc;    
}*/

//判断是手机进入网页还是电脑进入网页
function wangye()
{
	var system ={};  
    var p = navigator.platform;       
    system.win = p.indexOf("Win") == 0;  
    system.mac = p.indexOf("Mac") == 0;  
    system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);     
    if(system.win||system.mac||system.xll){//如果是电脑跳转到百度
		document.getElementById("link").href="./css/reg_pc.css";
        //window.location.href="http://www.baidu.com/";  
    }else{  //如果是手机,跳转到谷歌
		document.getElementById("link").href="./css/reg_phone.css";
        //window.location.href="http://www.google.cn/";  
    }
}
//返回
function back_page_f(){
	
	if(confirm('是否要放弃注册，然后返回上一页？')){
		history.back();//返回但不刷新
		/*if(history.back()){
			//window.history.go(-1);//返回并刷新
		}else{
			window.location.href="SearchUI.php";
		}*/
		//window.location.href = document.referrer;//返回上一页并刷新
	}
}
//首页
function BackPage(){
	
	if(confirm('是否要放弃注册，然后回到首页？')){
		return true;	
	}
	return false;
}
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
//检查是否都符合 注册 要求
function check_reg()
{
	//&& check_len()==true && check_pass()==true && check_email()==true && check_qq()==true
	//check_user() && check_len() && check_qq() && check_email()
	
	if(check_user() && check_len() && check_pass() && check_email())
	{
		return true;    
	}else{
		return false;
    }
}
//检查用户名
function check_user(){
	var username=document.form01.username;
	if(username.value.length==0)
	{
		document.getElementById('show_user').innerHTML="用户名不能为空";
		document.getElementById('show_user').style.color="red";
        return false;	
	}
	/*if(username.value.length<6)
	{
		document.getElementById('show_user').innerHTML="用户名太短了";
		document.getElementById('show_user').style.color="red";
        return false;	
	}*/
	document.getElementById('show_user').innerHTML="验证通过";
	document.getElementById('show_user').style.color="green";
    return true;
}
//检查密码长度不能少于6
function check_len(){
	var psw=document.form01.password;
    if(psw.value.length==0)
    {
        document.getElementById('show_pass').innerHTML="密码不能为空";
		document.getElementById('show_pass').style.color="red";
        return false;
    }
	if(psw.value.length<6 || psw.value.length>20)
    {
        document.getElementById('show_pass').innerHTML="密码长度只能介于6-20位之间";
		document.getElementById('show_pass').style.color="red";
        return false;
    }
        document.getElementById('show_pass').innerHTML="验证通过";
		document.getElementById('show_pass').style.color="green";
        return true;
}

//检查俩次密码输入是否一致
function check_pass(){
    var psw=document.form01.password;
	var rpsw=document.form01.repassword;
    if(rpsw.value.length==0)
    {
        document.getElementById('show_repass').innerHTML="密码不能为空";
		document.getElementById('show_repass').style.color="red";
        return false;
    }
	if(rpsw.value!=psw.value)
    {
        document.getElementById('show_repass').innerHTML="两次密码输入不一致";
		document.getElementById('show_repass').style.color="red";
        return false;
    }
        document.getElementById('show_repass').innerHTML="验证通过";
		document.getElementById('show_repass').style.color="green";
        return true;
}

//检查qq格式是否正确
/*function check_qq(){
    var qq=document.getElementsByName('qq')[0].value;
    var reg=/^\d+$/;
	if(qq==""){
		document.getElementById('show_qq').innerHTML=" QQ不能为空";
		document.getElementById('show_qq').style.color="red";
        return false;	
	}
	if(qq.length<5){
		document.getElementById('show_qq').innerHTML=" QQ长度不能少于5位数";
		document.getElementById('show_qq').style.color="red";
        return false;		
	}
    if(qq.search(reg))
    {
        document.getElementById('show_qq').innerHTML=" QQ只能为数字";
		document.getElementById('show_qq').style.color="red";
        return false;
    }
	document.getElementById('show_qq').innerHTML="验证通过";
	document.getElementById('show_qq').style.color="green";
	return true;
}*/

//检查email是否正确
function check_email(){
	var email=document.form01.email;
    var reg=/^([a-zA-Z\d][a-zA-Z0-9_]+@[a-zA-Z\d]+(\.[a-zA-Z\d]+)+)$/gi;    
    var rzt=email.value.match(reg);
    if(email.value.length==0)
	{
		document.getElementById('show_e').innerHTML="Email不能为空";
		document.getElementById('show_e').style.color="red";
		return false;
	}
    if(rzt==null)
    {
        document.getElementById('show_e').innerHTML="Email地址不正确";
		document.getElementById('show_e').style.color="red";
        return false;
    }
	document.getElementById('show_e').innerHTML="验证通过";
	document.getElementById('show_e').style.color="green";
	return true;
}
</script>
<link id="link" type="text/css" rel="stylesheet">
</head>
<body>
<form action="user_reg02.php" class="form01" name="form01" method="post" onsubmit="return check_reg()">
	<table>
	<tr>
		<td class="backpage_c">
		<a onclick="back_page_f()">返回</a>
		<a href="index.php" onclick="return BackPage()">首页</a>
		</td>
		<th>用户注册</th>
		<td class="closepage_c">
		<a onclick="close_page_f()">关闭</a>
		</td>
	</tr>
	<tr>
		<td class="left">用户名：</td>
		<td>
		<input name="username" class="myText" type="text" maxlength="19" onblur="check_user()">
		</td>
		<td class="right" id="show_user"></td>
	</tr>
	<tr> <!--性别：0 保密 1 女 2 男-->
		<td class="left">性别：</td>
		<td class="sex">
			<label for="nan">男</label>
			<!-- <span>男</span> -->
			<input class="nan" name="sex" type="radio" value="男" checked="checked">
			
			<label for="nv">女</label>
			<!-- <span>女</span> -->
			<input class="nv" name="sex" type="radio" value="女">
		   <!-- 保密<input type="radio" value="0" name="sex"  checked/> --></td>
		 <td></td>
	</tr>
	<tr>
		<td class="left">密码：</td>
		<td><input name="password" class="myText" type="password" maxlength="23" onblur="check_len()"></td>
		<td class="right" id="show_pass"></td>
	</tr>
	<tr>
		<td class="left">重复密码：</td>
		<td><input name="repassword" class="myText" type="password" maxlength="23" onblur="check_pass()"></td>
		<td class="right" id="show_repass"></td>
	</tr>
	<tr>
		<td class="left">QQ：</td>
		<td><input name="qq" type="text" class="myText" maxlength="13" onblur="check_qq()" placeholder="选填"></td>
		<td class="right" id="show_qq"></td>
	</tr>
	<tr>
		<td class="left">邮箱：</td>
		<td><input name="email" type="text" class="myText" maxlength="23" onblur="check_email()"></td>
		<td class="right" id="show_e"></td>
	</tr>
	<!-- <tr>
		<td height="60">头像：</td>
		<td>
		<select name="img_select" onchange="img_change(this)">
			<option value="101" >女 001</option>
			<option value="102" >女 002</option>
			<option value="103" >女 003</option>
			<option value="104" >女 004</option>
			<option value="105" >男 001</option>
			<option value="106" >男 002</option>
			<option value="107" >男 003</option>
			<option value="108" >男 004</option>
		 </select>
		 <img src="/bbs/img/101.gif" id="tx_change" style="width:50px; height:65px;" alt=""/>
		</td>
	</tr> -->
	<tr>
		<td></td>
		<td class="reg">
			<input type="submit" value="提交注册" name="submit">
			<input type="reset" value="重填" name="reset">
		</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td class="nowLogin">
			<span>我已有账号</span>
			<a href="user_login01.php">现在登录</a>
		</td>
		<td></td>
	</tr>
	</table>
</form>
</body>
<html>