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
//-----------------------------------------------------------------------------------------
?>


<style>
	#tables{
		min-height: 110px;
		overflow-Y:scroll;
	}
	#choosenFields,#fields{
		min-height: 60px;
		overflow-Y:scroll;
	}
	.clicked{
	    background-color: #79BD9A;
	    color: green;
	}
	.item{
		padding:10px;
		cursor:pointer;
	}
</style>


<div class="page-header">
	<h1>Search Page Maker for AppGini</h1>
	<h1><a href="./index.php">Projects</a> > <?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?>
	<button class="pull-right btn btn-success btn-lg"><span class="glyphicon glyphicon-play"></span>  Create Search Pages</button>
	</h1>

</div>


<div id="tables" class="col-md-3 col-xs-12">

	<?php
	for ( $i= 0 ; $i < count ($xmlFile->table) ; $i++ ){ ?>
		<div onclick="showFields(<?php echo $i; ?> , this)" style="padding:10px;cursor:pointer;"> <?php if (!empty($xmlFile->table[$i]->tableIcon)){ ?><img src="./resources/table_icons/<?php echo $xmlFile->table[$i]->tableIcon ;?>" alt="<?php echo $xmlFile->table[$i]->tableIcon ; ?>" >  <?php } echo ((String)($xmlFile->table[$i]->caption));	?> </div>

	<?php
		//convert cData fields to string
		for ( $j= 0 ; $j < count ($xmlFile->table[$i]->field) ; $j++ ){ 
			$xmlFile->table[$i]->field[$j]->caption = (string) $xmlFile->table[$i]->field[$j]->caption;
			$xmlFile->table[$i]->field[$j]->CSValueList = (string) $xmlFile->table[$i]->field[$j]->CSValueList;
		}
	}
	?>
</div>
<div class="col-md-9 col-xs-12">
	<div class="col-md-8">
	 	<h4><b>Fields in search page ( drag to re-order )</b></h4>
	 	<div id="choosenFields" >
	 	</div>
	</div>

	<div  class="col-md-4">
	 	<h4><b>Available fields/options</b></h4>
		<div id="fields" style="border:solid 1px black;">
		</div>
	</div>

</div>
<h4 class="pull-left" ><a href="./index.php"> < Or open another project</a></h4>
<?php
	//var_dump($xmlFile->table[2]->field[6]);
	$xmlFile = json_encode($xmlFile);
?>



<script>	

	$j( document ).ready( function(){

		$j("#tables").height( $j(window).height() - $j("#tables").offset().top - $j(".pull-left").height() - 20 );
		$j("#choosenFields, #fields").height( $j(window).height() - $j("#fields").offset().top-  $j(".pull-left").height() -20 );

		$j("#choosenFields").droppable({
			tolerance: "intersect",
			accept: ".ui-widget-content",
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			drop: function(event, ui) {
				$j("#choosenFields").append($j(ui.draggable));
			}
		});

		$j("#fields").droppable({
			tolerance: "intersect",
			accept: ".ui-widget-content",
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			drop: function(event, ui) {
				$j("#fields").append($j(ui.draggable));
			}
		});
		
		//add resize event
		$j( window ).resize(function() {
  			$j("#tables").height( $j(window).height() - $j("#tables").offset().top -  $j(".pull-left").height()-20);
  			$j("#choosenFields, #fields").height( $j(window).height() - $j("#fields").offset().top -  $j(".pull-left").height()-20);
		});
	});


	var xmlFile = <?php echo $xmlFile; ?>;

	function showFields( tableNum , elm){

		$j("#fields, #choosenFields").html('');
		$j("#tables div").removeClass("clicked");
		$j(elm).addClass("clicked");
		var field, type={} ,currentType,table;
		

		//check number of tables
		if ($j.isArray(xmlFile.table)){      				//>1 table
			table = xmlFile.table[tableNum];
		}else{     											//1 table only
			table = xmlFile.table;
		}
		for (var i = 0 ; i< table.field.length ; i++){
				field = table.field[i];

				//checks if the field is filtered, not an image, not auto-filled
				if ( (field.notFiltered == "False") && (field.tableImage=="False") && (field.detailImage=="False") && (field.autoFill=="False") ){

					currentType = parseInt (field.dataType);
					type = getType(currentType , field, type);

					$j("#fields").append('<div class="ui-widget-content item" id='+tableNum+"-"+i+' ><span class="'+type.icon+'" ></span>     ' +field.caption +" ( "+type.name+" ) </div>");	
				}
		}

		$j("#fields").append('<div class="ui-widget-content item"><span class="glyphicon glyphicon-collapse-down" ></span>     Order by  ( section ) </div>');	
		$j("#fields").append('<div class="ui-widget-content item"><span class="glyphicon glyphicon-user" ></span>     User/group/all  ( section ) </div>');	

		$j("#fields div").draggable({
		    appendTo: "body",
		    cursor: "move",
		    helper: 'clone',
		    revert: "invalid"
		});
		
	}

	function getType(currentType , field , type){
		if (currentType ==1 ){  								//boolean
			type.name= "checkbox";
			type.icon = "glyphicon glyphicon-check";

		}else if (currentType <9 ){  							//number
			type.name= "number range";
			type.icon = "glyphicon glyphicon-resize-horizontal";

		}else if (currentType == 9 || currentType == 13 ){		//date
			type.name= "date range";
			type.icon = "glyphicon glyphicon-calendar";

		}else if (currentType == 10 ){							//dateTime
			type.name= "date/time range";
			type.icon = "glyphicon glyphicon-calendar";

		}else if (currentType < 13 ){  							//time
			type.name= "time range";
			type.icon = "glyphicon glyphicon-time";

		}else{
			type.name="text";
			type.icon="glyphicon glyphicon-text-size";
		}

		//lookup/unique
		if (!  $j.isEmptyObject(field.parentTable) ||  (field.unique=="true") ){
			type.name="drop down";
			type.icon = "glyphicon glyphicon-align-justify";

		//options list
		}else if (!  $j.isEmptyObject(field.CSValueList)){
			type.name="multi select";
			type.icon = "glyphicon glyphicon-align-justify";
		}

		return type;
	}

</script>






</body>
</html>