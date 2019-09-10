<?php

	session_start();
?>
<script type='text/javascript'>
function errInfo(){

	var errInfo=document.getElementById("errInfo");
	var errNum="<?php echo $_GET['errno'];?>"; //接收错误编号
	var userName="<?php echo $_GET['username'];?>";
	var reg_username="<?php echo $_GET['reg_username'];?>";
	var reg_email="<?php echo $_GET['reg_email'];?>";
	
	//接收errno
	//if(!empty($_GET['errno'])){
		if(errNum==1){
			errInfo.innerHTML="用户名或者密码不能为空";
			errInfo.style.color="red";	
		}
		else if(errNum==2){
			errInfo.innerHTML="用户名或者密码错误";
			errInfo.style.color="red";
		}
		else if(errNum==3){
			errInfo.innerHTML="想要访问页面请先登录";
			errInfo.style.color="red";
		}
		/*else if(errNum==4){
			errInfo.innerHTML="想要上传文件请先登录";
			errInfo.style.color="red";
		}*/
		else if(errNum==5){
			errInfo.innerHTML=userName+"——没有注册";
			errInfo.style.color="red";
		}
		else if(errNum=='reg_error1'){
			document.getElementById('show_user').innerHTML=reg_username+'已经被他人抢先注册';
			document.getElementById('show_user').style.color='#0066cc';
		}
		else if(errNum=='reg_error2'){
			document.getElementById('show_e').innerHTML=reg_email+"已经注册了";
			document.getElementById('show_e').style.color="#0066cc";
		}
		else if(errNum=="showuploadbox"){
			document.getElementById('uploadBox').style.display="block";
		}
		else if(errNum=="audio"){
			document.getElementById('showSong').style.display="block";
			document.getElementById('uploadBox').style.display="block";
		}
		else if(errNum=="video"){
			document.getElementById('showVideo').style.display="block";
			document.getElementById('uploadBox').style.display="block";
		}
		else if(errNum=="checkcode"){
			errInfo.innerHTML="验证码错误";
			errInfo.style.color="red";
		}
	//}
}
/*function upload_data(){
	
	var upload_success_data=new Array();
	var upload_fail01_data=new Array();
	//上传成功的数据
	upload_success_data=eval('<?php echo json_encode($_SESSION["upload_success_data"]);?>');
	//上传失败的数据
	upload_fail01_data=eval('<?php echo json_encode($_SESSION["upload_fail01_data"]);?>');
	
	var uploadSuccessInfo=document.getElementById("uploadSuccessData");
	var uploadFailInfo=document.getElementById("uploadFailData");
	var success="<?php echo $_GET['success'];?>";
	var fail01="<?php echo $_GET['fail01'];?>";
	
	var str01="<br/><br/>"+success+"个文件上传成功";
	uploadSuccessInfo.style="color:green;font-weight:bold";
	document.getElementById('uploadBox').style.display="block";
	//document.getElementById("showSong").style.display="block";
		
	for(var i=0; i<upload_success_data.length; i++){
		str01+="<br/>"+upload_success_data[i]+"，上传成功";
	}
	uploadSuccessInfo.innerHTML=str01;
		
	str02="<br/><br/>"+fail01+"个文件上传失败";
	uploadFailInfo.style="color:red;font-weight:bold";
		
	for(var i=0; i<upload_fail01_data.length; i++){
		str02+="<br/>"+upload_fail01_data[i]+"，已存在，请重新上传，上传失败";
	}
		
	uploadFailInfo.innerHTML=str02;	
}*/
</script>



<!-- <?php

	echo "<script type='text/javascript'>
				window.onload=search;
				var z=6;
				function search(){
					z=z-1;
					var a=document.getElementById('div02')
					a.innerHTML=z+'秒后返回搜索页面，请稍候......';
					if(z<=0){
						window.location.href='index.php';
						return false;
					}
					window.setTimeout('search()',1000);
				}
			</script>";
			
	echo "<br><div id='div02'></div>";
?> -->
