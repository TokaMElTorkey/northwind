    
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Category Name</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[1]" value="and">
        <input type="hidden" name="FilterField[1]" value="2">  
        <input type="hidden" name="FilterOperator[1]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
        </div>
    </div>


    
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