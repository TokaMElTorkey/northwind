<?php
	include("header.php");
		
	
	if(isset($_POST['submit'])) {
	
		$file = pathinfo($_FILES['uploadedFile']['name']);
		$ext = $file['extension']; // get the extension of the file	
		$filename = $file['filename'];
			
		try {
			
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
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}
			
			

			//Check extention
			if ($ext != "axp") {
				throw new RuntimeException('You must upload a (.axp) file');
			}

			//Check filesize (~1MB)
			if ($_FILES['uploadedFile']['size'] > 1048576) {
				throw new RuntimeException('Exceeded filesize limit.');
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
			}

			//file uploaded successfully
			$id = 'notification-' . rand(); ?>
			
			<div id="<?php echo $id ; ?>" class="alert alert-success" style="display: none; padding-top: 6px; padding-bottom: 6px;">
				File uploaded successfully.
				<?php if ($renameFlag){ ?>
					<br>The project name already exists, the file was renamed to <?php echo $newName; ?>.
				<?php } ?>
			</div>
			<script>
				//Display dismissible message ( 5 seconds )
				jQuery(function(){
						jQuery("#<?php echo $id; ?>").show("slow", function(){
							setTimeout(function(){
								jQuery("#<?php echo $id; ?>").hide("slow"); 
								window.location.href = "project.php?<?php echo md5($renameFlag?$newName:$_FILES['uploadedFile']['name']);?>";
							}, 5000);
						});
				});
			</script>
			<?php

		} catch (RuntimeException $e) {
			echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
		}
	}
?>

<form method="post" name="spmForm"  onSubmit="jsValidateASP();"  autocomplete="off"  enctype="multipart/form-data" >
	<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
	<input type="file" name="uploadedFile" >
	<input type="submit" name="submit" value="Submit" >
</form>

<?php 
	$currentProjects = scandir ( "./projects"  );
	$currentProjects = array_diff($currentProjects, array('.', '..'));
	$projectsNum = count($currentProjects);

if ($projectsNum){ ?>
	<a href="" onclick="event.preventDefault(); jsDisplayProjects();"> or open a project you uploaded before( <?php echo $projectsNum; ?> project(s) found )</a>


	<script>
		function jsDisplayProjects(){
			modal_window({ message: '<?php
				foreach ( $currentProjects as $projName ){
					echo "<a href=\"project.php?".md5($projName)."\">$projName <span class=\'glyphicon glyphicon-chevron-right\'></span></a><br>";
				}
			?>', title: "Current projects" });
		}
	</script>

<?php
	}
	include("../footer.php");
?>

</body>
</html>