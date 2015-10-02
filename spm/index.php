<?php
	include("header.php");
?>
<div id="response" ></div>
<!--<form method="post" name="spmForm"  id="my-awesome-dropzone" class="dropzone" onSubmit="jsValidateASP();"  autocomplete="off"  enctype="multipart/form-data" >
</form>-->

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
    	<h3>Search Page Maker for AppGini</h3>  
		<h5>Upload your AppGini project file</h5>  
    </div>
  </div>
  <hr>
  <div> 

	<form method="post"  id="my-awesome-dropzone" class="dropzone"  autocomplete="off"  enctype="multipart/form-data" >
		<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
	  </form>
	</form>
  </div>
</div>

<style>
	.dz-image , .dz-preview{
		width: 100% !important;
		margin: auto !important;
	}	
	.dropzone {
	    border: 1px solid rgba(0,0,0,0.03);
		min-height: 150px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		background: rgba(0,0,0,0.03);
		padding: 23px;
	}
</style>

<script>
	Dropzone.options.myAwesomeDropzone = {
	  paramName: "uploadedFile", // The name that will be used to transfer the file
	  url: "spm-ajax.php",
	  acceptedFiles: ".axp,.AXP",
	  uploadMultiple: false,
	  maxFiles: 1,
	  accept: function(file, done) {
		done();
	  },
	    init: function() {
            this.on("success", function(file, response) {
				response = JSON.parse(response);
				if ( response["response-type"] =="success"){
				
					var successDiv = $j("<div>", {id: "foo", class: "alert alert-success" , style: "display: none; padding-top: 6px; padding-bottom: 6px;"});
					successDiv.html(response.data);
					$j("#response").html(successDiv);
					dismissibleMsg( successDiv , response.location )
				}else{
					$j("#response").html("<div class='alert alert-danger'>"+response.data+"</div>");
					this.removeFile(file);
				}
          
            })
			this.on("error", function(file){
				if (!file.accepted) this.removeFile(file);
                $j("#response").html("<div class='alert alert-danger'>You must upload a (.axp) file</div>");
			});
        }
	}
  
  
  
	function dismissibleMsg( element , location ){
	  $j(element).show("slow", function(){
			setTimeout(function(){
				$j("#<?php echo $id; ?>").hide("slow"); 
				window.location.href = location;
			}, 5000);
		});		
	}
</script>

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
?>

</body>
</html>