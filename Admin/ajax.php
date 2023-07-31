<?php

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'save_product'){
	$save = $crud->save_product();
	if($save)
		echo $save;
}
if($action == 'delete_product'){
	$delete = $crud->delete_product();
	if($delete)
		echo $delete;
}