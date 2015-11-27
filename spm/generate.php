<?php
include(dirname(__FILE__) . "/header.php");

// validate project name
if (!isset($_GET['axp'])) {
    echo 'Project file not found.';
    exit;
}
$projectFile = '';
$xmlFile = getXMLFile($_GET['axp'], $projectFile);
//-------------------------------------------------------------------------------------

?>

<style>
#progress{
    background-color: black;
    color: white;
}

</style>


<div class="page-header row">
    <h1>Search Page Maker for AppGini</h1>
    <h1><a href="./index.php">Projects</a> > <a href="./project.php?axp=<?php echo $_GET['axp'] ?>"><?php echo substr( $projectFile , 0 , strrpos( $projectFile , ".")); ?></a> > Generating search pages
    </h1>

</div>

<div class="col-md-12" id="progress" class="container" >

<?php    
for ($i = 0; $i < count($xmlFile->table); $i++) {
    
    //if no spm node found, skip table
    if (! isset($xmlFile->table[$i]->spm) ){
        continue;
    }

    echo "<br>Generating search page code for '".(string)$xmlFile->table[$i]->caption."' table<br>";

    //mapping fields indexes to match filter Values
    $filterIdxArray = mapIndex( $xmlFile->table[$i]->field );
    
    
    $fileContent = '';
    $filterCounter = 0;
    $includeDatetimePicker = $includeOrderBy = $includeGroups = false;

    $fieldIdxArray = explode(":", $xmlFile->table[$i]->spm );
    array_pop($fieldIdxArray); //remove last element (empty)

    for ($j = 0; $j < count($fieldIdxArray); $j++) {

        $fieldNum = (int)$fieldIdxArray[$j];

        //sections 
        if ($fieldNum > 9000){
            if ( $fieldNum == 9001 ){
                $includeOrderBy = true;
            }else{
                 $includeGroups = true;
            }
            continue;
        }

        $filterCounter++;   //number of filter fields

       
        $field = $xmlFile->table[$i]->field[$fieldNum]; 
        getFieldType($fileContent, $field, $filterIdxArray[$fieldNum] , $filterCounter , $xmlFile->table[$i]->name);
        $fileContent.='
            <!-- ########################################################## -->
            ';
        echo "<br>'".(string)$field->caption."' field : OK";
    
    }

    //includes
    includeDefaultParts($fileContent , $includeDatetimePicker , $includeOrderBy , $includeGroups );
    
    //add submit button
    $fileContent.='
    <div style="margin-top:10px;" ><button class="btn btn-success btn-lg" >Apply</button></div>';

    $fileName = $xmlFile->table[$i]->name."_filter.php";
    file_put_contents( $fileName , $fileContent);

echo "<br><br>";
}


?>
</div>



<?php

function getFieldType(&$fileContent, $field, $fieldNum, &$filterCounter , $tableName) {
    $currentType = $field->dataType;

    if (!empty($field->parentTable)) {                      //lookup

        getLookupFilter($fileContent, $field, $fieldNum, $filterCounter , $tableName);

    } else if (!empty((string) $field->CSValueList)) {      //options list

        getOptionsFilter($fileContent, $field, $fieldNum, $filterCounter);

    } else if ($field->checkBox == "True") {                //checkbox

        getCheckboxFilter($fileContent, $field, $fieldNum, $filterCounter);

    } elseif ($currentType < 9) {                           //number

        getNumberFilter($fileContent, $field, $fieldNum, $filterCounter);
        $filterCounter++;

    } else if ($currentType == 9){                          //date
       
        $GLOBALS['includeDatetimePicker'] = true;
        getDatePreFilter($fileContent, $field, $fieldNum, $filterCounter);
        getDateFilter($fileContent, $field, $fieldNum, $filterCounter);
        $filterCounter++;

    } else if ($currentType < 12) {                         //dateTime

        $GLOBALS['includeDatetimePicker'] = true;
        getDatePreFilter($fileContent, $field, $fieldNum, $filterCounter);
        getDateTimeFilter($fileContent, $field, $fieldNum, $filterCounter);
        $filterCounter++;  

    } else if ($currentType == 12) {                        //time
        $GLOBALS['includeDatetimePicker'] = true;
        getDatePreFilter($fileContent, $field, $fieldNum, $filterCounter);
        getTimeFilter($fileContent, $field, $fieldNum, $filterCounter);
        $filterCounter++;  

    } else if ($currentType == 13) {                        //year
        $GLOBALS['includeDatetimePicker'] = true;
        getDatePreFilter($fileContent, $field, $fieldNum, $filterCounter);
        getYearFilter($fileContent, $field, $fieldNum, $filterCounter);
        $filterCounter++;  

    } else {                                                //text
        getTextFilter($fileContent, $field, $fieldNum, $filterCounter);
    }

}

function getOptionsFilter(&$fileContent, $field, $fieldNum, $filterCounter) {


    $options = explode('||', entitiesToUTF8(convertLegacyOptions((string) $field->CSValueList)));

    //check data length
    if (count($options) > 6) {     //DROPDOWN
    
        //convert options to select2 format
        $optionsList = array();
        for ($i = 0; $i < count($options); $i++) {
            $optionsList[] = (object) array(
                        "id" => $i,
                        "text" => $options[$i]
            );
        }
        $optionsList = json_encode($optionsList);

        $fileContent.= '
        <?php
        	 $options = ' . json_encode($options) . ';
        	 $optionsList = \'' . "$optionsList" . '\';

        
        //convert value to select2 format
        if ($FilterValue[' . $filterCounter . ']) {
            $filtervalueObj = new stdClass();
            $text = htmlspecialchars($FilterValue[' . $filterCounter . ']);
            $filtervalueObj->text = $text;
            $filtervalueObj->id = array_search($text, $options);

            $filtervalueObj = json_encode($filtervalueObj);
        }

        ?>';
        ob_start();
        ?>
        <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
            <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
            <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>

            <div id="<?php echo $fieldNum; ?>_DropDown"><span></span></div>

            <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
            <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">
            <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="equal-to">
            <input type="hidden" name="FilterValue[<?php echo $filterCounter; ?>]" id="<?php echo $fieldNum; ?>_currValue" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
            
        </div>

        <script>
            var populate_<?php echo $fieldNum; ?> = <?php echo addslashes("<?php echo \$filtervalueObj ;?>"); ?>
            
            $j(function () {
                $j("#<?php echo $fieldNum; ?>_DropDown").select2({
                    data: <?php echo addslashes("<?php echo \$optionsList; ?>"); ?>}).on('change', function (e) {
                    $j("#<?php echo $fieldNum; ?>_currValue").val(e.added.text);

                });


                /* preserve the applied filter and show it when re-opening the filters page */
                if ($j("#<?php echo $fieldNum; ?>_currValue").val().length) {
                    $j("#<?php echo $fieldNum; ?>_DropDown").select2('data', populate_<?php echo $fieldNum; ?> );
                }
            });

        </script>
        <?php
        $retVal = ob_get_contents();
        ob_end_clean();
        $fileContent.=$retVal;
    } else {                  //Radio buttons
        ob_start();
        ?>

        <div class="row" style="border-bottom: dotted 2px #DDD;">
            <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
            <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
            <div class="col-md-8 col-md-offset-3">

                    <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
                    <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">
                    <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="equal-to">
                    <input type="hidden" name="FilterValue[<?php echo $filterCounter; ?>]" id="<?php echo $fieldNum; ?>_currValue" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">

                <?php foreach ($options as $option) { ?>
                        <div class="radio">
                            <label>
                                 <input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" value="<?php echo $option; ?>"><?php echo $option; ?>
                            </label>
                        </div>
                 <?php } ?>
            </div>
        </div>
        <script>
            //for population
            var filterValue_<?php echo $fieldNum; ?> = '<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>';
            $j(function () {
                if (filterValue_<?php echo $fieldNum; ?>) {
                    $j("input[class =filter_<?php echo $fieldNum; ?>][value ='" + filterValue_<?php echo $fieldNum; ?> + "']").attr("checked", "checked");
                }
            })

        </script>
        <?php
        $retVal = ob_get_contents();
        ob_end_clean();
        $fileContent.=$retVal;
    }
}

function getCheckboxFilter(&$fileContent, $field, $fieldNum, $filterCounter) {

    ob_start();
    ?>

    <div class="row" style="border-bottom: dotted 2px #DDD;">
         
                <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
                <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
                <div class="col-md-8 col-md-offset-3">
                <div class="radio">
                    <label><input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="1" > Checked</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="null"> Unchecked</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="" checked> Any</label>
               </div>
            </div>

            <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
            <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">   
            <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" id="filter_<?php echo $fieldNum; ?>" value="equal-to">

    </div>

    <script>
        var filterValue = '<?php echo htmlspecialchars($FilterValue[4]); ?>';

        //for population
        var filterValue_<?php echo $fieldNum; ?> = '<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>';
        $j(function () {
            if (filterValue_<?php echo $fieldNum; ?>) {
                $j("input[class =filter_<?php echo $fieldNum; ?>][value =" + filterValue_<?php echo $fieldNum; ?> + "]").attr("checked", "checked").click();
            }
        })

        //define the function if not already included
        if (typeof (checkboxFilter) !== 'function') {

            function checkboxFilter(elm) {
                if (elm.value == "null") {
                    $j("#" + elm.className).val("is-empty");
                } else {
                    $j("#" + elm.className).val("equal-to");
                }
            }
        }
    </script>
    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getNumberFilter( &$fileContent, $field, $fieldNum, &$filterCounter){


    ob_start();
    ?>

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">   
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
        </div>

        <?php $filterCounter++; ?>
        <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
        </div>
    </div>

    
    <script>
        //stop event if it is already bound
        $j(".numeric").off("keydown").on("keydown", function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($j.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                 // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });                
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getLookupFilter(&$fileContent, $field, $fieldNum, $filterCounter , $tableName) {
        
    ob_start();
    ?>
    

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_<?php echo $fieldNum; ?>"></span></div>

        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" id="lookupoperator_<?php echo $fieldNum; ?>" name="FilterOperator[<?php echo $filterCounter; ?>]" value="equal-to">
        <input type="hidden" id="filterfield_<?php echo $fieldNum; ?>" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_<?php echo $fieldNum; ?>").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"<?php echo $tableName; ?>", f:"<?php echo $field->name; ?>" }; },
                results: function (resp, page) { return resp; }

            }
        }).on('change', function(e){
            $j("#filterfield_<?php echo $fieldNum; ?>").val(e.added.text);
            $j("#lookupoperator_<?php echo $fieldNum; ?>").val('equal-to');
            if (e.added.id=='{empty_value}'){
                $j("#lookupoperator_<?php echo $fieldNum; ?>").val('is-empty');
            }
        });


        /* preserve the applied category filter and show it when re-opening the filters page */
        if ($j("#filterfield_<?php echo $fieldNum; ?>").val().length){
            
            //None case 
            if ($j("#filterfield_<?php echo $fieldNum; ?>").val() == '<None>'){
                $j("#filter_<?php echo $fieldNum; ?>").select2( 'data' , {
                            id: '{empty-value}',
                            text: '<None>'
                });
                $j("#lookupoperator_<?php echo $fieldNum; ?>").val('is-empty');
                return;
            }
            $j.ajax({
                url: 'ajax_combo.php',
                dataType: 'json',
                data: { s: $j("#filterfield_<?php echo $fieldNum; ?>").val(),  //search term
                        p: 1,                                         //page number
                        t:"<?php echo $tableName; ?>",                //table name
                        f:"<?php echo $field->name; ?>"               //field name
                }}).done(function(response){
                    if (response.results.length){
                         $j("#filter_<?php echo $fieldNum; ?>").select2( 'data' , {
                            id: response.results[1].id,
                            text: response.results[1].text
                        })
                    }

                });
        }

        });
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getTextFilter(&$fileContent, $field, $fieldNum, $filterCounter) {


    ob_start();
    ?>
    
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
        </div>
    </div>


    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getDatePreFilter (&$fileContent, $field, $fieldNum, $filterCounter){
    ob_start();
    ?>
    
     
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong><?php echo (string) $field->caption; ?></strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">   
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_<?php echo $fieldNum; ?>"  name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="10">
        </div>

        <?php $filterCounter++; ?>
        <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_<?php echo $fieldNum; ?>" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="10">
        </div>
    </div>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getDateFilter(&$fileContent, $field, $fieldNum, $filterCounter) {


    ob_start();
    ?>
    
    <script>
        //date
        $j("#from-date_<?php echo $fieldNum; ?> , #to-date_<?php echo $fieldNum; ?> ").datetimepicker({
            
            format: 'MM/DD/YYYY'   //config
            
        });

        $j("#from-date_<?php echo $fieldNum; ?>" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_<?php echo $fieldNum; ?> ").val(date.format('MM/DD/YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getDateTimeFilter(&$fileContent, $field, $fieldNum, $filterCounter) {

    ob_start();?>


    <script>
        //date
        $j("#from-date_<?php echo $fieldNum; ?> , #to-date_<?php echo $fieldNum; ?> ").datetimepicker({
            
            format: 'YYYY-MM-DD HH:mm:ss'   //config
            
        });

        $j("#from-date_<?php echo $fieldNum; ?>" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_<?php echo $fieldNum; ?> ").val(date.format('YYYY-MM-DD HH:mm:ss')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}



function getTimeFilter(&$fileContent, $field, $fieldNum, $filterCounter) {

    ob_start();?>

    <script>
        $j("#from-date_<?php echo $fieldNum; ?> , #to-date_<?php echo $fieldNum; ?> ").datetimepicker({
            format: 'HH:mm:ss'   //config
        });

        $j("#from-date_<?php echo $fieldNum; ?>" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'hour');  
            $j("#to-date_<?php echo $fieldNum; ?> ").val(date.format('HH:mm:ss')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}


function getYearFilter(&$fileContent, $field, $fieldNum, $filterCounter) {

    ob_start();?>

    <script>
        $j("#from-date_<?php echo $fieldNum; ?> , #to-date_<?php echo $fieldNum; ?> ").datetimepicker({
            format: 'YYYY' ,  //config
            viewMode: 'years'
        });

        $j("#from-date_<?php echo $fieldNum; ?>" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'year');  
            $j("#to-date_<?php echo $fieldNum; ?> ").val(date.format('YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    <?php
    $retVal = ob_get_contents();
    ob_end_clean();
    $fileContent.=$retVal;
}



function includeDefaultParts( &$fileContent , $includeDatetimePicker , $includeOrderBy , $includeGroups ){
    
    if ($includeOrderBy){
    
        $fileContent.='    

        <!-- sorting header  -->   
        <div class="row" style="border-bottom: solid 2px #DDD;">
            <div class="col-md-offset-2 col-md-8 vspacer-lg"><strong>order by</strong></div>
        </div>
        <!-- sorting rules -->
        <?php
        // Fields list
        $sortFields = new Combo;
        $sortFields->ListItem = $this->ColCaption;
        $sortFields->ListData = $this->ColNumber;

        // sort direction
        $sortDirs = new Combo;
        $sortDirs->ListItem = array("ascending" , "descending" );
        $sortDirs->ListData = array("asc", "desc");
        $num_rules = min(maxSortBy, count($this->ColCaption));

        for($i = 0; $i < $num_rules; $i++){
            $sfi = $sd = "";
            if(isset($orderBy[$i])) foreach($orderBy[$i] as $sfi => $sd);

            $sortFields->SelectName = "OrderByField$i";
            $sortFields->SelectID = "OrderByField$i";
            $sortFields->SelectedData = $sfi;
            $sortFields->SelectedText = "";
            $sortFields->Render();

            $sortDirs->SelectName = "OrderDir$i";
            $sortDirs->SelectID = "OrderDir$i";
            $sortDirs->SelectedData = $sd;
            $sortDirs->SelectedText = "";
            $sortDirs->Render();

            $border_style = ($i == $num_rules - 1 ? "solid 2px #DDD" : "dotted 1px #DDD");
            ?>
            <!-- sorting rule -->
            <div class="row" style="border-bottom: <?php echo $border_style; ?>;">
                <div class="col-xs-2 vspacer-md hidden-md hidden-lg"><strong><?php echo ($i ? "then by" : "order by"); ?></strong></div>
                <div class="col-md-2 col-md-offset-2 vspacer-md hidden-xs hidden-sm text-right"><strong><?php echo ($i ? "then by" : "order by"); ?></strong></div>
                <div class="col-xs-6 col-md-4 vspacer-md"><?php echo $sortFields->HTML; ?></div>
                <div class="col-xs-4 col-md-2 vspacer-md"><?php echo $sortDirs->HTML; ?></div>
            </div>
            <?php
        }
        ?>';
        echo "<br>'Order by' section included: OK";
    }


    //-----------------------------------------------------------------------------------

    if ($includeGroups){
    
        $fileContent.='    
            <?php
                // ownership options
                $mi = getMemberInfo();
                $adminConfig = config("adminConfig");
                $isAnonymous = ($mi["group"] == $adminConfig["anonymousGroup"]);

                if(!$isAnonymous){
                    ?>
                    <!-- ownership header  --> 
                    <div class="row filterByOwnership" style="border-bottom: solid 2px #DDD;">
                        <div class="col-md-offset-2 col-md-8 vspacer-lg"><strong>Records to display</strong></div>
                    </div>

                    <!-- ownership options -->
                    <div class="row" style="border-bottom: dotted 2px #DDD;">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="radio filterByOwnership">
                                <label>
                                    <input type="radio" name="DisplayRecords" id="DisplayRecordsUser" value="user"/>
                                    Only your own records
                                </label>
                            </div>
                            <div class="radio filterByOwnership">
                                <label>
                                    <input type="radio" name="DisplayRecords" id="DisplayRecordsGroup" value="group"/>
                                    All records owned by your group
                                </label>
                            </div>
                            <div class="radio filterByOwnership">
                                <label>
                                    <input type="radio" name="DisplayRecords" id="DisplayRecordsAll" value="all"/>
                                    All records
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>


            <script>
                var FiltersPerGroup = <?php echo $FiltersPerGroup; ?>;

                function filterGroupDisplay(groupIndex, hide, animate){
                    for(i = ((groupIndex - 1) * FiltersPerGroup + 1); i <= (groupIndex * FiltersPerGroup); i++){
                        if(animate){
                            if(hide) jQuery("div.FilterSet" + i).fadeOut();
                            if(!hide) jQuery("div.FilterSet" + i).fadeIn(function(){
                                jQuery("#FilterField_" + ((groupIndex - 1) * FiltersPerGroup + 1) + "_").focus();
                            });
                        }else{
                            if(hide) jQuery("div.FilterSet" + i).hide();
                            if(!hide) jQuery("div.FilterSet" + i).show(function(){
                                jQuery("#FilterField_" + ((groupIndex - 1) * FiltersPerGroup + 1) + "_").focus();
                            });
                        }
                    }
                }

                jQuery(function(){
                    for(i = (FiltersPerGroup + 1); i <= (3 * FiltersPerGroup); i++){
                        jQuery("div.FilterSet" + i).hide();
                    }
                    jQuery("#FilterAnd_" + (FiltersPerGroup + 1) + "_").change(function(){
                        filterGroupDisplay(2, (jQuery(this).val() ? false : true), true);
                    });
                    jQuery("#FilterAnd_" + (2 * FiltersPerGroup + 1) + "_").change(function(){
                        filterGroupDisplay(3, (jQuery(this).val() ? false : true), true);
                    });

                    if(jQuery("#FilterAnd_" + (    FiltersPerGroup + 1) + "_").val()){ filterGroupDisplay(2); }
                    if(jQuery("#FilterAnd_" + (2 * FiltersPerGroup + 1) + "_").val()){ filterGroupDisplay(3); }

                    var DisplayRecords = "<?php echo $_REQUEST["DisplayRecords"]; ?>";

                    switch(DisplayRecords){
                        case "user":
                            jQuery("#DisplayRecordsUser").prop("checked", true);
                            break;
                        case "group":
                            jQuery("#DisplayRecordsGroup").prop("checked", true);
                            break;
                        default:
                            jQuery("#DisplayRecordsAll").prop("checked", true);
                    }
                });
            </script>
            ';
            echo "<br>'User/group/all' section included: OK";
    }
    //-----------------------------------------------------------------------------------
    if ($includeDatetimePicker){
        $fileContent = '
        <!-- load bootstrap datetime-picker-->
        <link rel="stylesheet" href="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="resources/moment/moment.min.js"></script>
        <script type="text/javascript" src="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        '.$fileContent ;
    }

    //add clear filters function
    ob_start() 
    ?>
    <script>
        function clearFilters(elm){
            var parentDiv = $j(elm).parent(".row ");
            //get all input nodes
            inputValueChildren = parentDiv.find("input[type!=radio][name^=FilterValue]");
            inputRadioClildren = parentDiv.find("input[type=radio][name^=FilterValue]");
            
            //default input nodes ( text, hidden )
            inputValueChildren.each(function( index ) {
                $j( this ).val('');
            });
            
            //radio buttons
            inputRadioClildren.each(function( index ) {
                $j( this ).removeAttr('checked');

                //checkbox case
                if ($j( this ).val()=='') $j(this).attr("checked", "checked").click();
            });
            
            //lookup and select dropdown
            parentDiv.find("div[id$=DropDown],div[id^=filter_]").select2("val", "");

            //for lookup
            parentDiv.find("input[id^=lookupoperator_]").val('equal-to');

        }
    </script>

    <?php
    $fileContent.= ob_get_contents();
    ob_end_clean();
    
}

function mapIndex ( $fields ){

    $idx = 1;
    $mapper = array();
    for ( $i = 0 ; $i < count ($fields); $i++ ){


        $field = $fields[$i];
        if ( ( $field->notFiltered == "True") || ($field->tableImage=="True") || ($field->detailImage=="True") ){
            //those indexes will not be considered
            continue;
        }
        $mapper[$i] = $idx;
        $idx++;
    }
    return $mapper;

}





?>
