<?php 
class DB_Connect{
	public $mycon;
	function __construct(){
		$this->connect();
	}

	function __destruct(){
		$this->disconnect();
	}

	function connect() {
		require ("config.php");
		$this->mycon=new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	}

	function disconnect(){
		mysqli_close($this->mycon);
	}


	function Cheapest(){
		$query = "SELECT * FROM `furniture` ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function Sales(){
		$query = "SELECT * FROM `furniture` ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function All(){
		$query = "SELECT * FROM `furniture` ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function BedRoom(){
		$query = "SELECT * FROM `furniture` WHERE `furniture`.`ID` IN (SELECT `classified`.`fru-id` FROM `classified` WHERE `classified`.`cls-id`='1') ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function LivingRoom(){
		$query = "SELECT * FROM `furniture` WHERE `furniture`.`ID` IN (SELECT `classified`.`fru-id` FROM `classified` WHERE `classified`.`cls-id`='2') ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function DiningRoom(){
		$query = "SELECT * FROM `furniture` WHERE `furniture`.`ID` IN (SELECT `classified`.`fru-id` FROM `classified` WHERE `classified`.`cls-id`='3') ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}

	function OfficeRoom(){
		$query = "SELECT * FROM `furniture` WHERE `furniture`.`ID` IN (SELECT `classified`.`fru-id` FROM `classified` WHERE `classified`.`cls-id`='4') ";
		$result = mysqli_query($this->mycon,$query);
		$response=array();
		if($result)
		{
			while ($row=mysqli_fetch_assoc($result)) 
			{
				array_push($response,$row);
			}
		}
		return $response;
	}
}
 ?>
