<?php
class DBDA{
	public $host="localhost"; //服务器地址
	public $uid="root"; //用户名
	public $pwd="123"; //密码
	public $dbname="weibo"; //数据库名称	
	/*
		执行一条SQL语句的方法
		@param sql 要执行的SQL语句
		@param type SQL语句的类型，0代表查询 1代表增删改
		@return 如果是查询语句返回二维数组，如果是增删改返回true或false
	*/
	public function query($sql,$type=0){
		$db = new MySQLi($this->host,$this->uid,$this->pwd,$this->dbname);
		$result = $db->query($sql);
		if($type){
			return $result;
		}else{
			return $result->fetch_all();
		}
	}
	//返回字符串的方法
	public function strquery($sql,$type=0){
		$db = new MySQLi($this->host,$this->uid,$this->pwd,$this->dbname);
		$result = $db->query($sql);
		if($type){
			return $result;
		}else{
			//return $result->fetch_all();
			$arr = $result->fetch_all();
			$str = "";
			foreach($arr as $v){
				$str .= implode("^",$v)."|";
				}
			$str = substr($str,0,strlen($str)-1);
			return $str;
		} 
		}
	//返回JSON的方法
	public function jsonquery($sql,$type=0){
		$db = new MySQLi($this->host,$this->uid,$this->pwd,$this->dbname);
		$result = $db->query($sql);
		if($type){
			return $result;
		}else{
			//return $result->fetch_all();
			$arr = $result->fetch_all(MYSQLI_ASSOC);
			return json_encode($arr);
		} 
		}
}