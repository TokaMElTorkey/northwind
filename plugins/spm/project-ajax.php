<?php
@include("../plugins-resources/plugins-common.php");



 /**
  *  Save project modifications in project file
  */

if ( isset( $_POST['data'] ) && isset($_POST['tableNumber']) && isset($_POST['projFile']) ){

	$tableNum = (integer) $_POST['tableNumber'];
	$projName = $_POST['projFile'];
	$data = $_POST['data'];

	//validate data 
	if (! preg_match('/^[0-9:]*$/i', $data )){
			die("");
	}

	//update node with new data after validating it
	if (update_project_plugin_node($projName , $tableNum , 'spm' , $data )){
		echo  "ok";
	}


/**
  *  validate the given project folder
  **/

}else if ( isset($_POST['actionName']) && $_POST['actionName'] == 'validatePath'){

	$path = $_POST['path'];

	try{
		if (! is_dir($path)){
			throw new RuntimeException('Invalid path');
		}
		

		if ( ! ( file_exists("$path\lib.php") && file_exists("$path\db.php") && file_exists("$path\index.php") ) ){
			throw new RuntimeException('The given path is not a valid AppGini project path');
		}
		if (! is_writable($path."/hooks")){
			throw new RuntimeException('The hooks folder is not writable');
		}
		if (! is_writable($path."/resources") ){
			throw new RuntimeException('The resources folder is not writable');
		}

	} catch (RuntimeException $e){
			echo  $e->getMessage();
			exit;
	}
	

	echo "ok";
}
