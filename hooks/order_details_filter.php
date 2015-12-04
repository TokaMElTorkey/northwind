    

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Order ID</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_2"></span></div>

        <input type="hidden" name="FilterAnd[1]" value="and">
        <input type="hidden" name="FilterField[1]" value="2">  
        <input type="hidden" id="lookupoperator_2" name="FilterOperator[1]" value="equal-to">
        <input type="hidden" id="filterfield_2" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_2").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"order_details", f:"OrderID" }; },
                results: function (resp, page) { return resp; }

            }
        }).on('change', function(e){
            $j("#filterfield_2").val(e.added.text);
            $j("#lookupoperator_2").val('equal-to');
            if (e.added.id=='{empty_value}'){
                $j("#lookupoperator_2").val('is-empty');
            }
        });


        /* preserve the applied category filter and show it when re-opening the filters page */
        if ($j("#filterfield_2").val().length){
            
            //None case 
            if ($j("#filterfield_2").val() == '<None>'){
                $j("#filter_2").select2( 'data' , {
                            id: '{empty-value}',
                            text: '<None>'
                });
                $j("#lookupoperator_2").val('is-empty');
                return;
            }
            $j.ajax({
                url: 'ajax_combo.php',
                dataType: 'json',
                data: { s: $j("#filterfield_2").val(),  //search term
                        p: 1,                                         //page number
                        t:"order_details",                //table name
                        f:"OrderID"               //field name
                }}).done(function(response){
                    if (response.results.length){
                         $j("#filter_2").select2( 'data' , {
                            id: response.results[1].id,
                            text: response.results[1].text
                        })
                    }

                });
        }

        });
    </script>

    
            <!-- ########################################################## -->
                

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Product</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_3"></span></div>

        <input type="hidden" name="FilterAnd[2]" value="and">
        <input type="hidden" name="FilterField[2]" value="3">  
        <input type="hidden" id="lookupoperator_3" name="FilterOperator[2]" value="equal-to">
        <input type="hidden" id="filterfield_3" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_3").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"order_details", f:"ProductID" }; },
                results: function (resp, page) { return resp; }

            }
        }).on('change', function(e){
            $j("#filterfield_3").val(e.added.text);
            $j("#lookupoperator_3").val('equal-to');
            if (e.added.id=='{empty_value}'){
                $j("#lookupoperator_3").val('is-empty');
            }
        });


        /* preserve the applied category filter and show it when re-opening the filters page */
        if ($j("#filterfield_3").val().length){
            
            //None case 
            if ($j("#filterfield_3").val() == '<None>'){
                $j("#filter_3").select2( 'data' , {
                            id: '{empty-value}',
                            text: '<None>'
                });
                $j("#lookupoperator_3").val('is-empty');
                return;
            }
            $j.ajax({
                url: 'ajax_combo.php',
                dataType: 'json',
                data: { s: $j("#filterfield_3").val(),  //search term
                        p: 1,                                         //page number
                        t:"order_details",                //table name
                        f:"ProductID"               //field name
                }}).done(function(response){
                    if (response.results.length){
                         $j("#filter_3").select2( 'data' , {
                            id: response.results[1].id,
                            text: response.results[1].text
                        })
                    }

                });
        }

        });
    </script>

    
            <!-- ########################################################## -->
            
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Discount</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[3]" value="and">
        <input type="hidden" name="FilterField[3]" value="7">   
        <input type="hidden" name="FilterOperator[3]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[3]" value="<?php echo htmlspecialchars($FilterValue[3]); ?>" size="3">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[4]" value="and">
        <input type="hidden" name="FilterField[4]" value="7">  
        <input type="hidden" name="FilterOperator[4]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[4]" value="<?php echo htmlspecialchars($FilterValue[4]); ?>" size="3">
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

    
            <!-- ########################################################## -->
                

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
        ?>       

        <!-- function to handle the action of the clear field button -->
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

    
    <center><div style="margin-top:10px;" ><button class="btn btn-success btn-lg" >Apply</button></div></center>