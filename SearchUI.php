<!DOCTYPE html>
<html lang="zh_CN">
<head>
<!-- 添加viewport标签 -->
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> -->

<!-- 控制用户缩放 网页可以无限缩放，但是原生App是不会缩放的。想让WebApp更像原生App，你要做的一件事就是控制用户的缩放，代码如下： -->
<meta name="viewport"
content="width=device-width, initial-scale=1.0, maximum-scale=1.0 user-scalable=0" />
<!-- viewport的宽度为屏幕宽度，initial-scale是初始缩放值，maximum-scale=1.0是能缩放的最大值。如果不想让用户缩放，则可以将最小值和最大值设为一样，都为1.0。 -->

<!-- 隐藏浏览器的UI或工具栏 首先设置为全屏模式： -->
<meta name="apple-mobile-web-app-capable" content="yes" />

<!-- 隐藏地址栏：在App的顶部还有一个状态栏，你可以更进一步通过把状态栏设置成黑色来自定义app的外观，从而使你的app可以利用整个屏幕。 -->
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- 自定义iPad或iPhone图标 用户可以简单地把Web页面的链接添加至iOS设备的主屏幕上，作为一个Web开发者，你会希望控制Web site或者Web App的icon在用户设备上的展现方式。你可以通过跟多元标签来实现，苹果称之为“Web Clips”。如果你要搜索更多在用户屏幕自定义Web App icon内容的话，你可以搜“web clips”。 你需要的只是一个特别的icon，可以在head区添加如下代码实现： -->
<link rel="apple-touch-icon" href="/custom_icon.png"/>

<!-- 同Native App一样，系统会自动为图标添加圆角及高光。如果不想系统对图标添加效果，可用apple-touch-icon-precomposed代替apple-touch-icon。 -->
<link rel="apple-touch-icon-precomposed" href="/custom_icon.png"/>

<!-- 系统默认的图标大小是57×57像素，不过一些设备有着不同的分辨率，你可以创建具有不同分辨率的icon： -->
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone4.png" />
<!-- 最常用apple-touch-icon.png，但也可以包含尺寸大小信息以及是apple-touch-icon-precomposed还是apple-touch-icon(e.g. apple-touch-icon-57×57-precomposed.png)。 -->

<!-- 添加启动画面 IOS原生App是有启动画面的，而WebApp没有。因此，你需要在Web页面和WebApp上添加启动画面才能让它更像原生App，这个过程跟自定义icon差不多—需要通过 <link>添加适当标签。 与icon一样，不同规格尺寸的设备需要不同的启动画面，最常用最简单的方法使设置一个单独的图片: -->
<link rel="apple-touch-startup-image" href="/startup.png">
<!-- 对iPhone和iPod touch而言, 图片是320×460像素，但是，如果你想使用分辨率更高的图片，下边方法可以实现： -->
<link rel="apple-touch-startup-image" href="/startup-748x1024.jpg"
media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
<link rel="apple-touch-startup-image" href="/startup-768x1004.jpg"
media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />

<!-- 禁止将数字变为电话号码 -->
<meta name="format-detection" content="telephone=no"/>

<meta charset="utf-8">

<title>音乐视频搜索页</title>
<script type="text/javascript" src="./js/SearchUI.js"></script>
<script type="text/javascript" src="./js/arl.js"></script>
<script type="text/javascript" src="./js/my.js"></script>
<link id="link" type="text/css" rel="stylesheet">
</head>
<?php
//session_start();
//引入php代码文件
require_once 'require.php';
//referer();
//获取用户的输入
$search_info=trim($_GET['search']);

if(!empty($search_info))
{
	$_SESSION['search_info']=$search_info;
}
//echo $_SESSION['search_info'];
echo "<script>var search_content='{$_SESSION['search_info']}'</script>";

//js获取用户名
echo "<script>var loginName='{$_SESSION['userName']}'</script>";
echo "<script>var userName='{$_SESSION['userName']}'</script>";

//echo $search_info;
//print_r($_GET);
//exit;
//if(empty($search_info))
//{	
	//header("Location:index.php");
	//exit;
//}
/*//搜索到的结果条数
$res_num_audio=0;
if(!empty($res_audio)){
	//获取音乐、用户名数量
	$res_num_audio=mysql_num_rows($res_audio);
}
$res_num_video=0;
if(!empty($res_video)){
	//获取视频、用户名数量
	$res_num_video=mysql_num_rows($res_video);
}
//获取视频扩展名
//$video_extension=pathinfo($row_video['userVideo'],PATHINFO_EXTENSION);
//给视频数组$video_array末尾添加元素
//array_push($video_name,$row_video['userVideo']);//添加元素*/
?>
<body onscroll="showSongListEnd()">
	<div id='page_content_i'>
	<header id="header">
		
		<p class="p_c">
		<span class="now_time" id="nowTime">晚上好</span>
		<a class="login_name" id="loginName" onclick="hide_show_acound2()">游客</a>
		<span class="close_page_c" onclick="close_page_m()">关闭</span>
		<span class="hong_page_c" onclick='home_page()'>首页</span>
		</p>
			
		<ul id='show_ul_id' style='display:none'>
		<li id="acount_out" style="display:none">
			<a id="zhgl" onclick='Acount()'>帐号管理</a>
			<a id="user_out" onclick='UserOut()'>退出</a>
		</li>
		<li>
		<span id="show_time" onclick="show_hide_color('my_clock', 'show_time')">
		时间日期
		</span>
		</li>
		</ul>
		
		<p id='reg_login_id' style='display:none'>
		<span id="a_id" onclick="is_reg()">注册</span>
		<span id="a_id" onclick="is_login()">登录</span>
		</p>
		<div id="my_clock" style="display:none"></div>
		
		<section class="searchbox_c">
			<input class="searchprot_c" type="text" value="" placeholder="音乐/视频" id="a_v_id">
			<input class="souyixia" type="button" value="搜一下" onclick="SearchInfo(0)">
			<p id="resnum"></p>
		</section>
		
		<span class='audio_video_c' onclick='hideAudioList()' id='hideAudioList' style='color:#cc99cc;border-bottom:0.2rem solid'>
		</span>
		<span class='audio_video_c' onclick='hideVideoList()' id='hideVideoList'>
		</span>
		<span class='show_hide_c' onclick="show_hide_a('songBox', 1)" id='hide_show_i'>
		显示音乐
		</span>
	</header>
	
	<!-- 显示音乐 -->
	<form action="audio.php" method="post" id="form01" class="form_audio_c">
	<table id="table01">
	</table>
	</form>
	
	<!-- 显示视频 -->
	<form class="form_video_c" id="form02" action="video.php" method="post" style="display:none">
	<table id="table02">
	</table>
	</form>
	<ul id='show_audio_info_i' style='display:none'>
	<li id='audio_name_i'>歌名</li>
	<li id='audio_user_i'>上传人</li>
	<li id='audio_date_i'>上传时间</li>
	<li class='close_page_c'>
	<span onclick='ShowAudioInfo(show_audio_info_i)'>关闭页面<span>
	</li>
	</ul>
			
	<!-- 音乐盒子 -->
	<footer id="songBox" class="songBox" style="display:none">
	<!-- <div id="songBox" class="songBox" style="display:none"> -->
		<!-- <input type="button" value = "试听歌曲" onclick = "songTime()"> -->
		<!-- <p type='button' onclick='showListBox()'>
			音乐盒子
		</p> -->
		
		<audio id="audio" preload="auto" controls="controls" controlslist="nodownload">
			您的浏览器不支持 audio 标签。
		</audio>
		<p id="songName"></p>
		<span class='span1' onclick="show_hide_a('songBox', 1)" id='hideShowAudioPlayer' title="隐藏播放器">
		隐藏音乐
		</span>
		<span class='span2' type='button' onclick="show_hide('listBox')">
		音乐盒子
		</span>
	<!-- </div> -->
	</footer>
	<footer id="listBox" class="listBox" style="display:none">
		<table>
			<tr>
				<td><a id="seqPlay" onclick="seqPlay()">顺序播放</a></td>
				<td><a id="songLoop" onclick="songLoop()">单曲循环</a></td>
				<td><a id="downLoadSong" onclick="downLoadSong()">下载这首歌</a> </td>
			</tr>
			<tr>
				<td><a onclick="show_hide('listBox')">关闭盒子</a></td>
			</tr>
			<tr>
			</tr>
		</table>
			<!-- <a id="playedSong" onclick="userSongList()">听过的音乐</a> -->
	</footer>	
<!-- 用户的歌曲列表 -->
<!-- <div id="userSongList" class="userSongList">
<input type="button" value = "关闭歌曲列表" onclick = "userSongList()">
</div> -->
	<section id="movieBox" class="movieBox" style="display:none">
		<video id="video" preload="auto" controls="controls" webkit-playsinline="true" playsinline="true" x5-video-player-type="h5">
		您的浏览器不支持 audio 标签。
		</video>
		<h3 id="videoName"></h3>
		<nav class="videoListBox" id="videoBox" name="videoBox">
				<!-- <h3 id="videoName"></h3> -->
				<!-- <span onclick="delVideo()">删除这首歌</span> -->
				<!-- <span onclick="seevideo()">试看这个视频</span> -->
				<!-- <span onclick="addSongList()">加入歌曲列表</span> -->
				<table>
					<tr>
						<td>
							<a id="videoSeqPlay" onclick="videoSeqPlay()">顺序播放</a>
						</td>
						<td>
							<a id="videoLoop" onclick="videoLoop()">重复播放</a>
						</td>
						<td>
							
							<a onclick="ShowVideoInfo()">视频资料</a>
						</td>
					</tr>
					<tr>
						<!-- <td>
							<a onclick="pageColor()">网页背景色</a>
						</td> -->
						<td>
							<a onclick="videoColor()">背景色</a>
						</td>
						<td>
							<a onclick="defaultColor()">默认背景色</a>
						</td>
						<td>
							<a id="downLoadMovie" onclick="downLoadMovie()">下载</a>		
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><a onclick="shipin()">关闭</a></td>
					</tr>
				</table>
			</nav>
		</section>
	</div>
</body>
</html>

<?php			 
/*
$Var = "hello php" ;
$post = "receive.php?Name=" . urlencode ( $Var );
header ( "location:$post" );
*/
		
/*		

//方法一 获取select结果集的行数
$rows=mysql_query("select * from `student` where `age`='16';");
if (mysql_num_rows($rows) < 1){
echo '查询无数据！';
}

//方法二 返回上一次操作受影响的行数
$rows=mysql_query("select * from `student` where `age`='16';");
if(!mysql_affected_rows()){
    echo '查询无数据！';
}
*/
//mysql基础20讲





	