<?php
		
		
	
	/* get max. file size from php.ini configuration */
	function parse_size($size) {
	$unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
	$size = preg_replace('/[^0-9\.]/', '', $size); 		// Remove the non-numeric characters from the size.
	if ($unit) {
		// Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
		return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
	}else {
		return round($size);
		}
	}
  
	$maxFileSize = (parse_size(ini_get('post_max_size'))<parse_size(ini_get('upload_max_filesize'))?ini_get('post_max_size'):ini_get('upload_max_filesize'));
		
		try {

			//if file exceeded the filesize, no file will be sent
			if(!isset($_FILES['uploadedFile'])) {	
						throw new RuntimeException("No file sent, you must upload a (.axp) file not greater than $maxFileSize");
			}
			
			$file = pathinfo($_FILES['uploadedFile']['name']);
			$ext = $file['extension']; // get the extension of the file	
			$filename = $file['filename'];
				
			// Undefined | Multiple Files | $_FILES Corruption Attack
			// If this request falls under any of them, treat it invalid.
			
			// Check $_FILES['uploadedFile']['error'] value.
			switch ($_FILES['uploadedFile']['error']) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('You must upload a (.axp) file not greater than $maxFileSize"');
				default:
					throw new RuntimeException('Unknown errors.');
			}
		
			//Check extention
			if ( strtolower($ext) != "axp") {
				throw new RuntimeException('You must upload a (.axp) file');
			}
			
			// $_FILES['uploadedFile']['name'] validation
			if( !preg_match('/^[a-z0-9-_]+\.axp$/i', $_FILES['uploadedFile']['name'] )) {
				throw new RuntimeException('File was not uploaded. The file can only contain "a-z", "0-9", "_" and "-".');
			}
			
			//check existing projects' names 
			$currentProjects = scandir ( "./projects"  );
			
			natsort($currentProjects);
			$currentProjects = array_reverse ( $currentProjects );
			
			$renameFlag = false;

			foreach ( $currentProjects as $projName ){
				if ( preg_match('/^'.$filename.'(-[0-9]+)?.axp$/i', $projName )) {
					
					$matches = array();
					if ( !strcmp ( $_FILES['uploadedFile']['name'] , $projName) ){
						$newName = $filename."-"."1.axp";
						$renameFlag = true;
					}else{
					
						//increment number at the end of the name ( sorted desc, first one is the largest number)
						preg_match('/(-[0-9]+)\.axp$/i', $projName, $matches);
						$number = preg_replace("/[^0-9]/", '', $matches[0]);
						$newName = $filename."-".(((int)$number )+1).".axp";
						$renameFlag = true;
						break;
					}
					
				}else{
					//found name without number at the previous loop, and name with number not found at this loop
					if ($renameFlag){
						break;
					}
				}
			}
				
			if (!move_uploaded_file( $_FILES['uploadedFile']['tmp_name'], sprintf('./projects/%s',($renameFlag?$newName:$_FILES['uploadedFile']['name']))
			)) {
				throw new RuntimeException('Failed to move uploaded file.');
			}else{
		
				//file uploaded successfully							
				echo json_encode(array(
					"response-type" =>"success",
					"data" => "File uploaded successfully.".($renameFlag?"<br>The project name already exists, the file was renamed to $newName .":""),		
					"location" => "project.php?".md5($renameFlag?$newName:$_FILES['uploadedFile']['name'])
				));
			}	
			
		} catch (RuntimeException $e){
			header('Content-Type: application/json');
			header($_SERVER['SERVER_PROTOCOL'] . 'error; Content-Type: application/json', true, 400);
			echo json_encode(array(
					"error" => $e->getMessage()
				));
		}
	
?>
