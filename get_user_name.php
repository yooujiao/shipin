<?php
function referer(){
		//没有防止
		//获取referer
		$num=1;
		if(isset($_SERVER['HTTP_REFERER']))
		{
			//取出来
			//判断$_SERVER['HTTP_REFERER']是不是以http://localhost/php/shipin/http开始->函数
				
			//strpos()函数 查找字符数首次出现的位置
			if(strpos($_SERVER['HTTP_REFERER'], 'http://localhost/php/shipin')==0)
			{
				//echo '小红的帐号信息......';
				$num=1;
			}
			else
			{
				//跳转到警告页面
				//echo '你是非法盗链者';
				//header("Location:index.php");
				$num=0;
			}
		}
		else
		{
			//跳转到警告页面
			//echo '你是非法盗链者';
			//header("Location: warning.php");
			$num=0;
		}

		session_start();
		$arr=array(
			'loginName'=>$_SESSION['userName'],
			'num'=>$num
		);
		
		return json_encode($arr);
		
		//所以一般来说，只有通过 <a></a> 超链接以及 POST 或 GET 表单访问的页面，$_SERVER['HTTP_REFERER'] 才有效。
}

echo referer(); 