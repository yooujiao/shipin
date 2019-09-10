<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='utf-8'>
<title>古道视频</title>
<?php
	//这里两句话很重要，第一句话告诉浏览器返回的数据是xml格式
	//header('Content-Type: text/html;charset=utf-8');
	//告诉浏览器不要缓存数据
	//header("Cache-Control: no-cache");
	session_start();
	//unset($_SESSION);
	//session_destroy(); 
	//获取客户端post传过来的参数;
	$a_v='';
	$c_v='';
	$num_v='';
	$a_v=trim($_GET['video_info_v']);
	$c_v=trim($_GET['num_v']);
	$num_v='video_info_v'.$c_v;
	//if(!empty($a_v)){
		//$_SESSION[$num_v]=$a_v;
		//array_push($_SESSION, $num_v);
	//}
	
	$b_v='';
	$b_v=$_SERVER["QUERY_STRING"];
	$b_v=substr($b_v, strripos($b_v,"=")+1);
	$b_v='video_info_v'.$b_v;
	//$a_v=$_SESSION[$b_v];
	
	$video_info_a=array();
	$video_info_a=json_decode($a_v, true);

	//unset($_SESSION);
	//session_destroy(); 
	//print_r($_GET);
	//exit;
	
	/*foreach($video_info_a as $key=>$value){ 
		$video_info_a[$key]=urlencode($value); 
	}
	urldecode(json_encode($video_info_a));//数组转json易出现中文乱码*/
?>
<link id="link" type="text/css" rel="stylesheet">
<script src='./js/my.js' type='text/javascript'></script>

<script type='text/javascript'>
var video_info_a=JSON.parse('<?php echo json_encode($video_info_a);?>');
var u_v=video_info_a.video_user_v;
var n_v=video_info_a.video_name_v;
var d_v=video_info_a.video_date_v;

var url_pc='./css/play_video_pc.css';
var url_phone='./css/play_video_phone.css';
var video;
//window.onload=function(){
//}
//window.onresize=function(){
//}
window.addEventListener('load', function(){
	
	video=get_obj('video_id');	
	
	wangye_m(url_pc, url_phone);
	
	load_video_m();//加载视频

	//push_state_m();//改变地址栏链接
	
	disableBackward();//屏蔽浏览器后退按钮
	
	event_m();//点击事件

	//play_pause_video_m();//播放暂停视频
});
//判断是手机进入网页还是电脑进入网页
function wangye_m(url_pc, url_phone)
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
//点击事件
function event_m(){
	
	//get_obj('back_page_id').addEventListener('click', back_page_m);
	//播放暂停视频
	get_obj('play_pause_id').addEventListener('click', play_pause_video_m);
	//加载视频
	get_obj('play_id').addEventListener('click', function(){
		load_video_m(1);
	});
	//关闭网页
	get_obj('close_id').addEventListener('click', close_page_m);
	//进入全屏
	get_obj('full_screen_id').addEventListener('click', full_screen_m);
	//下载视频
	get_obj('down_load_id').addEventListener('click', function(){
		down_load_m(u_v, n_v);	
	});
	//视频资料
	get_obj('video_info_i').addEventListener('click', function(){
		video_info_m(n_v, u_v, d_v);	
	});
	//关闭网页
	get_obj('close_video_i').addEventListener('click', video_info_m);
}
//改变地址栏链接
function push_state_m(){
	
	//var tit=document.title;
	var path='./play_video.php';
	//将追加了hash的链接推入history中
	history.pushState(null, null, path);//{title: tit, path: path}
	return true;
	
	/*history.pushState可以改变地址栏链接地址，但不触发页面刷新
	hash变化会触发popstate事件和hashchange事件
	popstate事件对象可以获得pushState传递进去的state属性，从而得到变化后的链接地址等
	hashchange事件对象中包含变化前后的链接地址（oldURL和newURL）
	浏览器的“前进”、“后退”可以触发hashchange事件*/
}
//加载视频
function load_video_m(num){//根据传入参数的不同执行不同的代码
	
	//video_user_v、video_name_v、video_date_v
	var a_v=video_info_a.video_user_v;
	var b_v=video_info_a.video_name_v;
	
	//重播状态
	if(num==1){
		
		if(confirm('是否要重新播放该视频')){
			
			video.src='./upload/'+a_v+'/'+b_v;
			video.play();
			video.loop='loop';
			get_obj('play_pause_id').style.color='green';
			get_obj('play_pause_id').innerHTML='播放中';
			get_obj('play_id').style.color='green';
			get_obj('play_id').innerHTML='已重播';
			
		}else{
			
			video.loop='';
			get_obj('play_id').style.color='';
			get_obj('play_id').innerHTML='重播';
		}
		
		return false;
	}
	
	//加载状态
	video.src='./upload/'+a_v+'/'+b_v;
	video.play();
	get_obj('h3_id').innerHTML=b_v;

	/*var a_v=get_obj('play_pause_id');
	if(video.played){
		a_v.style.color='red';
		a_v.innerHTML='暂停';
	}*/
}
//播放暂停视频
function play_pause_video_m(){
	
	var a_v=get_obj('play_pause_id');
	if(video.paused){
		video.play();
		a_v.style.color='green';
		a_v.innerHTML='播放中';
	}else{
		video.pause();
		a_v.style.color='red';
		a_v.innerHTML='暂停中';
	}	
}
//下载视频
function down_load_m(user_name_v, file_name_v){
	
	var url_v='./down_load_video.php';
	var data_v='?user_name_v='+user_name_v+'&file_name_v='+file_name_v;
	location.href=url_v+data_v;
	return true;
	
	/*var xml_v;
	xml_v=getXmlHttpObject();
	
	if(!xml_v){
		alert('ajax对象创建失败');
		return false;
	}
	var url_v='./down_load_video.php'; 
	var data_v='user_name_v='+user_name_v+'&file_name_v='+file_name_v;
	//alert(data_v);
	//return;
	xml_v.open('post', url_v, false);
	xml_v.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	
	//发送
	xml_v.send(data_v);*/
	//location.replace(url_v);
	//window.open(url_v);
}
//视频资料
function video_info_m(a, b, c){
	show_hide('div_i');
	get_obj('a_i').innerHTML='视频：'+a;
	get_obj('b_i').innerHTML='上传人：'+b;
	get_obj('c_i').innerHTML='上传日期：'+c;
}
//进入全屏
function full_screen_m(){
    //var ele = document.documentElement;
    if(video.requestFullscreen){
        video.requestFullscreen();
    }
	else if(video.mozRequestFullScreen) {
        video.mozRequestFullScreen();//火狐
    }
	else if(video.webkitRequestFullScreen) {
        video.webkitRequestFullScreen();//谷歌
    }
	else if(video.webkitEnterFullscreen){
		video.webkitEnterFullscreen();//苹果	
	}
	else if(video.msRequestFullscreen){
		video.msRequestFullscreen();//ie
	}
	else if(video.oRequestFullScreen){
		video.oRequestFullScreen();//欧鹏	
	}
}
//退出全屏
/*function exitFullscreen() {
    var de = document;
    if (de.exitFullscreen) {
        de.exitFullscreen();
    } else if (de.mozCancelFullScreen) {
        de.mozCancelFullScreen();
    } else if (de.webkitCancelFullScreen) {
        de.webkitCancelFullScreen();
    }
}*/
/*window.addEventListener('popstate', function(e){
	
	alert("抱歉，浏览器后退被禁用。");
	//alert(e.state.path);
	//location.reload(true);//刷新当前页面
	//location.replace(location.href);
	//location.assign(location.href);

});*/
/*window.addEventListener('hashchange', function(ev){
    alert(ev.oldURL);
	alert(ev.newURL);
	//pop.className += ' show';
});*/
</script>
</head>

<body>
	<section id="video_box_id">
		<video id='video_id' preload='auto' webkit-playsinline='true' playsinline='true' x5-video-player-type='h5' controlslist="nodownload" controls>
		</video>
		<h3 id='h3_id'></h3>
		
		<table>
		<tr>
		<td><span id='play_pause_id'>播放</span></td>
		<td><span id='down_load_id'>下载</span></td>
		<td id='video_info_i'><span>视频资料</span></td>
		</tr>
		<tr>
		<td><span id='play_id'>重播</span></td>
		<td><span id='full_screen_id'>全屏</span></td>
		<td><span id='close_id'>关闭</span></td>
		</tr>
		</table>
		
		<div id='div_i' style='display:none'>
		<ul>
		<li id='a_i'></li>
		<li id='b_i'></li>
		<li id='c_i'></li>
		<li><span id='close_video_i'>关闭页面</span></li>
		</ul>
		</div>
	</section>
</body>
</html>