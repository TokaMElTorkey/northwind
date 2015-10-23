<?php

/**
  *  Save project modifications in project file
  **/

if ( isset( $_POST['data'] )){

	$tableNum = (integer) $_POST['tableNumber'];
	$xmlFile = simpleXML_load_file("./projects/".$_POST['projFile']);
	if (!isset($xmlFile->table[$tableNum]->spm)){
	 	$xmlFile->table[$tableNum]->addChild("spm");	
	}
	$xmlFile->table[$tableNum]->spm= $_POST['data'];

	$xmlFile->asXML("./projects/".$_POST['projFile']);
}
