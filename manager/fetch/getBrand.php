<?php

require_once("../../classes/categoryClass.php");

session_start();
if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
	header('Location: ./login.php');	
}

if(isset($_POST["Category"])){
    //Fetch all state data
	$category = new category($_POST["Category"]);
	echo '<option value=" ">Select Brand</option>';
    
	foreach($category->getbrand() as $row){
        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
    }
	
}

 ?>