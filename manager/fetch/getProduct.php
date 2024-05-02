<?php

require_once("../../classes/serviceClass.php");

session_start();
if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
	header('Location: ./login.php');	
}

if(isset($_POST["ServiceInfomation"])){
    //Fetch all state data
	$service = new service($_POST["ServiceInfomation"]);
	echo '<option value=" ">Select Product</option>';
    
	foreach($service->product as $row){
        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
    }
	
}

 ?>