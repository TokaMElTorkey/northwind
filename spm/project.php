<?php
	include(dirname(__FILE__)."/header.php");

// VALIDATIONS
try{
		// validate project name
		if (!isset($_GET['axp'])){
			throw new RuntimeException('Project file not found.');
		}

		$projects = scandir ( "./projects"  );
		$projects = array_diff($projects, array('.', '..'));
		$userProject = $_GET['axp'];
		$projectFile = null;

		foreach ( $projects as $project ){
			if ($userProject == md5($project)){
				$projectFile = $project ;
				break;
			}
		}
		if (!$projectFile) throw new RuntimeException('Project file not found.');

		// validate simpleXML extension enabled
		if (! function_exists(simpleXML_load_file)){
			throw new RuntimeException('Please, enable simplexml extention in your php.ini configuration file.');
		}


		// validate that the file is not corrupted
		@$xmlFile = simpleXML_load_file("./projects/$projectFile");
		if (!$xmlFile ){
			throw new RuntimeException('Invalid axp file.');
		}		

} catch (RuntimeException $e){
			echo "<br>".spm_error_message( $e->getMessage());
			exit;
}


var_dump($xmlFile);
?>





</body>
</html>