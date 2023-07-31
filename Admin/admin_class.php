<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
   	include 'conn/config.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	}

	
	function save_product(){
		extract($_POST);
		$data = " Name = '".$Name."' ";
		$data .= ", Price = '".$Price."' ";


		if($_FILES['Image']['tmp_name'] != ''){
			$fname = $_FILES['Image']['name'];
			$move = move_uploaded_file($_FILES['Image']['tmp_name'],'news_images/'. $fname);
			$data .= ", Image = '".$fname."' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO product set ". $data);
			if($save)
				return 1;
		}else{
			$save = $this->db->query("UPDATE product set ". $data." where PID =".$id);
			if($save)
				return 1;
		}
	}
	function delete_product(){
		extract($_POST);
		$delete  = $this->db->query("DELETE FROM product where PID =".$id);
		if($delete)
			modal.style.hide();
			return 1;
	}
	
}