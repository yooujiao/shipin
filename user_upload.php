<!DOCTYPE html>
<head>
<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!-- 禁止将数字变为电话号码 -->
<meta name="format-detection" content="telephone=no"/>
<!-- 允许全屏模式浏览，隐藏浏览器导航栏 -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- link标签，它支持用户将网页创建快捷方式到桌面时，其图标变为我们自己定义的图标。 -->
<link rel="apple-touch-icon-precomposed" href="http://3gimg.qq.com/wap30/info/info5/img/logo_icon.png">
<meta charset="utf-8">
<title>影子网页搜索</title>
<?php

//验证用户是否合法登录
require_once 'require.php';
//checkUserValidate();



$audio_id_str=json_encode($audio_id_array);
$audio_name_str=json_encode($audio_array);
$video_name_str=json_encode($video_array);
$userInfoArray=json_encode($userInfoArray);

/*echo '<script type="text/javascript">
		
		//音乐id数组
		var song=new Array();
		song=eval("("+'.$audio_id_str.'+")");
		
		alert(song[0]);
		//音乐数组
		
		song_array=eval("("+'.$audio_array.'+")");
		
		
		//视频数组
		
		video_array=JSON.parse("'.$video_array.'");

		//用户信息数组
		
		user_info_array=JSON.parse("'.$userInfoArray.'");
	</script>';*/	

//引入js代码文件
require_once 'info_js.php';
?>

<script type="text/javascript" src="./js/user_upload.js"></script>
<script type="text/javascript" src="./js/arl.js"></script>
<script type="text/javascript" src="./js/my.js"></script>
<link id="link" type="text/css" rel="stylesheet">

</head>
<body>
	<div class="content">
		<!-- 第一个区块 -->
		<section class="time">
			<p class="now_time">
				<span id="nowTime">晚上好</span>
				<a id="loginName" onclick="showUserBox()">游客</a>
				<a class="out" href="safeOut.php" onclick="return safeOut()">退出</a>
				<a class="right" href="#" onclick="backPage()">首页</a>
			<p>
			<ul class="user_box" id="userBox" style="display:none">
				<li class="myInfo" onclick="hideUserInfoPage()"><a>我的资料</a></li>
				<li onclick="changeAccount()"><a>重新登录</a></li>
			</ul>
		</section>

		<!-- 第二个区块 -->
		<section class="upload_page">
			<span onclick="uploadSong()">上传音乐/视频</span>
			<form id="uploadBox" style="display:none" action="upload_file.php" method="post" enctype="multipart/form-data"><!-- target="_blank" -->
				<input type="hidden" name="MAX_FILE_SIZE" value="524288000"/>
				<input class="change_file" type="file" name="file[]" id="file" multiple="multiple">
				<input class="start_upload" type="submit" name="submit" value="开始上传">
			</form>
			<!-- <p id="errInfo"></p> -->
		</section>
		
		<!-- 第三个区块 -->
		<section class="file_info">
			<ul class="myupload">
				<li>
					<span>我的上传</span>
				</li>
				<li>
					<input type="button" value="音乐文件" class="backPage" onclick="hideAudioList()" id="hideAudioList">
				</li>
				<li>
					<input type="button" value="视频文件" class="backPage" onclick="hideVideoList()" id="hideVideoList">
				</li>
				<li class="login_time">
				<?php
					//显示用户登录时间
					echo getLastTime();
				?>
				</li>
			</ul>
		</section>
	</div>

	<section id="show_song" class="song_list_box" style="display:none">
	</section>
	
	
	
	<!-- 音乐盒子 -->
	<section id="songBox" class="songBox" style="display:none">
		<!-- <input type="button" value = "试听歌曲" onclick = "songTime()"> -->
		<audio id="audio" preload="auto" controls="controls">
			您的浏览器不支持 audio 标签。
		</audio>
		<div id="songName"></div>
		<span onclick="hideAudioPlayer()">关闭音乐</span>
		<span onclick="showListBox()">音乐盒子</span>
	</section>
	
	<section id="listBox" class="audio_list_box" hidden>
		<table>
			<tr>
				<td><a id="seqPlay" onclick="seqPlay()">顺序播放</a></td>
				<td><a id="songLoop" onclick="songLoop()">单曲循环</a></td>
				<td><a id="downLoadSong" href="" download="" onclick="downLoadSong()">下载这首歌</a></td>
			</tr>
			<tr>
				<td><a onclick="hideListBox()">关闭盒子</a></td>
				<td>
					<form action="delSong.php" method="post" target="_blank" onsubmit="return delSong()">
						<input id="song_id_text" type="text" name="song_id" value="删除这首歌" hidden="hidden">
						<input id="song_name_text" type="text" name="song_name" value="删除这首歌" hidden="hidden">
						<input type="submit" name="submit" value="删除这首歌">
					</form>
				</td>
			</tr>
			<tr>
			</tr>
		</table>
	</section>
	<!-- 用户的歌曲列表 -->
	<!-- <div id="userSongList" class="userSongList">
	<input type="button" value = "关闭歌曲列表" onclick = "userSongList()">
	</div> -->
	
	<!-- 用户资料区块 -->
	<section id="userInfo" class="user_info" style="display:none">
	</section>
	
	<!-- 密码修改区块 -->
	<section class="change_password" id="form03" style="display:none">
		<form name="form03" action="change_password.php" method="post" target="_blank" onclick="return check_reg()">
			<table>
				<tr>
				<th>密码修改</th>
				<td class="text" align="right"><a onclick="closePasswordPage()">关闭</a></td>
				</tr>
				<tr>
					<td>
						<input type="password" name="password" maxlength="23" placeholder="密码" onblur="check_len()">
					</td>
					<td class="text"><span id="show_pass"></span></td>
				</tr>
				<tr>
					<td>
						<input type="password" name="rePassword" maxlength="23" placeholder="重复密码" onblur="check_pass()">
					</td>
					<td class="text"><span id="show_repass"></span></td>
				</tr>
				<tr>
					<td>
						<input type="password" name="newPassword" maxlength="23" placeholder="新密码" onblur="check_newpass_len()">
					</td>
					<td class="text"><span id="newPassword"></span></td>
				</tr>
				<tr>
					<td class="changePassword">
						<input type="submit" value="提交密码修改">
					</td>
					<td class="text"></td>
				</tr>
			</table>
		</form>
	</section>
	<!-- 下架歌曲区块 -->
	<!-- <section>
	<h6>下架成功的歌曲</h6>
	<p id="audio_success"></p>
	<h6>下架失败的歌曲</h6>
	<p id="audio_fail"></p>
	</section> -->
	
	<!-- 显示视频 -->
	<section class="show_video" id="showVideo" style="display:none">
		<form action="#" method="post" id="form02">
		<span class="guanbi" onclick="hideVideoList()">关闭</span>
		<div style="clear:both"></div>
		<table id='table_show_video'>
		
		</table>
		</form>
	</section>
	
	<section class="movieBox" id="movieBox" style="display:none">
		<video id="video" preload="auto" controls="controls" webkit-playsinline="true" playsinline="true" x5-video-player-type="h5">
		您的浏览器不支持 audio 标签。
		</video>
		<h3 id="videoName"></h3>
		<p id="videoBox">
			<!-- <h3 id="videoName"></h3> -->
			<!-- <span onclick="delVideo()">删除这首歌</span> -->
			<!-- <span onclick="seevideo()">试看这个视频</span> -->
			<!-- <span onclick="addSongList()">加入歌曲列表</span> -->
			<a href="" download="" onclick="downLoadMovie()" id="downLoadMovie">下载这个视频</a>
			<span onclick="shipin()">退出</span>
		</p>
	</section>

</body>
</html>

		
	
	
	
	
	
	
	
	
	
	
<!-- $sq="update user_info set userPassword='$userPassword' where userName='$userName'";
$p=mysql_query($sq);
if($p){
		echo "，你的密码已经重置为：".$nowPassword."<br><br>请及时修改密码";
}*/
 -->