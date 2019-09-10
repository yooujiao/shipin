<?php
	
	/***这是一个搜索控制器，给SearchUI.php页面发起请求用***/
	
	session_start();
	//这里两句话很重要，第一句话告诉浏览器返回的数据是xml格式
	header("Content-Type:text/xml;charset=utf-8");
	//告诉浏览器不要缓存数据
	//header("Cache-Control:no-cache");
	
	//引入SearchService类文件
	require_once 'SearchService.class.php';
	
	//从name=searchinfo获取用户的输入信息(SearchUI.php 行号121)
	//发送的是post请求，所以用post
	$search_info=trim($_POST['search']);
	
	if(!empty($search_info)){
		$_SESSION['searchInfo']=$search_info;
	}
	$search_info=$_SESSION['searchInfo'];
	
	//实例化一个$search_service对象
	$search_service=new SearchService();

	//调用SearchAudioVideo方法得到$res_audio_video数组，里面包含音乐数组和视频数组
	$res_audio_video=$search_service->SearchAudioVideo($search_info);
	
	//音乐数组
	$res_audio=$res_audio_video['res_audio'];
	
	//视频数组
	$res_video=$res_audio_video['res_video'];
	
	$info="<info>";
	for($i=0;$i<count($res_audio);$i++){
			
		$audio=$res_audio[$i];
		$info.="<audioname>{$audio['userAudio']}</audioname>
		<audiouser>{$audio['uploadUser']}</audiouser>
		<audiodate>{$audio['uploadDate']}</audiodate>";
	}
	for($j=0;$j<count($res_video);$j++){
			
		$video=$res_video[$j];
		$info.="<videoname>{$video['userVideo']}</videoname>
		<videouser>{$video['uploadUser']}</videouser>
		<videodate>{$video['uploadDate']}</videodate>";
	}
	$info.="</info>";
	echo $info;

	//file_put_contents("./mylog.log",$info."\r\n",FILE_APPEND);

	/*echo "<pre>";
	print_r($res_audio_video);
	echo "</pre>";*/
?>