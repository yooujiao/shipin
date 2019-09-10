<?php

	/*这是一个搜索服务类文件，用于给控制器页面SearchController.php使用*/

	//引入SqlHelper.class.php类文件，给sql语句使用
	require_once 'SqlHelper.class.php';
	
	class SearchService{
		
		function SearchAudioVideo($search_info){ 
			//通过$search_info从数据库调出用户需要的音乐、视频资源
			//写sql语句，用于查询音乐、视频数据
			$sql_audio="";
			$sql_video="";
			if($search_info=="音乐视频资源"){
				
				$sql_audio="select userAudio,uploadUser,uploadDate from audio order by userAudioId desc";
				
				$sql_video="select userVideo,uploadUser,uploadDate from video order by userVideoId desc";
			}
			else if($search_info=="音乐资源"){
				
				$sql_audio="select userAudio,uploadUser,uploadDate from audio where userAudio like '%mp3%' order by userAudioId desc";
			}
			else if($search_info=="视频资源"){
				
				$sql_video="select userVideo,uploadUser,uploadDate from video where userVideo like '%mp4%' order by userVideoId desc";
			}
			else{
				
				$sql_audio="select userAudio,uploadUser,uploadDate from audio where userAudio like '%$search_info%' order by userAudioId desc";
				
				$sql_video="select userVideo,uploadUser,uploadDate from video where userVideo like '%$search_info%' order by userVideoId desc";
			
			}//if语句结束

			//实例一个sql_helper对象
			$sql_helper=new SqlHelper();
			
			//调用execute_dql2方法完成$sql语句的查询
			//返回的是一个音乐数据数组，用$res_audio接收返回的数组
			$res_audio=array();
			$res_video=array();
			if(!empty($sql_audio)){
				$res_audio=$sql_helper->execute_dql2($sql_audio);
			}

			//返回的是一个视频数据数组，用$res_video接收返回的数组
			if(!empty($sql_video)){
				$res_video=$sql_helper->execute_dql2($sql_video);
			}

			//定义一个$res_array数组，用于存放$res_audio数组和$res_video数组
			$res_array=array();
			$res_array['res_audio']=$res_audio;
			$res_array['res_video']=$res_video;
			
			//关闭连接
			$sql_helper->close_connect();
			
			//返回$res_array数组
			return $res_array;
		
		}//函数结束

	}

?>