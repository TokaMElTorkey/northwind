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
</style>


<div class="page-header">
	<h1>Search Page Maker for AppGini</h1>
	<h1><a href="./index.php">Projects</a> > <?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?></h1>
</div>

<div id="tables" class="col-md-3 col-xs-12">

	<?php
	for ( $i= 0 ; $i < count ($xmlFile->table) ; $i++ ){ ?>
		<div onclick="showFields(<?php echo $i; ?>)" style="padding:10px;cursor:pointer;"> <?php if (!empty($xmlFile->table[$i]->tableIcon)){ ?><img src="./resources/table_icons/<?php echo $xmlFile->table[$i]->tableIcon ;?>" alt="<?php echo $xmlFile->table[$i]->tableIcon ; ?>" >  <?php } echo ((String)($xmlFile->table[$i]->caption));	?> </div>

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

<?php
	$xmlFile = json_encode($xmlFile);
?>



<script>	

	$j( document ).ready( function(){

		$j("#tables").height( $j(window).height() - $j("#tables").offset().top );
		$j("#choosenFields, #fields").height( $j(window).height() - $j("#fields").offset().top );
		
		//add resize event
		$j( window ).resize(function() {
  			$j("#tables").height( $j(window).height() - $j("#tables").offset().top );
  			$j("#choosenFields, #fields").height( $j(window).height() - $j("#fields").offset().top );
		});
	});


	var xmlFile = <?php echo $xmlFile; ?>;

	function showFields( tableNum ){
		var field, type,currentType,table;
		$j("#fields").html('');

		//check number of tables
		if ($j.isArray(xmlFile.table)){      				//>1 table
			table = xmlFile.table[tableNum];
		}else{     											//1 table only
			table = xmlFile.table;
		}
		for (var i = 0 ; i< table.field.length ; i++){
				field = table.field[i];
				if ( (field.notFiltered == "False") && (field.tableImage=="False") && (field.detailImage=="False")){

					currentType = parseInt (field.dataType);
					type = getType(currentType , field);

					$j("#fields").append('<div id='+tableNum+"-"+i+' style="padding:10px;cursor:pointer;">'+field.caption +" ( "+type+" ) </div>");	
				}
		}
		
	}

	function getType(currentType , field){
		if (currentType ==1 ){  								//boolean
			type= "checkbox"
		}else if (currentType <9 ){  							//number
			type= "number range";
		}else if (currentType == 9 || currentType == 13 ){		//date
			type= "date range";
		}else if (currentType == 10 ){							//dateTime
			type= "date/time range";
		}else if (currentType < 13 ){  							//time
			type= "time range";
		}else{
			type="text";
		}

		//lookup
		if (!  $j.isEmptyObject(field.parentTable)){
			type="drop down";
		}
		//options list
		/*}else if (!  $j.isEmptyObject(field.CSValueList)){
			type="drop down";
		}*/
		return type;
	}

</script>






</body>
</html>