    
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Company Name</strong></div>
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