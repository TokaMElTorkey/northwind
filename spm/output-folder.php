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

<link rel="stylesheet" href="./resources/css/animate-bootstrap-icons.css">

<style>
	.transparent{
		background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:default;
        overflow: hidden;
	}
	.popover{
		background-color: rgba(191, 70, 70, 0.33);
	}
	.popover.right .arrow:after {
		  border-right-color: rgba(191, 70, 70, 0.33);
	}
</style>


<div class="page-header row">
	<h1>Search Page Maker for AppGini</h1>
	<h1><a href="./index.php">Projects</a> > <a href="./project.php?axp=<?php echo $_GET['axp'] ?>"><?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?></a> > Select output folder
	</h1>

</div>

<h4>Full path to your application folder</h4>
<div class='form-group'>
	<input onkeyup='validatePath(this)' type='text' class='form-control col-md-11 col-xs-9' value='<?php echo addslashes(dirname(dirname(__FILE__))); ?>'>
</div>
<button data-toggle='popover' title='' data-content='' class='transparent btn'>
	<i class='glyphicon glyphicon-ok' id='mark' style='color:#30C313;' ></i>
</button>
<br>
<h5><i>For example: /var/www/my-app</i></h5>
<center>
	<button id="start" onclick="" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play" ></span>  Start</button>
</center>



<script>
	function validatePath(elm){
		 
		$j("#mark").attr('class' , 'glyphicon glyphicon-refresh gly-spin');
		$j(".transparent").popover('hide').off();
		$j("#start").hide();
	
		$j.ajax({
			  type: "POST",
			  url: "project-ajax.php",
			  data: {
			  	actionName: "validatePath",
			  	path: elm.value
			  },
			  success: function(response){
			  		if (response == "ok"){
			  			$j("#mark").attr('class' , 'glyphicon glyphicon-ok').css("color" , "#30C313");
			  			$j("#start").show();
			  		}else{
			  			$j("#mark").attr('class' , 'glyphicon glyphicon-remove').css("color" , "red");
			  			$j(".transparent").attr("data-content",response);
					    $j(".transparent").popover()
					            .on('mouseenter', enterShow)
					            .on('mouseleave', exitHide);
			  		}
			  },
		});

	}

	//popover functions
	var enterShow = function() {
        $j(".transparent").popover('show');
    };

    var exitHide = function() {
        $j(".transparent").popover('hide');
    }


</script>