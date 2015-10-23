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
		min-height: 150px;
		overflow-Y:scroll;
	}
	#choosenFields,#fields{
		min-height: 95px;
		overflow-Y:scroll;
	}
	.item{
		cursor:pointer;
	}
</style>


<div class="page-header row">
	<h1>Search Page Maker for AppGini</h1>
	<h1><a href="./index.php">Projects</a> > <?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?>
	<button class="pull-right btn btn-success btn-lg col-md-3 col-xs-12"><span class="glyphicon glyphicon-play"></span>  Create Search Pages</button>
	</h1>

</div>


<div id="tables" class="col-md-3 col-xs-12 list-group"  >


	<?php
	for ( $i= 0 ; $i < count ($xmlFile->table) ; $i++ ){ ?>
	<a href="#" class="list-group-item" onclick="showFields( event , <?php echo $i; ?> , this)" > <?php if (!empty($xmlFile->table[$i]->tableIcon)){ ?><img src="./resources/table_icons/<?php echo $xmlFile->table[$i]->tableIcon ;?>" alt="<?php echo $xmlFile->table[$i]->tableIcon ; ?>" >  <?php } echo ((String)($xmlFile->table[$i]->caption));	?> </a>
 
	<?php
		//convert cData fields to string
		for ( $j= 0 ; $j < count ($xmlFile->table[$i]->field) ; $j++ ){ 
			$xmlFile->table[$i]->field[$j]->caption = (string) $xmlFile->table[$i]->field[$j]->caption;
			$xmlFile->table[$i]->field[$j]->CSValueList = (string) $xmlFile->table[$i]->field[$j]->CSValueList;
		}
	}
	?>
</div>

<div class="col-md-6 col-xs-12">
 	<h4><b>Fields in search page ( drag to re-order )</b></h4>
 	<div id="choosenFields" class="list-group" >
 	</div>
</div>

<div  class="col-md-3 col-xs-12">
 	<h4><b>Available fields/options</b></h4>
	<div id="fields" class="list-group">
	</div>
</div>
<h4 class="pull-left" ><a href="./index.php"> < Or open another project</a></h4>
<?php
	$xmlFile = json_encode($xmlFile);
?>



<script>	

	$j( document ).ready( function(){

		// sort divs by id in $fields section
		$j.fn.sortDivs = function sortDivs() {
		    $j("> div", this[0]).sort(custom_sort).appendTo(this[0]);
		    function custom_sort(a, b){ return (parseInt($j(b).data("sort")) < parseInt($j(a).data("sort"))) ? 1 : -1; }
		}

		//adjust div heights
		$j("#tables").height( $j(window).height() - $j("#tables").offset().top - $j(".pull-left").height() - 40 );
		$j("#choosenFields, #fields").height( $j("#tables").height() -  $j("h4").first().height() -20);

		//add resize event
		$j( window ).resize(function() {
  			$j("#tables").height( $j(window).height() - $j("#tables").offset().top -  $j(".pull-left").height()-40);
			$j("#choosenFields, #fields").height( $j("#tables").height() - $j("h4").first().height() -20 );		
		});


	    $j( "#choosenFields" ).sortable({
	        connectWith: "#fields",
	        cursor: "move",
			stop: function (event, ui) {
	        	updateList()
			},
			receive: function (event, ui) {
	        	updateList()
			},
			remove: function (event, ui) {
	        	updateList()
			}
	    }).disableSelection();


	    $j( "#fields" ).sortable({
			cursor: "move",
			//stop ordering the fields
			beforeStop: function (event, ui) {
				if($j(ui.helper).parent().attr('id') === 'fields' && $j(ui.placeholder).parent().attr('id') === 'fields'){
				   return false; 
				}
			},
			tolerance: 'pointer',
			receive: function (event, ui) {
				$j("#fields").sortDivs();
			},
			connectWith: "#choosenFields",
	    }).disableSelection();


	    $j('#tables > a').first().trigger('click');


	});

	function updateList(){
			var ids='';
        	var tableNumber = $j("#choosenFields").data('table');

        	//update array 
        	$j("#choosenFields").find("div").each(function() {
   				 ids+=( $j(this).attr("data-sort") )+":";
			});

        	//one/many tables in project
			currentTable = ( (typeof tableNumber != 'undefined')?xmlFile.table[tableNumber]:xmlFile.table);
			currentTable['spm'] =  ids;

			//update project file
			$j.ajax({
			  type: "POST",
			  url: "project-ajax.php",
			  data: {
			  	projFile: "<?php echo $projectFile; ?>",
			  	tableNumber: (tableNumber?tableNumber:0),
			  	data: (ids.length==0?null:ids)
			  },
			  success: function(response){
			  		//$j(".page-header").html(response);
			  		//console.log(response);

			  },
			});
	}

	var xmlFile = <?php echo $xmlFile; ?>;
	
	//sava fields' data types
	var tableData = [];

	function showFields( e , tableNum , elm){
		e.preventDefault();
		$j("#fields, #choosenFields").html('');
		$j("#tables a").removeClass("active");
		$j(elm).addClass("active");
		var field, type={} ,currentType,table;
		

		//check number of tables
		if ($j.isArray(xmlFile.table)){      				//>1 table
			table = xmlFile.table[tableNum];
			$j("#fields, #choosenFields").data('table',tableNum );
		}else{     											//1 table only
			table = xmlFile.table;
		}
		var chosenElements;
		if (table.spm){
			chosenElements = new Array(table.spm.split(":").length);
		}

		//get data types ( only for the first time the table is clicked )
		if (!tableData[tableNum]){
			tableData[tableNum] = {};
			for (var i = 0 ; i< table.field.length ; i++){
				field = table.field[i];

				//checks if the field is filtered, not an image, not auto-filled
				if ( (field.notFiltered == "False") && (field.tableImage=="False") && (field.detailImage=="False") && (field.autoFill=="False") ){
					currentType = parseInt (field.dataType);
					node = getType( currentType , field);
					tableData[tableNum][String(i)]=node;
				}
			}
		}

		//display data
		
		//convert ids string into array
		var spmDataArray = [];

		if(table.spm){
			var spmDataArray = table.spm.split(":");	
		}

		$j.each(tableData[tableNum], function( key, value ) {
			position = $j.inArray( key , spmDataArray );
			if ( position!== -1){
			  	chosenElements[position] = '<div class="list-group-item ui-state-default  item" data-sort='+key+'><span class="'+value.icon+'" ></span>     ' +value.caption +" ( "+value.name+" ) </div>";
			}else{
				$j("#fields").append('<div class="list-group-item ui-state-default  item" data-sort='+key+'><span class="'+value.icon+'" ></span>     ' +value.caption +" ( "+value.name+" ) </div>");	
			}
		});

		//fixed sections part
		i=9001;   //ORDER BY
		position = $j.inArray( String(i) , spmDataArray );
		if ( position !== -1){
			chosenElements[position] = '<div class="list-group-item ui-state-default  item" data-sort='+i+'><span class="glyphicon glyphicon-collapse-down" ></span>     Order by  ( section ) </div>';
		}else{
			$j("#fields").append('<div class="list-group-item ui-state-default  item" data-sort='+i+'><span class="glyphicon glyphicon-collapse-down" ></span>     Order by  ( section ) </div>');	
		}	
		i++;  //USER/GROUP/ALL
		position = $j.inArray( String(i) , spmDataArray );
		if ( position !== -1){
			chosenElements[position] = '<div class="list-group-item ui-state-default  item" data-sort='+i+'><span class="glyphicon glyphicon-user" ></span>     User/group/all  ( section ) </div>';
		}else{
			 $j("#fields").append('<div class="list-group-item ui-state-default  item" data-sort='+i+'><span class="glyphicon glyphicon-user" ></span>     User/group/all  ( section ) </div>');	
		}

		if ( chosenElements){
			$j("#choosenFields").html(chosenElements.join(" "));
		}
	}

	function getType( currentType , field ){
		var nodeData={};
		if (currentType ==1 ){  								//boolean
			nodeData.name= "checkbox";
			nodeData.icon = "glyphicon glyphicon-check";
		}else if (currentType <9 ){  							//number
			nodeData.name= "number range";
			nodeData.icon = "glyphicon glyphicon-resize-horizontal";

		}else if (currentType == 9 || currentType == 13 ){		//date
			nodeData.name= "date range";
			nodeData.icon = "glyphicon glyphicon-calendar";

		}else if (currentType == 10 ){							//dateTime
			nodeData.name= "date/time range";
			nodeData.icon = "glyphicon glyphicon-calendar";

		}else if (currentType < 13 ){  							//time
			nodeData.name= "time range";
			nodeData.icon = "glyphicon glyphicon-time";

		}else{
			nodeData.name="text";
			nodeData.icon="glyphicon glyphicon-text-size";
		}

		//lookup/unique
		if (!  $j.isEmptyObject(field.parentTable) ||  (field.unique=="true") ){
			nodeData.name="drop down";
			nodeData.icon = "glyphicon glyphicon-align-justify";

		//options list
		}else if (!  $j.isEmptyObject(field.CSValueList)){
			nodeData.name="multi select";
			nodeData.icon = "glyphicon glyphicon-align-justify";
		}
		nodeData.caption = field.caption;

		return nodeData;
	}

</script>






</body>
</html>