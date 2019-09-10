<!-- 添加viewport标签 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<!-- 禁止将数字变为电话号码 -->
<meta name="format-detection" content="telephone=no"/>
<!-- 允许全屏模式浏览，隐藏浏览器导航栏 -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- link标签，它支持用户将网页创建快捷方式到桌面时，其图标变为我们自己定义的图标。 -->
<link rel="apple-touch-icon-precomposed" href="http://3gimg.qq.com/wap30/info/info5/img/logo_icon.png">
<style type="text/css">
*{
	margin:0;
	padding:0;
	font-size:1em;
	font-family:楷体;
}
div{
	padding:1% 0% 0% 1%;	
}
p{
	color:red;
}
span{
	color:green;
	font-weight:bold;
	padding-left:1%;
}
a{
	padding-left:1%;	
}
</style>
<?php
header("content-type:text/html;charset=utf-8");
session_start();
$userName = $_SESSION["userName"];
//echo $userName;
if(empty($userName))
{
	header("Location:user_login01.php?errno=4");
	exit;
}
//$userName = iconv('utf-8','gbk',$userName);

/*echo "<pre>";
print_r($_FILES);
echo "</pre>";*/
//echo $_FILES['file']['type'][0];
//exit;
/*
$count = count($_FILES['file']['name']);

for ($i = 0; $i < $count; $i++)
{
	$name = iconv('utf-8','gbk',$_FILES['file']['name'][$i]);
	$file_name = iconv('gbk','utf-8',$name);
	
	$tmpfile = $_FILES['file']['tmp_name'][$i];
	//$filefix = array_pop(explode(".", $_FILES['file']['name'][$i]));
	//$dstfile = "uploads/files/".time()."_".mt_rand().".".$filefix;
	$dstfile = "upload/" . $name;

	if (move_uploaded_file($tmpfile, $dstfile))
	{
		echo '<pre>' . $file_name . '<br><br>文件上传成功'; //"<script>alert('succeed!');window.location.href='index_uploads.php';</script>";
	 }
	 else
	{
	   echo '文件上传失败'; //"<script>alert('fail!');window.location.href='index_uploads.php';</script>";
	}
	
}
*/

//允许上传的图片、音频后缀
/*$allowedExts = array("jpg" , "mp3" , "gif" , "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);  // 获取文件后缀名

if ((($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "image/gif")
//|| ($_FILES["file"]["type"] == "image/pjpeg")
//|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
//&& ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
&& in_array($extension, $allowedExts))
{*/
//echo "<div style='font-size:1.3em;color:green;font-weight:bold'>抱歉，没有你要的歌曲、视频资源</div>";
/*echo "<script type='text/javascript'>
		window.onload=search;
		var z=33;
		function search(){
			z=z-1;
			var a=document.getElementById('div3');
			a.innerHTML=z+'秒后返回搜索页面，请稍候......';
			if(z<=0){
				window.location.href='index.php';
				return false;
			}
			window.setTimeout('search()',1000);
		}
	</script>";
	echo "<div id='div3'></div>";*/
	
$count = count($_FILES['file']['name']);
$userDir = 'upload/'.$userName;
$userDir = iconv('utf-8','gbk',$userDir);
$success_audio_array=Array();
$success_video_array=Array();
$successAudio=0;
$successVideo=0;
$success=0;
$fail=0;
echo '<div>'.$userName.'，你的文件上传结果如下：</div>';
for ($i=0; $i<$count; $i++)
{
	$name = iconv('utf-8','gbk',$_FILES['file']['name'][$i]);
	$file_name = iconv('gbk','utf-8',$name);
	$upLoadError = $_FILES["file"]["error"][$i];

	/*if(!is_uploaded_file($_FILES['file']['tmp_name'][$i]))
	{
		//echo '错误：可能文件上传被攻击！文件名：';
		$fail++;
		echo 
		'<div><p>上传失败'
		.$fail.'</p>临时文件上传失败——'.$file_name.'
		</div>';
		continue;
	}*/

	if(!empty($file_name))
	{
		if(!is_dir($userDir))
		{ 
			//如果目录不存在则创建目录
			mkdir($userDir);	
		}
	}
	else
	{
		$fail++;
		echo '<div><p>上传失败'.$fail.'</p>没有任何文件可传，请选择需要上传的文件</div>';
		echo '<div><a href="user_upload.php?errno=showuploadbox">继续上传文件</a></div>';
		exit;
	}

	//判断文件上传是否存在错误
	if($_FILES["file"]["error"][$i]>0)
	{	
		$fail++;	
		switch($upLoadError)
		{
			case 1:
		    echo '<div><p>上传失败'.$fail.'</p>超过配置文件规定值——'.$file_name.'</div>'; //上传的文件超过了php.ini中upload_max_filesize选项限制的值
			continue;
		   
		    case 2:
		    echo '<div><p>上传失败'.$fail.'</p>超过表单设定值500M——'.$file_name.'</div>'; //上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
			continue;
		   
		    case 3:
		    echo '<div><p>上传失败'.$fail.'</p>上传不完全——'.$file_name.'</div>'; //文件只有部分被上传
			continue;
		   
		    case 4:
		    echo '<div><p>上传失败'.$fail.'</p>没有选择文件</div>'; //没有文件被上传，是指表单的file域没有内容，是空字符串
			continue;

		    case 6:
		    echo '<div><p>上传失败'.$fail.'</p>找不到临时文件夹——'.$file_name.'</div>';
			continue;
		   
		    case 7:
		    echo '<div><p>上传失败'.$fail.'</p>写入失败——'.$file_name.'</div>';
			continue;
		   

		    //default:
		    //echo "No number between 1 and 3";
		}
		continue;	
	}
	
	//判断文件大小
	if($_FILES["file"]["size"][$i]>524288000){//500mb=524288000b
		$fail++;
		echo '<div><p>上传失败'.$fail.'</p>超过500M，不允许上传——'.$file_name.'</div>';
		continue;
	}
	
	/*if(
		($_FILES["file"]["type"][$i] == "audio/mp3")
		||($_FILES["file"]["type"][$i] == "video/mp4")
		//|| ($_FILES["file"]["type"] == "image/x-png")
		//|| ($_FILES["file"]["type"][$i] == "image/jpeg")
		//|| ($_FILES["file"]["type"][$i] == "image/gif")
		//|| ($_FILES["file"]["type"][$i] == "image/png")
		&& in_array($extension,$allowedExts) //函数搜索数组中是否存在指定的值
	)*/
	
	//获取文件mime类型
	$finfo=finfo_open(FILEINFO_MIME_TYPE);
	$filename=$_FILES['file']['tmp_name'][$i];
	$mimetype=finfo_file($finfo,$filename);
	finfo_close($finfo);
	
	//判断文件类型
	if(!($mimetype=="audio/mpeg" || $mimetype=="video/mp4"))
	{
		//记录文件类型不对的个数
		$fail++;
		echo "<div><p>上传失败".$fail."</p>类型不正确，不允许上传——".$file_name."</div>";
		echo "<a>上传失败说明：不是mp3音频文件或者不是mp4视频文件——{$file_name}</a>";
		continue;
	}
	
	//获取文件后缀名
	$allowedExts = array("jpg","mp3","mp4","gif","png");
	$temp = explode(".",$_FILES["file"]["name"][$i]);
	$extension = end($temp);
	
	//判断文件格式
	if(!in_array($extension,$allowedExts))
	{	
		$fail++;
		echo "<div><p>上传失败".$fail."</p>格式不正确，不允许上传——".$file_name."</div>";
		echo "<a>上传失败说明：文件后缀名不是mp3或者不是mp4——{$file_name}</a>";
		continue;
	}
	
	//判断文件在指定的目录下是否有同名文件
	$dstfile = $userDir."/".$name;
	if(file_exists($dstfile))
	{
		$fail++;
		//header("Location:user_upload.php?errno=9&success=$success&fail01=$fail01&fail02=$fail02");
		//array_push($upload_fail01_data,$file_name);
		echo '<div><p>上传失败'.$fail.'</p>已经存在，请重新上传——'.$file_name.'</div>';
		continue;
	}
	
	
	
	/***验证通过的文件加入数据库***/
		
	//连接
	$con = @mysql_connect(localhost,root,root);
												
	//判断数据库有无连接成功，连接失败会返回一个空
	if(!$con)
	{
		echo '<div>连接失败</div>';
		exit;
	}
												 
	//设置编码机
	mysql_query("set names 'utf8'");
												 
	//连接数据库
	mysql_select_db("db3");
												 
	//编写SQL，执行SQL添加数据
	date_default_timezone_set('PRC');
	$date=date('Y-m-d H:i:s',time());
	
	//获取文件的扩展名		
	$file_name_extension=pathinfo($file_name,PATHINFO_EXTENSION);
	if($mimetype=="audio/mpeg" || $mimetype=="video/mp4")
	{
		if($file_name_extension=='mp3')
		{	
			$sql="insert into audio (userAudio,uploadUser,uploadDate) values('$file_name','$userName','$date')";
		}
		else if($file_name_extension=='mp4')
		{
			$sql="insert into video (userVideo,uploadUser,uploadDate) values('$file_name','$userName','$date')";	
		}
		else
		{	
			$fail++;
			echo "<div><p>上传失败{$fail}</p>文件类型正确，文件格式不正确，数据添加未执行——{$file_name}</div>";
			continue;
		}
	}
	else
	{
		$fail++;
		echo "<div><p>上传失败{$fail}</p>文件类型不正确，数据添加未执行——{$file_name}</div>";
		continue;	
	}
	
	//把sql语句发给dbms，执行得到结果集
	$is_ok=mysql_query($sql,$con);
	if($is_ok==false)
	{	
		//数据添加失败，执行以下代码
		if($file_name_extension=='mp3'){
			$fail++;
			echo '<div><p>上传失败'.$fail.'</p>音乐数据添加失败——'.$file_name.'</div>';
			echo '<a>音乐文件上传失败——'.$file_name.'</a>';
			echo '<br/><a>失败原因——数据添加语句，语法有误</a>';
		}
		else if($file_name_extension=='mp4'){
			$fail++;
			echo '<div><p>上传失败'.$fail.'</p>视频数据添加失败——'.$file_name.'</div>';
			echo '<a>视频文件上传失败——'.$file_name.'</a>';
			echo '<br/><a>失败原因——数据添加语句，语法有误</a>';
		}
		/*else{
			$fail++;
			echo '<div><p>上传失败'.$fail.'</p>数据添加失败——'.$file_name.'</div>';
			echo '<a>文件移动成功——'.$file_name.'</a>';
			echo '<br/><a>失败原因——上传通过了非音频、视频格式文件导致没执行数据添加语句</a>';
		}*/
		continue;
	}
	else
	{
		//$filefix = array_pop(explode(".", $_FILES['file']['name'][$i]));
		//$dstfile = "uploads/files/".time()."_".mt_rand().".".$filefix;
		
		//到此说明文件数据添加成功
		$tmpfile = $_FILES['file']['tmp_name'][$i];
		$dstfile = $userDir."/".$name;
		if(!move_uploaded_file($tmpfile,$dstfile))//移动文件
		{	
			//移动失败执行以下代码
			$fail++;
			echo '<div><p>上传失败'.$fail.'</p>移动失败——'.$file_name.'</div>';
			echo "<a>数据添加成功——{$file_name}</a>";	
			
			echo '<br/><a>失败原因——存储文件夹不存在，或者写入文件夹权限不足、文件路径编码有误导致无法写入文件</a>';
			echo "<br/><a>移动文件路径：{$dstfile}</a>";
				
			continue;//中断当前循环，进入下一次循环
			//break;
		}
		else
		{
			//移动成功执行以下代码
			if($file_name_extension=='mp3')
			{
				//$success++;
							
				/*echo '<div><p style="color:green">上传成功'.$success.'</p>'.$file_name.'——音乐文件上传成功</div>';
				echo '<div>'.$file_name.'——音乐数据添加成功</div>';*/
							
				$successAudio++;//音乐文件上传成功的个数

				array_push($success_audio_array,$file_name);
			}
			else if($file_name_extension=='mp4')
			{
				//$success++;
							
				/*echo '<div><p style="color:green">上传成功'.$success.'</p>'.$file_name.'——视频文件上传成功</div>';	
				echo '<div>'.$file_name.'——视频数据添加成功</div>';*/
							
				$successVideo++;//视频文件上传成功的个数

				array_push($success_video_array,$file_name);
			}
			/*else
			{
				echo '<p>有非法文件上传成功——'.$file_name.'</p>';	
			}*/
			
		}//文件移动结束
		
	}//数据添加结束
		
}//循环结束

if($fail>0){
	echo '<div style="color:red;font-weight:bold">'.$fail.'个文件上传失败</div>';
	echo '<hr/>';
}

echo '<span>'.($successAudio+$successVideo).'个文件上传成功</span>';
if($successAudio>0){
	echo '<div style="color:green">'.$successAudio.'个音乐文件</div>';
	foreach($success_audio_array as $val){
		echo '<a>'.$val.'——上传成功</a><br/>';
	}
	echo '<a href="user_upload.php?errno=audio">查看上传的音乐</a>';	
}
if($successVideo>0){
	echo '<div style="color:green">'.$successVideo.'个视频文件</div>';
	foreach($success_video_array as $val){
		echo '<a>'.$val.'——上传成功</a><br/>';
	}
	echo '<a href="user_upload.php?errno=video">查看上传的视频</a>';	
}
echo '<div><a href="user_upload.php?errno=showuploadbox">继续上传文件</a></div>';
//日期 date_default_timezone_set('PRC');
//开启session保存用户上传的文件名
//session_start();
//$_SESSION["upload_success_data"]=$upload_success_data;
//$_SESSION["upload_fail_data"]=$upload_fail_data;
//print_r($_SESSION["temp"]);		
		
		/*
		//判断当期目录下的 upload 目录是否存在该文件
		//如果没有 upload 目录，你需要创建它
		$name = iconv('utf-8','gbk',$_FILES["file"]["name"]);
		$file_name = iconv('gbk','utf-8',$name);
		
		if (file_exists("upload/" . $name))
		{
			echo '<h3 style="color:red;font-family:楷体">' . $file_name . ' 文件已经存在</h3>';
			echo "<h4 style='color:green;font-family:楷体'>你可以加入歌曲到歌曲列表播放！</h4>";
		}
		else
		{
			// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
			if(move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$name))
			{
				echo 
				"<h3 style='color:green;font-family:楷体'>
				文件上传成功
				</h3>";
					
				echo 
				"<h4 style='color:green;font-family:楷体'>
				你可以加入歌曲到歌曲列表播放了！
				</h4>";

				//连接
				$con = mysql_connect(localhost,root,hxm258);
					
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
					 
				//编写SQL，执行SQL添加数据
				$sq = "insert into video (videoName) values('$file_name')";
					 
				//把sql语句发给dbms，执行得到结果集
				$is_ok = mysql_query($sq,$con);
				if($is_ok == true)
				{
					echo '<br><br>恭喜你添加成功';
				}
				else
				{
					echo '<br><br>添加失败';
				}
			
			}
			else
			{
				echo "文件正在上传中，请稍等...";
			}
		
		
		}
		
	}*/
/*}
else
{
	echo "<h3 style='color:red'>非法的文件格式</h3>";
}*/
?>





 

