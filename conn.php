<?php
class conn {
	private $mysqli;
	private $result;
	public $sql;
	function __construct($sql) {
		$this->sql=$sql;
		$this->connect();
	}
	function connect() {
		$this->mysqli=new mysqli("localhost","root","root","libsystem");
		if(mysqli_connect_errno()) {
			die("Can not connect to mysql server");
		}
	}

	function fetch_res() {	
		$result=$this->mysqli->query($this->sql);
		while($row = $result->fetch_assoc()){
            $res_array[] = $row;
         }
         return $res_array;
	}
	function execute_sql() {
		$x=$this->mysqli->query($this->sql);
		return $x;
	}
	function setsql($value) {
		$this->sql=$value;
	}
	function __destruct() {
		if(!empty($result)) {
			$result->free();
		}
		$this->mysqli->close();
	}
}
?>