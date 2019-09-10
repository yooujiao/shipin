<!DOCTYPE html>
<html lang="zh_CN"><!-- manifest="test.appcache" -->
<head>
<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<!-- 禁止将数字变为电话号码 -->
<meta name="format-detection" content="telephone=no"/>
<!-- 允许全屏模式浏览，隐藏浏览器导航栏 -->
<meta name="apple-mobile-web-app-capable" content="yes"/>
<!-- link标签，它支持用户将网页创建快捷方式到桌面时，其图标变为我们自己定义的图标。 -->
<link rel="apple-touch-icon-precomposed" href="http://3gimg.qq.com/wap30/info/info5/img/logo_icon.png">

<!--UC强制全屏-->
<meta name="x5-fullscreen" content="true">

<meta charset="utf-8">
<title>古道音乐</title>
<!-- <base target="_blank"> --><!-- 默认在新窗口打开链接 -->
<script src="./jquery/jquery-3.3.1.min.js"></script>

<script src="./js/index.js" type="text/javascript"></script>
<script src="./js/arl.js" type="text/javascript"></script>
<script src="./js/my.js" type="text/javascript"></script>

<link id="link" type="text/css" rel="stylesheet">
<link href="http://localhost/php/shipin/favicon.ico" rel="shortcut icon">
<!-- <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" /> -->
<style type="text/css">
</style>
</head>

<body>
<div class="box">
	<p class="closepage_c">
		<span id="zhankai">展开</span>
		<a class="right" id="guanbi_1" href="javascript:void(0);">关闭</a>
	</p>
	
	<div class="black" id="guanbi_3" style="display:none">
		<ul class="white" id="ul">
			<li><span class="close_c" id="guanbi_2">关闭</span></li>
			<li class="time_loginname_c">
				<span id="nowTime">时间</span>
				<span class="loginname_c" id="loginName">游客</span>
				<p class="content" id="content" style="display:none">你是游客，请登录。</p>
				<p class="acount_out" id="acount_out" style="display:none">
					<a id="zhgl">帐号管理</a>
					<a id="user_out">退出</a>
				</p>
			</li>
			<li class="login_res_c">
			<a id="login">登录</a>
			<a id="reg">注册</a>
			</li>
			<li class="j_g">
			<a href='./jisuanqi/jisuanqi.php' id="jisuanqi">计算器</a>
			<a href='./gupiao/gupiao.php' id="gupiao">股票查询</a>
			</li>
			<li class="time_date_c">
			<span id="time_date_id">时间日期</span>
			</li>
		</ul>
		<p class="my_clock_c" id="my_clock" style="display:block"></p>
	</div>
	
	<section class="searchbox">
		<p class="p_1">音乐视频搜索<p>
		<!-- <a href='./SearchUI.php'>跳转</a> -->
		
		<p class="p_2">
		<input id="audio_video_text" type="text" value="音乐视频资源" placeholder="音乐/视频">
		<span id="search_id">搜一下</span>
		</p>
	</section>
	<section id="show_section">
		<ul id='ul_id' style="display:none">
			<li id="ip"></li>
			<li id="region_city"></li>
			<li id="isp"></li>
			<li id='hr_id' style='display:none'><hr></li>
			<li id='weather_j'></li>
			<li id='weather_m'></li>
			<li id='ganmao'></li>
		</ul>
		<ul class='ul_c'>
		<li>
		<input id='search_city' type="text" value="宁都" placeholder="城市名称">
		<span id="search_b">查询天气</span>
		</li>
		</ul>
	</section>
	<!-- <section id="section_weather_id" style="display:none"> -->
		<!-- <table> -->
			<!-- <tr><td id='city'></td></tr> -->
			<!-- <tr><td id='date_j'></td></tr> -->
			<!-- <tr><td>最高：</td><td id='high_j'></td></tr>
			<tr><td>最低：</td><td id='low_j'></td></tr>
			<tr><td>风向：</td><td id='fengxiang_j'></td></tr>-->
			<!-- <tr><td id='type_j'></td></tr> -->
		<!-- </table> -->
		<!-- <table> -->
			<!-- <tr><td id='date_m'></td></tr>
			<tr><td id='ganmao'></td></tr> -->
			<!-- <tr><td>最高：</td><td id='high_m'></td></tr>
			<tr><td>最低：</td><td id='low_m'></td></tr>
			<tr><td>风向：</td><td id='fengxiang_m'></td></tr>-->
			<!-- <tr><td>天气状况：</td><td id='type_m'></td></tr> -->
			<!-- <tr><th>平均气温：</th><td id='wendu'></td></tr> -->
		<!-- </table> -->
	<!-- </section> -->
</div>

</body>
</html>
<!-- 通过url传参

如果是HTML页面的话JS传到新页面就window.location.href='a.html?id=100';然后a.html页面的JS就<div id="s"></div>

<script>
document.getElementById("s").innerHTML=window.location.split('?')[1];
</script> -->

<!-- //设置时区  
date_default_timezone_set('Asia/Shanghai');
//按指定格式输出日期  
$date=date('Y-m-d H:i'); --> 
 
