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

    
    $fileContent = '';
    $filterCounter = 0;
    $fieldIdxArray = explode(":", $xmlFile->table[$i]->spm );
    array_pop($fieldIdxArray); //remove last element (empty)

    for ($j = 0; $j < count($fieldIdxArray); $j++) {

        $fieldNum = (int)$fieldIdxArray[$j];

        //sections 
        if ($fieldNum > 9000){
            // handle sections case
            continue;
        }

        $filterCounter++;   //number of filter fields

        if ($filterCounter>12){
            break; /********/
        }

       
        $field = $xmlFile->table[$i]->field[$fieldNum]; 
        $fieldNum++;
        getFieldType($fileContent, $field, $fieldNum , $filterCounter , $xmlFile->table[$i]->name);
        $fileContent.='
            <!-- ########################################################## -->
            ';
        echo "<br>'".(string)$field->caption."' field : OK";
    
    }
    //save fields in file
    $fileContent.='
    <div style="margin-top:10px;" ><button class="btn btn-success btn-lg" >Apply</button></div>';
    $fileName = (string)$xmlFile->table[$i]->caption."_filter.php";
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

    } else if ($currentType == 9 || $currentType == 13) {   //date


    } else if ($currentType < 12) {                         //dateTime

    } else if ($currentType == 12) {                        //time

    } else {                                                //text
        
    }
    return $retVal;

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
        <div style="margin-top:20px;">
            <label><?php echo (string) $field->caption; ?></label>
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

        <div style="margin-top:20px;">
            <label><?php echo (string) $field->caption; ?></label>

            <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
            <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">
            <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="equal-to">
            <input type="hidden" name="FilterValue[<?php echo $filterCounter; ?>]" id="<?php echo $fieldNum; ?>_currValue" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3"><br>

        <?php foreach ($options as $option) { ?>
                <input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" value="<?php echo $option; ?>"><?php echo $option; ?>

            <?php } ?>
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


    <div style="margin-top:20px;">
        <label><?php echo (string) $field->caption; ?></label>


        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">   
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" id="filter_<?php echo $fieldNum; ?>" value="equal-to">

        <input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="1" > Checked   
        <input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="null"> Unchecked   
        <input type="radio" name="FilterValue[<?php echo $filterCounter; ?>]" class="filter_<?php echo $fieldNum; ?>" onclick="checkboxFilter(this)" value="" checked> Any

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

    <div style="margin-top:20px;">
        <label><?php echo (string) $field->caption; ?> between </label>
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">   
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="greater-than-or-equal-to">
        <input type="text" class="numeric" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">

        <?php $filterCounter++; ?>
        and 
        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="less-than-or-equal-to">
        <input type="text" class="numeric" name="FilterValue[<?php echo $filterCounter; ?>]" value="<?php echo addslashes('<?php echo htmlspecialchars($FilterValue[' . $filterCounter . ']); ?>'); ?>" size="3">
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
    

    <div style="margin-top:20px;">
        <label><?php echo (string) $field->caption; ?></label>
        <div id="filter_<?php echo $fieldNum; ?>"></span></div>

        <input type="hidden" name="FilterAnd[<?php echo $filterCounter; ?>]" value="and">
        <input type="hidden" name="FilterField[<?php echo $filterCounter; ?>]" value="<?php echo $fieldNum; ?>">  
        <input type="hidden" name="FilterOperator[<?php echo $filterCounter; ?>]" value="equal-to">
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
        });


        /* preserve the applied category filter and show it when re-opening the filters page */
        if ($j("#filterfield_<?php echo $fieldNum; ?>").val().length){
            $j.ajax({
                url: 'ajax_combo.php',
                dataType: 'json',
                data: { s: $j("#filterfield_<?php echo $fieldNum; ?>").val(),  //search term
                        p: 1,                        //page number
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

?>
