
        <!-- load bootstrap datetime-picker-->
        <link rel="stylesheet" href="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="resources/moment/moment.min.js"></script>
        <script type="text/javascript" src="resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
            
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Last Name</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[1]" value="and">
        <input type="hidden" name="FilterField[1]" value="3">  
        <input type="hidden" name="FilterOperator[1]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
        </div>
    </div>


    
            <!-- ########################################################## -->
                
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>First Name</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[2]" value="and">
        <input type="hidden" name="FilterField[2]" value="4">  
        <input type="hidden" name="FilterOperator[2]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
        </div>
    </div>


    
            <!-- ########################################################## -->
                
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Home Phone</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[3]" value="and">
        <input type="hidden" name="FilterField[3]" value="13">  
        <input type="hidden" name="FilterOperator[3]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[3]" value="<?php echo htmlspecialchars($FilterValue[3]); ?>" size="3">
        </div>
    </div>


    
            <!-- ########################################################## -->
                
     
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Birth Date</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[4]" value="and">
        <input type="hidden" name="FilterField[4]" value="6">   
        <input type="hidden" name="FilterOperator[4]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_6"  name="FilterValue[4]" value="<?php echo htmlspecialchars($FilterValue[4]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[5]" value="and">
        <input type="hidden" name="FilterField[5]" value="6">  
        <input type="hidden" name="FilterOperator[5]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_6" name="FilterValue[5]" value="<?php echo htmlspecialchars($FilterValue[5]); ?>" size="10">
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

        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Hire Date</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 vspacer-lg">Between </div>
        <input type="hidden" name="FilterAnd[6]" value="and">
        <input type="hidden" name="FilterField[6]" value="7">   
        <input type="hidden" name="FilterOperator[6]" value="greater-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text"  class="form-control" id="from-date_7"  name="FilterValue[6]" value="<?php echo htmlspecialchars($FilterValue[6]); ?>" size="10">
        </div>

                <div class="col-md-1 text-center vspacer-lg"> and </div>
        <input type="hidden" name="FilterAnd[7]" value="and">
        <input type="hidden" name="FilterField[7]" value="7">  
        <input type="hidden" name="FilterOperator[7]" value="less-than-or-equal-to">
        <div class="col-md-2 vspacer-md">
            <input type="text" class="form-control" id="to-date_7" name="FilterValue[7]" value="<?php echo htmlspecialchars($FilterValue[7]); ?>" size="10">
        </div>
    </div>

        
    <script>
        //date
        $j("#from-date_7 , #to-date_7 ").datetimepicker({
            
            format: 'MM/DD/YYYY'   //config
            
        });

        $j("#from-date_7" ).on('dp.change' , function(e){
        
            date = moment(e.date).add(1, 'month');  
            $j("#to-date_7 ").val(date.format('MM/DD/YYYY')).data("DateTimePicker").minDate(e.date);

        });
        
    </script>

    
            <!-- ########################################################## -->
                
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>City</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[8]" value="and">
        <input type="hidden" name="FilterField[8]" value="9">  
        <input type="hidden" name="FilterOperator[8]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[8]" value="<?php echo htmlspecialchars($FilterValue[8]); ?>" size="3">
        </div>
    </div>


    
            <!-- ########################################################## -->
                
     <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Postal Code</strong></div>
        <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>
        <div class="col-md-1 text-center vspacer-lg"> Contains </div>
        <input type="hidden" name="FilterAnd[9]" value="and">
        <input type="hidden" name="FilterField[9]" value="11">  
        <input type="hidden" name="FilterOperator[9]" value="like">
        <div class="col-md-5 vspacer-md">
            <input type="text" class="form-control" name="FilterValue[9]" value="<?php echo htmlspecialchars($FilterValue[9]); ?>" size="3">
        </div>
    </div>


    
            <!-- ########################################################## -->
            
        <?php
        	 $options = ["Afghanistan","Albania","Algeria","American Samoa","Andorra","Angola","Anguilla","Antarctica","Antigua, Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia, Herzegovina","Botswana","Bouvet Is.","Brazil","Brunei Darussalam","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Canary Is.","Cape Verde","Cayman Is.","Central African Rep.","Chad","Channel Islands","Chile","China","Christmas Is.","Cocos Is.","Colombia","Comoros","Congo, D.R. Of","Congo","Cook Is.","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Is.","Faroe Is.","Fiji","Finland","France","French Guiana","French Polynesia","French Territories","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guadeloupe","Guam","Guatemala","Guernsey","Guinea-bissau","Guinea","Guyana","Haiti","Heard, Mcdonald Is.","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Ivory Coast","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Korea, D.P.R Of","Korea, Rep. Of","Kuwait","Kyrgyzstan","Lao Peoples D.R.","Latvia","Lebanon","Lesotho","Liberia","Libyan Arab Jamahiriya","Liechtenstein","Lithuania","Luxembourg","Macao","Macedonia, F.Y.R Of","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Mariana Islands","Marshall Islands","Martinique","Mauritania","Mauritius","Mayotte","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepal","Netherlands Antilles","Netherlands","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","Niue","Norfolk Island","Norway","Oman","Pakistan","Palau","Palestinian Terr.","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Pitcairn","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russian Federation","Rwanda","Samoa","San Marino","Sao Tome, Principe","Saudi Arabia","Senegal","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Is.","Somalia","South Africa","South Georgia","South Sandwich Is.","Spain","Sri Lanka","St. Helena","St. Kitts, Nevis","St. Lucia","St. Pierre, Miquelon","St. Vincent, Grenadines","Sudan","Suriname","Svalbard, Jan Mayen","Swaziland","Sweden","Switzerland","Syrian Arab Republic","Taiwan","Tajikistan","Tanzania","Thailand","Timor-leste","Togo","Tokelau","Tonga","Trinidad, Tobago","Tunisia","Turkey","Turkmenistan","Turks, Caicoss","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Viet Nam","Virgin Is. British","Virgin Is. U.S.","Wallis, Futuna","Western Sahara","Yemen","Yugoslavia","Zambia","Zimbabwe"];
        
            //convert options to select2 format
            $optionsList = array();
            for ($i = 0; $i < count($options); $i++) {
                $optionsList[] = (object) array(
                            "id" => $i,
                            "text" => $options[$i]
                );
            }
            $optionsList = json_encode($optionsList);

        
        //convert value to select2 format
        if ($FilterValue[10]) {
            $filtervalueObj = new stdClass();
            $text = htmlspecialchars($FilterValue[10]);
            $filtervalueObj->text = $text;
            $filtervalueObj->id = array_search($text, $options);

            $filtervalueObj = json_encode($filtervalueObj);
        }

        ?>        <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
            <div class="col-md-offset-2 col-md-2 vspacer-lg"><strong>Country</strong></div>
            <button type="button" class="btn btn-default pull-right" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-off"></button>

            <div id="12_DropDown"><span></span></div>

            <input type="hidden" name="FilterAnd[10]" value="and">
            <input type="hidden" name="FilterField[10]" value="12">
            <input type="hidden" name="FilterOperator[10]" value="equal-to">
            <input type="hidden" name="FilterValue[10]" id="12_currValue" value="<?php echo htmlspecialchars($FilterValue[10]); ?>" size="3">
            
        </div>

        <script>
            var populate_12 = <?php echo $filtervalueObj ;?>            
            $j(function () {
                $j("#12_DropDown").select2({
                    data: <?php echo $optionsList; ?>}).on('change', function (e) {
                    $j("#12_currValue").val(e.added.text);

                });


                /* preserve the applied filter and show it when re-opening the filters page */
                if ($j("#12_currValue").val().length) {
                    $j("#12_DropDown").select2('data', populate_12 );
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