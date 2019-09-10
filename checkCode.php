<?php
	// echo rand(2,9);
	// echo "<br/>".dechex(rand(1,15))."<br/>";
		session_start();
		$checkCode="";
		for($i=0;$i<4;$i++){
			$checkCode.=dechex(rand(1,15)); //dechex函数 把一个十六进制数转成字符串
		}
		//$checkCode="1+2=";
		//讲随机验证码保存到session中
		$_SESSION['myCheckCode']=$checkCode;
		//创建图片，并把随机数画上去
		$img=imagecreatetruecolor(200,33);
		//背景默认就是黑色
		//你可以指定背景颜色
		$bgcolor=imagecolorallocate($img,0,0,0);
		imagefill($img,0,0,$bgcolor);
		//创建新的颜色
		$white=imagecolorallocate($img,255,255,255);
		$blue=imagecolorallocate($img,0,0,255);
		$red=imagecolorallocate($img,255,0,0);
		$green=imagecolorallocate($img,255,0,0);

		//画出干扰线段
		for($i=0;$i<20;$i++){
			/*switch(rand(1,4)){
				case 1:
					imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$green);
					break;
				case 2:
					imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$blue);
					break;
				case 3:
					imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$green);
					break;
				case 4:
					imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),$red);
					break;
			}*/
			//更好的方法是颜色随机
			imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)
			));
		}
		//画出噪点，自己画.
		//for($i=0;$i<10;
		//把四个随机值画上去

		imagestring($img,rand(1,5),rand(2,80),rand(2,10),$checkCode,
		$white);

		//如果要使用中文
		//array imagefttext ( string $font_file , string $text [, array $extrainfo])
		//imagettftext($img,15,10,20,25,$white,"STXINWEI.TTF","北京你好");
		//输出
		header("content-type: image/png");
		imagepng($img);
	
?>