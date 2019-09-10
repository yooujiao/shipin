<?php
header('Content-type:text/html; charset=utf-8');
//告诉浏览器不要缓存数据
header("Cache-Control: no-cache");

//验证用户是否合法登录
require 'require.php';
checkUserValidate();

$user_name=$_GET['user_name_v'];
$file_name=$_GET['file_name_v'];//得到文件名
//$file_sub_path=$_SERVER['DOCUMENT_ROOT'].'/php/shipin/upload/';
$file_sub_path=$_SERVER['DOCUMENT_ROOT'].'/upload/';
$file_path=$file_sub_path.$user_name.'/'.$file_name;

echo download_video_m($file_path, $file_name);
function download_video_m($file_path, $file_name){

	//执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去  
	set_time_limit(0);
	
	//即使client断开(关掉浏览器)，php也可以继续执行
	//ignore_user_abort(true);
	
	/*if(!empty($_GET['user_name_v'])){
		$_SESSION['user_name_v']=$_GET['user_name_v'];
	}
	if(!empty($_GET['file_name_v'])){
		$_SESSION['file_name_v']=$_GET['file_name_v'];
	}*/
	
	//dirname(__FILE__)//当前路径
	//basename($file_path);
	
	//if(!empty($file_path_v)){
		//$_SESSION['down_video_v']=$file_path_v;
	//}
	//$file_path_v=$_SESSION['down_video_v'];
	//exit($file_path_v);
	
	//如果是window系统要转码
	if(PATH_SEPARATOR==';'){
		$file_path=iconv('utf-8', 'gbk', $file_path);
		//$file_name=iconv('utf-8', 'gbk', $file_name);
	}
	//file_exists($file_path);
	if(!is_file($file_path)){
		
		return '文件不存在';
		
		/*$arr=array('code'=>'-103','message'=>'操作失败','data'=>'没有该文件文件');
		foreach($arr as $key=>$value){ 
			$arr[$key]=urlencode($value); 
		}
		echo urldecode(json_encode($arr));*/
		
		/*echo "<script type='text/javascript'>
				var user_name_v='{$user_name_v}';
				alert(user_name_v+'目录下没有这个文件');
				window.history.back();
			</script>";*/
		//header("Location:./SearchUI.php");
	}
	
	$file_size=filesize($file_path);
	//告诉浏览器这是一个文件流格式的文件
	header("Content-type:application/octet-stream");//application/octet-stream
	//header("Content-type:audio/mpeg");
	header("Accept-Ranges:bytes");
	//告诉浏览器通过附件形式来处理文件
	header("Content-Disposition:attachment; filename=".$file_name);
	//下载文件大小
	header('Content-Length:'.$file_size);

	//打开一个输出缓冲区，所有的输出信息不再直接发送到浏览器，而是保存在输出缓冲区里面
	ob_start();//ob_gzhandler gzip压缩
	//不要误认为用了ob_start()后，脚本的echo/print等输出就永远不会显示在浏览器上了，因为PHP脚本运行结束后，会自动刷新缓冲区并输出内容
	
	//清空ob缓存数据，不关闭缓冲区(不输出)
	//ob_clean();
	//发送内部缓冲区的内容到浏览器，删除缓冲区的内容，关闭缓冲区
	//ob_end_flush();
	
	//以确保到达output_buffering值
	//print str_repeat("", 4096);
	
	//rb只读打开二进制文件，只允许读数据
	$handle=fopen($file_path, 'rb');
	if(!$handle){
		return '文件打开失败，无法进行读写操作';
	}
	//我们设置一次读取1024个字节
	$buffer=1024*1024;
	$str='';
	//一边读，一边判断是否到达文件末尾
	while(!feof($handle)){
		//读
		$str=fread($handle, $buffer);
		//$str=str_replace("\r\n", "<br/>", $str);
		echo $str;
		
		//记录日志
		//file_put_contents("./mylog.log", $str."\r\n", FILE_APPEND);
		
		//发送内部缓冲区的内容到浏览器，删除缓冲区的内容，不关闭缓冲区
		//将数据从PHP的缓冲中释放出来
		ob_flush();//刷新PHP自身的缓冲区
		
		//将ob_flush释放出来的内容，以及不在PHP缓冲区中的内容，全部输出到浏览器，刷新内部缓冲区的内容，并输出
		//将缓冲内/外的数据全部发送到浏览器
		flush();//刷新apache的缓冲区
		
		//等待1毫秒后再执行
		usleep(100);//usleep()是暂停多少微秒，sleep()是暂停多少秒
	}
		
	fclose($handle);
	
	//删除内部缓冲区的内容，关闭缓冲区(不输出)
	ob_end_clean();
	
	//发送内部缓冲区的内容到浏览器，删除缓冲区的内容，关闭缓冲区
	//ob_end_flush();
	return '下载成功';
	
	//readfile($file_path);//读取文件内容
	//file_get_contents($file_path);
	//fread($file_path);
}


 
