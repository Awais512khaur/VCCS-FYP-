<?php
require_once("DBmanager.php");

class feedback{
	
	public $id;
	public $content;
	public $addedby;
	
	public function __construct(){
	$argv = func_get_args();
        switch( func_num_args() ) {
            case 1:
                self::__construct1($argv[0]);
                break;
         }	
	}
	
	public function __construct1($id){
		
		$obj = new DBmanager();
		$obj -> view("SELECT * FROM feedback_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->content = $row['content']; 
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM customer_t where id='".$row['customer_id']."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->addedby =  $sub_row['name'];
			}
			
		}
	}
	
}

?>
