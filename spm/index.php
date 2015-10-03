<?php
	include(dirname(__FILE__)."/header.php");
?>


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
    	<h3>Search Page Maker for AppGini</h3>  
		<h5>Upload your AppGini project file</h5>  
    </div>
  </div>
  <hr>
  <div> 
	<div id="response" ></div>
	<form method="post"  id="my-awesome-dropzone" class="dropzone col-md-12 col-xs-12"  autocomplete="off"  enctype="multipart/form-data" >
		<div class="dz-default dz-message"><img src="images/dropzone.png"><div data-dz-errormessage ><fcvfvf</div></div>
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
	  url: "spm-ajax.php",
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
					successDiv.html(response.data);
					$j("#response").html(successDiv);
					dismissibleMsg( successDiv , response.location );
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
				
				setTimeout( myfunc, 5000 , file , this);
			});
        }
	}
  	function myfunc(file , elm){
			elm.removeFile(file);
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
	<h4 class="pull-right" ><a href="" onclick="event.preventDefault(); jsDisplayProjects();"> Or open a project you uploaded before( <?php echo $projectsNum; ?> project(s) found )</a></h4>


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