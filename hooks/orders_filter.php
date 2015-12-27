
        <style>
        .drop-down{
            width: 21.2% !important;
            padding: 0px;
            padding-left:1.2%;
            margin-right:4%;
            max-width:2000px !important;
        }
        @media (max-width: 991px) {
          .drop-down{
            width: 43% !important;
            margin-right:7%;
        }
        }
        @media (max-width: 767px) {
          .drop-down{
            width: 73% !important;
            padding-left:2%;
            margin-right:10%;

        }
        }
        </style>
        
        <!-- load bootstrap datetime-picker-->
        <link rel="stylesheet" href="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="resources/moment/moment.min.js"></script>
        <script type="text/javascript" src="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
            

     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-3 col-md-2 col-sm-3 col-xs-12 vspacer-lg"><strong>Customer</strong></div>
          <button type="button" class="btn btn-default pull-col-lg-3 vspacer-lg" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-trash text-danger"></button>
        <div id="filter_2" class="drop-down col-md-3 col-sm-6 col-xs-10 vspacer-lg"><span></span></div>

        <input type="hidden" class="populatedLookupData" name="1" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" >
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

        <div class="col-md-offset-3 col-md-2 col-sm-3 col-xs-12 vspacer-lg"><strong>Order Date</strong></div>
          <button type="button" class="btn btn-default pull-col-lg-3 vspacer-lg" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-trash text-danger"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[2]" value="and">
        <input type="hidden" name="FilterField[2]" value="4">   
        <input type="hidden" name="FilterOperator[2]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_4"  name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[3]" value="and">
        <input type="hidden" name="FilterField[3]" value="4">  
        <input type="hidden" name="FilterOperator[3]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_4" name="FilterValue[3]" value="<?php echo htmlspecialchars($FilterValue[3]); ?>" size="10">
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

        <!-- filter actions -->
        <div class="row">
            <div class="col-md-2 col-md-offset-2 vspacer-lg">
                <input type="hidden" name="apply_sorting" value="1">
                <button type="submit" id="applyFilters" onclick="beforeApplyFilters(event);return true;" class="btn btn-success btn-block btn-lg"><i class="glyphicon glyphicon-ok"></i> Apply filters</button>
            </div>
                            <div class="col-md-3 vspacer-lg">
                    <button type="submit" onclick="beforeApplyFilters(event);return true;" class="btn btn-default btn-block btn-lg" id="SaveFilter" name="SaveFilter_x" value="1"><i class="glyphicon glyphicon-align-left"></i> Save filters</button>
                </div>
                        <div class="col-md-2 vspacer-lg">
                <button onclick="beforeCancelFilters();" type="submit" id="cancelFilters" class="btn btn-warning btn-block btn-lg"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
            </div>
        </div>

        <!--funtion to remove unsupplied fields -->
        <script>
            function beforeApplyFilters(event){
            
                //get all field submitted values
                $j(":input[type=text][name^=FilterValue],:input[type=hidden][name^=FilterValue],:input[type=radio][name^=FilterValue]:checked").each(function( index ) {
                      
                    //if type=hidden  and options radio fields with the same name are checked, supply its value
                    if ( $j( this ).attr('type')=='hidden' &&  $j(":input[type=radio][name='"+$j( this ).attr('name')+"']:checked").length >0 ){
                        return;
                    }
                      
                      //do not submit fields with empty values
                    if ( !$j( this ).val()){
                      var fieldNum =  $j(this).attr('name').match(/(\d+)/)[0];
                      $j(":input[name='FilterField["+fieldNum+"]']").val('');
                     
                      };
                });

            };
            function beforeCancelFilters(){
                

                //other fields
                $j('form')[0].reset();

                //lookup case ( populate with initial data)
                $j(":input[class='populatedLookupData']").each(function(){
                  

                    $j(":input[name='FilterValue["+$j(this).attr('name')+"]']").val($j(this).val());
                    if ($j(this).val()== '<None>'){
                        $j(this).parent(".row ").find('input[id^="lookupoperator"]').val('is-empty');
                    }else{
                        $j(this).parent(".row ").find('input[id^="lookupoperator"]').val('equal-to');
                    }
                        
                })

                //options case ( populate with initial data)
                $j(":input[class='populatedOptionsData']").each(function(){
                   
                    $j(":input[name='FilterValue["+$j(this).attr('name')+"]']").val($j(this).val());
                })


                //checkbox, radio options case
                $j(":input[class='checkboxData'],:input[class='optionsData'] ").each(function(){
                    var filterNum = $j(this).val();
                    var populatedValue = eval("filterValue_"+filterNum);                  
                    var parentDiv = $j(this).parent(".row ");

                    //check old value
                    parentDiv.find("input[type=radio][value='"+populatedValue+"']").attr('checked', 'checked').click();
                
                })

                //remove unsuplied fields
                beforeApplyFilters();

                return true;
            }
        </script>


    