<?php

	class SqliHelper{
	
		private $mysqli;
		private static $search_res;
		//将来这里写的数据信息，是需要配置到一个文件
		private static $host="localhost";
		private static $user="root";
		private static $pwd="root";
		private static $db="db3";

		public function __construct(){
			
			//完成初始化得任务
			$this->mysqli=new MYSQLi(self::$host,self::$user,self::$pwd,self::$db);
			if($this->mysqli->connect_error){
				die("连接失败".$this->mysqli->connect_error);
			}
			//设置访问数据库的字符集
			//这句话的作用是保证php是以utf8的方式来操作我们的mysql数据库
			$this->mysqli->query("set names utf8");
		}

		public function execute_dql($sql){
			
			//query($sql)针对成功的 SELECT、SHOW、DESCRIBE 或 EXPLAIN 查询，将返回一个 mysqli_result 对象。针对其他成功的查询，将返回 TRUE。如果失败，则返回 FALSE。
			self::$search_res=$this->mysqli->query($sql) or die("操作dql".$this->mysqli->error);
			
			$arr=array();
			$arr=self::$search_res;
			
			return $arr;
		}
		public function execute_dql2($sql){
			
			/*$res=$this->mysqli->query($sql) or die("操作dql".$this->mysqli->error);
			return $res;*/

			$arr=array();
			
			self::$search_res=$this->mysqli->query($sql) or die("操作dql".$this->mysqli->error);
			
			//$i=0;
			//把$res=>$arr 把结果集内容转移到一个数组中. 
			while($row=self::$search_res->fetch_assoc()){//fetch_object()	
				//$arr[$i++]=$row;
				/*foreach($row as $key=>$val){
					$arr[$key]=$val;
					//$arr[]=$val;
				}*/
				
				$arr[]=$row;
			}
			
			return $arr;//返回二维数组
		}

		public function execute_dml($sql){
			
			$res=$this->mysqli->query($sql);
			
			if(!$res){
				return 0;//表示失败
			}else{
				if($this->mysqli->affected_rows>0){
					return 1;//表示成功
				}else{
					return 2;//表示没有行受到影响
				}
			}
			//关闭
			$this->mysqli->close();
		}

		public function close(){
			//释放内存
			self::$search_res->free();
			//关闭连接
			$this->mysqli->close();
		}

	}

//第095讲 php数据库编程⑦-使用mysqli扩展库（看完了）
