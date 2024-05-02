<?php

require_once("../../classes/customerClass.php");
require_once("../../classes/companyClass.php");
session_start();
if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
	header('Location: ./login.php');	
}

if(isset($_POST["customerInfomation"])){
    //Fetch all state data
	$customer = new customer($_POST["customerInfomation"]);
	echo '<option value=" ">Select Vehicle</option>';
    
	foreach($customer->vehicle as $row){
        echo '<option value="'.$row->id.'">'.$row->name.' ( '.$row->identity_number.' )</option>';
    }
	
}

if(isset($_POST["VehicleCompany"])){
    //Fetch all state data
	$company = new company($_POST["VehicleCompany"]);
	echo '<option value=" ">Select Vehicle</option>';
    
	foreach($company->getVehicles() as $row){
        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
    }
	
}

 ?>