
        <!-- load bootstrap datetime-picker-->
        <link rel="stylesheet" href="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="resources/moment/moment.min.js"></script>
        <script type="text/javascript" src="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
        
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Order ID</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[1]" value="and">
        <input type="hidden" name="FilterField[1]" value="1">   
        <input type="hidden" name="FilterOperator[1]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[2]" value="and">
        <input type="hidden" name="FilterField[2]" value="1">  
        <input type="hidden" name="FilterOperator[2]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
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
                

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Customer</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_2"></span></div>

        <input type="hidden" name="FilterAnd[4]" value="and">
        <input type="hidden" name="FilterField[4]" value="2">  
        <input type="hidden" id="lookupoperator_2" name="FilterOperator[4]" value="equal-to">
        <input type="hidden" id="filterfield_2" name="FilterValue[4]" value="<?php echo htmlspecialchars($FilterValue[4]); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_2").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"orders", f:"CustomerID" }; },
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
                        t:"orders",                //table name
                        f:"CustomerID"               //field name
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

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Employee</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_3"></span></div>

        <input type="hidden" name="FilterAnd[5]" value="and">
        <input type="hidden" name="FilterField[5]" value="3">  
        <input type="hidden" id="lookupoperator_3" name="FilterOperator[5]" value="equal-to">
        <input type="hidden" id="filterfield_3" name="FilterValue[5]" value="<?php echo htmlspecialchars($FilterValue[5]); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_3").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"orders", f:"EmployeeID" }; },
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
                        t:"orders",                //table name
                        f:"EmployeeID"               //field name
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

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Order Date</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[6]" value="and">
        <input type="hidden" name="FilterField[6]" value="4">   
        <input type="hidden" name="FilterOperator[6]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_4"  name="FilterValue[6]" value="<?php echo htmlspecialchars($FilterValue[6]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[7]" value="and">
        <input type="hidden" name="FilterField[7]" value="4">  
        <input type="hidden" name="FilterOperator[7]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_4" name="FilterValue[7]" value="<?php echo htmlspecialchars($FilterValue[7]); ?>" size="10">
        </div>
    </div>

        
    <script>
        //date
        $j("#from-date_4 , #to-date_4 ").datetimepicker({
            
            format: 'MM/DD/YYYY'   //config
            
        });

        $j("#from-date_4" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_4 ").val(date.format('MM/DD/YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    
            <!-- ########################################################## -->
                
     
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Required Date</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[8]" value="and">
        <input type="hidden" name="FilterField[8]" value="5">   
        <input type="hidden" name="FilterOperator[8]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_5"  name="FilterValue[8]" value="<?php echo htmlspecialchars($FilterValue[8]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[9]" value="and">
        <input type="hidden" name="FilterField[9]" value="5">  
        <input type="hidden" name="FilterOperator[9]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_5" name="FilterValue[9]" value="<?php echo htmlspecialchars($FilterValue[9]); ?>" size="10">
        </div>
    </div>

        
    <script>
        //date
        $j("#from-date_5 , #to-date_5 ").datetimepicker({
            
            format: 'MM/DD/YYYY'   //config
            
        });

        $j("#from-date_5" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_5 ").val(date.format('MM/DD/YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    
            <!-- ########################################################## -->
                
     
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Shipped Date</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[10]" value="and">
        <input type="hidden" name="FilterField[10]" value="6">   
        <input type="hidden" name="FilterOperator[10]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_6"  name="FilterValue[10]" value="<?php echo htmlspecialchars($FilterValue[10]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[11]" value="and">
        <input type="hidden" name="FilterField[11]" value="6">  
        <input type="hidden" name="FilterOperator[11]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_6" name="FilterValue[11]" value="<?php echo htmlspecialchars($FilterValue[11]); ?>" size="10">
        </div>
    </div>

        
    <script>
        //date
        $j("#from-date_6 , #to-date_6 ").datetimepicker({
            
            format: 'MM/DD/YYYY'   //config
            
        });

        $j("#from-date_6" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_6 ").val(date.format('MM/DD/YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    
            <!-- ########################################################## -->
                

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Ship Via</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div id="filter_7"></span></div>

        <input type="hidden" name="FilterAnd[12]" value="and">
        <input type="hidden" name="FilterField[12]" value="7">  
        <input type="hidden" id="lookupoperator_7" name="FilterOperator[12]" value="equal-to">
        <input type="hidden" id="filterfield_7" name="FilterValue[12]" value="<?php echo htmlspecialchars($FilterValue[12]); ?>" size="3">
    </div>

    <script>

    $j(function(){
        /* display a drop-down of categories that populates its content from ajax_combo.php */
        $j("#filter_7").select2({
            ajax: {
                url: "ajax_combo.php",
                dataType: 'json',
                cache: true,
                data: function(term, page){ return { s: term, p:page, t:"orders", f:"ShipVia" }; },
                results: function (resp, page) { return resp; }

            }
        }).on('change', function(e){
            $j("#filterfield_7").val(e.added.text);
            $j("#lookupoperator_7").val('equal-to');
            if (e.added.id=='{empty_value}'){
                $j("#lookupoperator_7").val('is-empty');
            }
        });


        /* preserve the applied category filter and show it when re-opening the filters page */
        if ($j("#filterfield_7").val().length){
            
            //None case 
            if ($j("#filterfield_7").val() == '<None>'){
                $j("#filter_7").select2( 'data' , {
                            id: '{empty-value}',
                            text: '<None>'
                });
                $j("#lookupoperator_7").val('is-empty');
                return;
            }
            $j.ajax({
                url: 'ajax_combo.php',
                dataType: 'json',
                data: { s: $j("#filterfield_7").val(),  //search term
                        p: 1,                                         //page number
                        t:"orders",                //table name
                        f:"ShipVia"               //field name
                }}).done(function(response){
                    if (response.results.length){
                         $j("#filter_7").select2( 'data' , {
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
        
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Freight</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[13]" value="and">
        <input type="hidden" name="FilterField[13]" value="8">   
        <input type="hidden" name="FilterOperator[13]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[13]" value="<?php echo htmlspecialchars($FilterValue[13]); ?>" size="3">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[14]" value="and">
        <input type="hidden" name="FilterField[14]" value="8">  
        <input type="hidden" name="FilterOperator[14]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="numeric form-control" name="FilterValue[14]" value="<?php echo htmlspecialchars($FilterValue[14]); ?>" size="3">
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