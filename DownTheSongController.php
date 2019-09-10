<?php
	
	/***这是一个搜索控制器，给SearchUI.php页面发起请求用***/
	
	
	//这里两句话很重要，第一句话告诉浏览器返回的数据是xml格式
	header("Content-Type:text/xml;charset=utf-8");
	//告诉浏览器不要缓存数据
	//header("Cache-Control:no-cache");
	
	/*//引入SearchService类文件
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

	//require_once 'require.php'; //$loginName在require.php文件里
	//checkUserValidate();

	//验证用户是否合法登录
	require_once 'require.php';
	checkUserValidate();

	$audio_id=trim($_POST['AudioId']);
	
	if(!empty($audio_id)){
		$_SESSION['audio_id']=$audio_id;
	}

	$audio_id=$_SESSION['audio_id'];

	
	
	//$str="<info>{$audio_id}</info>";
	//file_put_contents("./mylog.log",$audio_id."\r\n",FILE_APPEND);

	//echo $str;
	
	//引入DownTheSongService类文件
	require_once 'DownTheSongService.class.php';
	
	//实例化一个$down_the_song对象
	$down_the_song=new DownTheSongService();

	//调用SearchSong($search_info)方法得到$res_audio_video数组，里面包含音乐数组和视频数组
	$success_fail=$down_the_song->DownTheSong($audio_id);
	/*echo '<pre>';
	print_r($success_fail);
	echo '</pre>';*/
	
	//var_dump($success_fail);

	echo $success_fail; 
	
	
	/*foreach($down_song as $val){
		$info=	
	}*/

	//file_put_contents("./mylog.log",$audio_id."\r\n",FILE_APPEND);
	
	/*<!-- if(!empty($chang_songs)){
		$audio_id=$chang_songs;
	}else{
		echo '你没有选择任何歌曲文件，请选择需要删除的歌曲文件';
		exit;
	}
	//print_r($audio_id);
	$audio_array=array();
	$audio_id_array=array();
	foreach($audio_id as $val)
	{
		//获取文件后缀名
		$num=explode('+',$val);
		$audio_array[]=reset($num);
		$audio_id_array[]=end($num);
	} -->*/

	
?>