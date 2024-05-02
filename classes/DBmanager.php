<?php
class DBmanager{	
	function opendb(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "vccs_db";
		
		$pstmt=NULL;
		
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		catch(PDOException $e){
			echo  $e->getMessage();
		}
		
	}

	function closedb(){
		
		$conn=NULL;
	}
	function update($query){
		
		$conn = $this->opendb();		
		$stmt = $conn->prepare($query);	
		$msg = NULL;
		try{
			$stmt->execute();
			$msg = "success";
		}
		catch(PDOException $e){
			$msg = $e -> getMessage();	
		}
		$this->closedb();
		return $msg;
	}
	var $pstmt;
	
	function view($query){
		$conn = $this->opendb();
		$this->pstmt = $conn -> prepare($query);
		$this->pstmt -> execute();
		$this->closedb();
		
		//echo("TEST VIEW FUNCTIOn");
	}
	
	function insert($query)
	{		
		$conn = $this->opendb();		
		$stmt = $conn->prepare($query);	
		$msg = NULL;
		try{
			
			$stmt->execute();
			$msg = "success";
			
		}
		catch(PDOException $e){
			$msg = $e -> getMessage();	
		}
		$this->closedb();
		return $msg;
	
	}
	
}

?>

