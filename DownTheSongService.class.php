<?php

	/*这是一个下架歌曲服务类文件，用于给控制器页面DownTheSongController.php使用*/

	//引入SqlHelper.class.php类文件，给sql语句使用
	require_once 'SqlHelper.class.php';
	
	
	class DownTheSongService{
		
		function DownTheSong($audio_id){
			
			session_start();
			$loginName=$_SESSION['userName'];
			
			if(empty($audio_id)){
				return '<mes>超时了，请重新下架歌曲</mes>';
			}
			
			$audio_id_array=array(); 
			$audio_id_array=json_decode($audio_id);
			
			$audio_array=array();
			$id_array=array();
			for($i=0;$i<count($audio_id_array);$i++){
				if($i%2==0){
					array_push($audio_array,$audio_id_array[$i]);
				}else{
					array_push($id_array,$audio_id_array[$i]);	
				}
			}
			
			//实例一个sql_helper对象
			$sql_helper=new SqlHelper();
			$return_num=array();
			$audio_success=array();
			$audio_fail=array();
			//$id=array();
			//$audio_success_fail=array();
			for($p=0;$p<count($id_array);$p++){
				
				
			}
			
			for($j=0;$j<count($id_array);$j++){
				
				$audio="select isDownTheSong from audio where userAudioId=$id_array[$j]";
				$res=$sql_helper->execute_dql2($audio);
				array_push($return_num,$res);
				//return $res[0][isDownTheSong];
				if($return_num[$j][0]['isDownTheSong']==1){
					array_push($audio_fail,$audio_array[$j]);
					continue;
				}
				
				$update_audio="update audio set isDownTheSong=1 where userAudioId=$id_array[$j] and userAudio='$audio_array[$j]'"; // and userAudio='$audio_array[$j]' userAudioId=$id_array[$j]

				$num=$sql_helper->execute_dml($update_audio);
				
				if($num==1){
					array_push($audio_success,$audio_array[$j]);
				}
			}
			//return $audio_success;
			
			$audio_info_array=array();
			if(count($audio_fail)==0){
				$select_audio="select userAudioId,userAudio,uploadDate from audio where isDownTheSong=0 and uploadUser='$loginName'";
				$audio_info_array=$sql_helper->execute_dql2($select_audio);
			}
				
			$user_audio_id=array();
			$user_audio=array();
			$upload_date=array();
			for($m=0;$m<count($audio_info_array);$m++){
				array_push($user_audio_id,$audio_info_array[$m]['userAudioId']);
				array_push($user_audio,$audio_info_array[$m]['userAudio']);
				array_push($upload_date,$audio_info_array[$m]['uploadDate']);
			}
			
			//返回所有信息
			$info="<info>";
			for($k=0;$k<count($audio_success);$k++){
				$info.="<success>{$audio_success[$k]}</success>";
			}
			for($n=0;$n<count($audio_fail);$n++){
				$info.="<fail>{$audio_fail[$n]}</fail>";
			}
			for($z=0;$z<count($user_audio);$z++){
				$info.="<songname>{$user_audio[$z]}</songname>";
				$info.="<songid>{$user_audio_id[$z]}</songid>";
			}
			$info.="</info>";
			
			//关闭连接
			$sql_helper->close_connect();
			
			return $info;

			/*//通过$search_info从数据库调出用户需要的音乐、视频资源
			//写sql语句，用于查询音乐、视频数据
			$sql_audio="";
			$sql_video="";
			

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
			return $res_array;*/
		
		}//函数结束

	}

?>