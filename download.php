<?php

header("Content-type:text/html;charset=utf-8");

//验证用户是否合法登录
require_once 'require.php';
checkUserValidate();

//只需要在php文件中设置请求头就可以了，创建download.php文件，代码如下：
$fileName=$_GET['filename']; //得到文件名
$userName=$_GET['username'];
$filePath=$_SERVER['DOCUMENT_ROOT'].'/php/shipin/upload/'.$userName.'/'.$fileName;
//exit($userName);
$filePath=iconv("utf-8","gbk",$filePath);

dowload_file($fileName,$userName,$filePath);

function dowload_file($fileName,$userName,$filePath){
	
	//file_exists($filePath)
	
	if(!is_file($filePath)){
		
		/*$arr=array('code'=>'-103','message'=>'操作失败','data'=>'没有该文件文件');
		
		foreach($arr as $key=>$value){ 
			$arr[$key]=urlencode($value); 
		}
 
		echo urldecode(json_encode($arr));*/
		
		echo "<script type='text/javascript'>
				var userName='{$userName}';
				alert(userName+'目录下没有这个文件');
				window.history.back();
			</script>";
		
		//header("Location:./SearchUI.php");
		
		exit();
	}
	
	//ob_clean();
	
	$fileSize=filesize($filePath);
	//告诉浏览器这是一个文件流格式的文件
	header("Content-type:application/octet-stream");
	//header("Content-type:audio/mpeg");
	header("Accept-Ranges:bytes");
	header("Content-Disposition:attachment; filename=".$fileName); //告诉浏览器通过附件形式来处理文件
	header('Content-Length:'.$fileSize); //下载文件大小
	readfile($filePath);  //读取文件内容
}
/*
文件下载代码：
ob_clean();
$action = $_GET['action'];
$filename = base64_decode($action);//传的参数encode了
$filepath = '/data/www/www.test.com/'.$filename;
if(!file_exists($filepath)){
 exit;
}
$fp=fopen($filepath,"r");
$filesize=filesize($filepath);
header("Content-type:application/octet-stream");
header("Accept-Ranges:bytes");
header("Accept-Length:".$filesize);
header("Content-Disposition: attachment; filename=".$filename);
$buffer=1024;
$buffer_count=0;
while(!feof($fp)&&$file_Size-$buffer_count>0){
$data=fread($fp,$buffer);
$buffer_count+=$buffer;
 echo $data;
}
fclose($fp);
PS：下面看一段实例代码php如何通过header文件头实现文件下载
具体代码如下所示：
$file = $_GET['file'];
if(file_exists($file)){
	header("Content-type:application/octet-stream");
	$filename = basename($file);
	header("Content-Disposition:attachment;filename = ".$filename);
	header("Accept-ranges:bytes");
	header("Accept-length:".filesize($file));
	readfile($file);
}else{
  echo "<script>alert('文件不存在')</script>";
}
总结：
以上所述是小编给大家介绍的PHP使用header方式实现文件下载功能，希望对大家有所帮助，如果大家有任何疑问请给我留言，小编会及时回复大家的。在此也非常感谢大家对脚本之家网站的支持！
3、看下下载所要用的的请求头
header("Content-type:application/octet-stream");
header("Accept-Ranges:bytes");
header("Accept-Length:".$file_Size);
header("Content-Disposition: attachment; filename=".$filename);
•content-type：文件类型
•Accept-Ranges：表示接收数据的类型或者范围，图片属于二进制的东西所以需要使用字节的方式传输
•Accept-Length：表示接收的文件大小，php文件下载需要告诉浏览器下载的文件有多大
•Content-Disposition：附件只需要把文件名给过去就可以，这个名称就是下载时显示的文件名称
4、php的文件操作出现的比较早，文件名是中文的时候需要注意转码
$filename=iconv("UTF-8","GB2312",$filename);
5、php的文件下载机制是首先nginx把文件信息读入服务器内存，然后使用请求头把文件二进制信息通过浏览器传给客户端
feof用来判断文件是否已经读到了末尾，fread用来把文件读入缓冲区，缓冲区的大小是1024，一边读取一边把数据输出到浏览器。为了下载的安全性每次读数据都进行字节的计数。文件读取完毕后关闭输入流
注意：
a、如果运行的过程中出现问题，可以清空（擦掉）输出缓冲区，使用下面的代码即可
ob_clean();
b、很多人喜欢用readfile，如果是大文件，可能会有问题



我们前面讲了使用php pathinfo()函数的作用返回文件路径的信息，php dirname()函数是返回文件路径中的目录部分，本篇文章主要介绍使用php basename()函数返回路径中的文件名部分。
$path = "www/testweb/home.php";
//显示文件名和文件扩展名
echo basename($path) ."<br/>";
//显示文件名没有文件扩展名
echo basename($path,".php");
代码讲解：
我们的第一个echo使用了不带suffix参数，返回了带有文件名和文件拓展名的信息，而二个echo，带有了suffix参数php，所以返回的是文件名，没有拓展名。



PHP有用的函数：
isset();
unset();
unlink();
第二个可能的原因是对服务器保存session的文件夹没有读取的权限，还是回到phpinfo.php中，查看session保存的地址：
session.save_path: var/tmp

所以就是检查下var/tmp文件夹是否可写。
写一个文件：test3.php来测试一下：
<?php
echo var_dump(is_writeable(ini_get("session.save_path")));
?>
如果返回bool(false)，证明文件夹写权限被限制了，那就换个文件夹咯，在你编写的网页里加入：

//设置当前目录下session子文件夹为session保存路径。
$sessSavePath = dirname(__FILE__).'/session/';

//如果新路径可读可写（可通过FTP上变更文件夹属性为777实现），则让该路径生效。
if(is_writeable($sessSavePath) && is_readable($sessSavePath))
{
session_save_path($sessSavePath);
}
*/
?>





