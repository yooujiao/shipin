<?php
require 'SqliHelper.class.php';
session_start();

class UserInfoService{
	
	public function user_info(){
		
		$sqli_helper=new SqliHelper();

		$login_name=$_SESSION['userName'];
		$sql_user_info="select * from user_info where userName='yooujiao' limit 1";
		
		$res_arr=$sqli_helper->execute_dql2($sql_user_info);
		//print_r($res_arr_length);
		//exit;
		$res_arr_length=count($res_arr);
		if($res_arr_length>0)
		{	//用户资料数组
			$user_info=array();
			foreach($res_arr[0] as $key=>$val)
			{	
				if($key=='userPassword'){
					$user_info[$key]='******';
					continue;
				}
				$user_info[$key]=$val;
			}
			
			foreach($user_info as $key=>$value){ 
				$user_info[$key]=urlencode($value); 
			}
			//return $user_info;
		}
		else
		{
			return "用户数据获取失败";
		}
		
		
		
		//获取音乐数据
		$sql_audio_info="select userAudioId,userAudio from audio where uploadUser='yingzi'";
		//isDownTheSong=1 and userAudioId,userAudio

		$res_audio=$sqli_helper->execute_dql2($sql_audio_info);
		if(empty($res_audio)){
			return '歌曲查询失败';	
		}

		$audio_id=array();//音乐id数组
		$audio_name=array();//音乐数组
		$audio_extension;//音乐扩展名

		$res_audio_length=count($res_audio);
		foreach($res_audio as $key=>$val)
		{	
			//获取音乐扩展名
			$audio_extension=pathinfo($val['userAudio'], PATHINFO_EXTENSION);
			//echo $audio_extension;
			if($audio_extension=="mp3")
			{	
				$a=$val['userAudioId'];
				$audio_id['audio_id_'.$a]=$a;
				$audio_name['audio_name_'.$a]=$val['userAudio'];
					
				//给音乐数组$audio_name数组末尾添加元素
				//array_push($audio_name, $res_audio[$i]['userAudio']);//添加元素
			}
		}

		foreach($audio_name as $key=>$value){ 
			$audio_name[$key]=urlencode($value); 
		}
		//return $audio_name;
		
		
		
		//获取视频数据
		$sql_video_info="select userVideo from video where uploadUser='yooujiao'";
		$res_video=$sqli_helper->execute_dql2($sql_video_info);
		$sqli_helper->close();

		if(empty($res_video)){
			return '查询视频失败';	
		}

		$video_name=array();//视频数组
		$video_extension;//视频扩展名

		$res_video_length=count($res_video);
		$i=0;
		foreach($res_video as $val)
		{
			//获取视频扩展名
			$video_extension=pathinfo($val['userVideo'], PATHINFO_EXTENSION);
			//echo $video_extension;
				
			if($video_extension=="mp4")
			{	
				$video_name['video_'.$i++]=$val['userVideo'];
					
				//给视频数组$video_array数组末尾添加元素
				//array_push($video_array,$row_video['userVideo']);//添加元素	
			}
		}

		foreach($video_name as $key=>$value){ 
			$video_name[$key]=urlencode($value); 
		}
		//return $video_name;
		
		$info=array();
		$info['user_info']=$user_info;
		$info['audio_id']=$audio_id;
		$info['audio_name']=$audio_name;
		$info['video_name']=$video_name;
		return urldecode(json_encode($info, JSON_PRETTY_PRINT));
	}
}
$abc=new UserInfoService();
echo '<pre>';
print_r($abc->user_info());
echo '</pre>';