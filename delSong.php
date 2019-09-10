<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<?php

	header("content-type:text/html;charset=utf-8");

	require 'require.php';
	checkUserValidate();

	$song_id=$_POST['song_id'];
	$song_name=$_POST['song_name'];
	//print_r($_POST);
	//exit;

	//接下来，在连接数据库 ‘db3’
	//地址
	$url="localhost";
	//账号
	$user="root";
	//密码
	$password="root";
	//连接
	$con=@mysql_connect($url,$user,$password);
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


	$file_path01=$_SERVER['DOCUMENT_ROOT'].'/php/shipin/upload/'.$loginName.'/'.$song_name;
	$file_path02=iconv('utf-8','gbk',$file_path01);

	//判断要删除的音乐文件在磁盘上是否存在
	if(is_file($file_path02))
	{	
		//删除音乐文件
		if(unlink($file_path02))
		{
			echo '<br>'.$song_name.'——文件删除成功';
			
			//删除音乐数据
			$sql="delete from audio where userAudioId='$song_id'";
			$res=mysql_query($sql);
			if($res==true){
				echo '<br>'.$song_name.'——数据删除成功';
			}else{
				echo '<br>'.$song_name.'——数据删除失败';
			}
		}
		else
		{
			echo '<br>'.$song_name.'——文件删除失败';
			echo '<br>'.$song_name.'——数据删除失败';
		}
	}
	else
	{
		echo '<br>'.$song_name.'——文件不存在，不需要删除';	
	}

	echo '<div><a href="user_upload.php?errno=audio">返回音乐页面</a></div>';
?>