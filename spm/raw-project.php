<?php
	include(dirname(__FILE__)."/header.php");

	// validate project name
	if (!isset($_GET['axp'])){
		echo 'Project file not found.';
		exit;
	}
	$projectFile = '';
	$xmlFile = getXMLFile( $_GET['axp'] , $projectFile);
//-----------------------------------------------------------------------------------------
?>

<pre><?php print_r($xmlFile); ?></pre>