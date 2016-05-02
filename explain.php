<?php

class Explain{

public static $con;
	public function __construct(){
		$con = mysql_connect("localhost","username","password");
		if(!$con){
		  die("can not connect:" . mysql_error()); 
		}
		mysql_select_db("databasename",$con);
		$this->con = $con;
		$callTo = $_POST['callTo'];
		$food = $_POST['foodname'];
		if($callTo == "rcmd"){
			$this->rcmdexplain($food);
		}
		else if($callTo == "nrcmd"){
			$this->nrcmdexplain($food);
		}
	}

	public function rcmdexplain($food){
		$query = mysql_query("SELECT * FROM `explaintable` WHERE food = '".$food."'", $this->con);
		$explanation;
		if(mysql_num_rows($query)  == 0){
			echo "None";
		}
		else{
			while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
				$explanation = $row['rcmdexplain'];
			}
			echo $explanation;
		}
	}
	public function nrcmdexplain($food){
		$query = mysql_query("SELECT * FROM `explaintable` WHERE food = '".$food."'", $this->con);
		$explanation;
		if(mysql_num_rows($query)  == 0){
			echo "None";
		}
		else{
			while($row = mysql_fetch_array($query, MYSQL_ASSOC)){
				$explanation = $row['nrcmdexplain'];
			}
			echo $explanation;
		}
	}

}

new Explain();


