<?php
	include(dirname(__FILE__)."/header.php");
?>

<div class="page-header">
	<h1>Search Page Maker for AppGini</h1>
</div>

<div> 
	<div id="response"></div>
	<form method="post" id="my-awesome-dropzone" class="dropzone" autocomplete="off" enctype="multipart/form-data">
		<div class="dz-default dz-message">
			<h1>
				Drag your AppGini project file (*.axp) here to open it.
				<br><small>Or click to open the upload dialog.</small>
			</h1>
		</div>
	</form>
</div>


<style>
	.dz-image , .dz-preview{
		width: 100% !important;
		margin: auto !important;
	}	
	.dropzone {
	    border: 3px dotted blue;
		min-height: 100px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		background: rgba(0,0,0,0.03);
		padding: 23px;
	}
	
	.dz-default > img{
		max-width:100%;
		max-height:100%;
	}
	
	
</style>

<script>
	Dropzone.options.myAwesomeDropzone = {
	  paramName: "uploadedFile", // The name that will be used to transfer the file
	  url: "../plugins-resources/upload-ajax.php",
	  acceptedFiles: ".axp,.AXP",
	  uploadMultiple: false,
	  maxFiles: 1,
	  accept: function(file, done) {
		done();
	  },
	  init: function() {
            this.on("success", function(file, response) {
				$j(".dropzone").css( "border" ,"3px dotted blue");
				response = JSON.parse(response);
				if ( response["response-type"] =="success"){
					var successDiv = $j("<div>", {class: "alert alert-success" , style: "display: none; padding-top: 6px; padding-bottom: 6px;"});
					var successMsg = "File uploaded successfully."+(response.isRenamed?"<br>The project name already exists, the file was renamed to "+response.fileName+".":"");
					successDiv.html( successMsg );
					$j("#response").html(successDiv);
					dismissibleMsg( successDiv , "project.php?axp="+response.md5FileName );
				}
            });
			this.on("error", function(file, response){
				if($j.type(response) === "string"){
					response = "You must upload a (.axp) file"; //dropzone sends it's own error messages in string
				}else{
					response = response['error'];
				}
					
				$j("#response").html("<div class='alert alert-danger'>"+response+"</div>");
				$j(".dropzone").css( "border" ,"3px dotted red");
				
				setTimeout( deleteFile, 5000 , file , this);
			});
      }
	}
  	function deleteFile (file , elm){
			elm.removeFile(file);
	}

</script>

<?php 
	$currentProjects = scandir ( "../projects"  );
	$currentProjects = array_diff($currentProjects, array('.', '..'));
	$projectsNum = count($currentProjects);

	if ($projectsNum){ ?>
		<h4 class="pull-right" ><a href="" onclick="event.preventDefault(); jsDisplayProjects();"> Or open a project you uploaded before (<?php echo ($projectsNum == 1 ? 'one project' : "{$projectsNum} projects"); ?> found)</a></h4>


		<script>
			function jsDisplayProjects(){
				modal_window({ message: '<?php
					foreach ( $currentProjects as $projName ){
						echo "<div class=\"col-lg-3 col-md-3 col-sm-6 col-xs-6\"><div class=\"thumbnail\"><div class=\"caption\"><a href=\"project.php?axp=".md5($projName)."\"> <img src=\"../plugins-resources/images/bigprof-logo-only.png\" class=\"img-responsive\" alt=\AppGiniLogo\"> $projName </a></div></div></div>";
					}
				?>', title: "Current projects" });
			}
		</script>

		<?php 
	}
?>

</body>
</html>