<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<?php

	header("content-type:text/html;charset=utf-8");

	require_once 'require.php'; //$loginName在require.php文件里
	checkUserValidate();
	$audio_id=array();
	if(!empty($_POST['selectSong'])){
		$audio_id=$_POST['selectSong'];
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
	}
	//print_r($audio_array);
	//print_r($audio_id_array);
	//exit;

	//print_r($delAudio);
	//接下来，在连接数据库 ‘db3’
	//地址
	$url = "localhost";
	//账号
	$user = "root";
	//密码
	$password = "root";
	//连接
	$con = @mysql_connect($url,$user,$password);
	//判断数据库有无连接成功，连接失败会返回一个空
	if(!$con)
	{
		echo '连接失败';
		exit;
	}
	//设置编码机
	mysql_query("set names 'utf8'");
	//连接数据库
	mysql_select_db("db3");

	$y=count($audio_id_array);
	for($i=0; $i<$y; $i++)
	{
		//删除音乐文件
		$file_path01=$_SERVER['DOCUMENT_ROOT'].'/php/shipin/upload/'.$loginName.'/'.$audio_array[$i];
		$file_path02=iconv('utf-8','gbk',$file_path01);
		if(is_file($file_path02))
		{
			if(unlink($file_path02))
			{
				echo '<br>'.$audio_array[$i].'——文件删除成功';

				//删除音乐数据
				$sql="delete from audio where userAudioId='$audio_id_array[$i]'";
				$res=mysql_query($sql);
				if($res==true)
				{
					echo '<br>'.$audio_array[$i].'——数据删除成功';
				}
				else
				{
					echo '<br>'.$audio_array[$i].'——数据删除失败';
					continue;
				}
			}
			else
			{
				echo '<br>'.$audio_array[$i].'——文件删除失败';
				echo '<br>'.$audio_array[$i].'——数据删除失败';
				continue;
			}
		}
		else
		{
			echo '<br>'.$audio_array[$i].'——文件不存在，不需要删除';
			continue;
		}	
	}
	echo '<div><a href="user_upload.php?errno=audio">返回音乐页面</a></div>';
?>
