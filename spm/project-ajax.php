<?php

/**
  *  Save project modifications in project file
  **/

if ( isset( $_POST['data'] ) && isset($_POST['tableNumber']) && isset($_POST['projFile']) ){

	$tableNum = (integer) $_POST['tableNumber'];
	$projName = $_POST['projFile'];
	$data = $_POST['data'];

	@$xmlFile = simpleXML_load_file("./projects/".$projName);

	//validate input
	if ( !( (preg_match('/^[a-z0-9-_]+\.axp$/i', $projName ))&& 
		    (preg_match('/^[0-9:]*$/i', $data ))  &&
		    (isset($xmlFile->table[$tableNum]))		      
	    )) {
			die("");
	}
	if (!isset($xmlFile->table[$tableNum]->spm)){
	 	$xmlFile->table[$tableNum]->addChild("spm");	
	}
	$xmlFile->table[$tableNum]->spm= $data;

	$xmlFile->asXML("./projects/".$projName);
}
