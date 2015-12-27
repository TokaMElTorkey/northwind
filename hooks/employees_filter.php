
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
            
        <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
        <div class="col-md-offset-3 col-md-2 col-sm-3 col-xs-12 vspacer-lg"><strong>Last Name</strong></div>
          <button type="button" class="btn btn-default pull-col-lg-3 vspacer-lg" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-trash text-danger"></button>
        <input type="hidden" name="FilterAnd[1]" value="and">
        <input type="hidden" name="FilterField[1]" value="3">  
        <input type="hidden" name="FilterOperator[1]" value="like">
        <div class="col-md-3 col-sm-6 col-xs-10 vspacer-lg">
            <input type="text" class="form-control" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
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
        if ($FilterValue[2]) {
            $filtervalueObj = new stdClass();
            $text = htmlspecialchars($FilterValue[2]);
            $filtervalueObj->text = $text;
            $filtervalueObj->id = array_search($text, $options);

            $filtervalueObj = json_encode($filtervalueObj);
        }

        ?>        <div class="row vspacer-lg" style="border-bottom: dotted 2px #DDD;" >
            <div class="col-md-offset-3 col-md-2 col-sm-3 col-xs-12 vspacer-lg"><strong>Country</strong></div>
              <button type="button" class="btn btn-default pull-col-lg-3 vspacer-lg" title='Clear fields'  onclick="clearFilters(this);" ><span class="glyphicon glyphicon-trash text-danger"></button>

            <div id="12_DropDown" class="drop-down col-md-3 col-sm-6 col-xs-10 vspacer-lg"><span></span></div>
            <input type="hidden" class="populatedOptionsData" name="2" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" >
            <input type="hidden" name="FilterAnd[2]" value="and">
            <input type="hidden" name="FilterField[2]" value="12">
            <input type="hidden" name="FilterOperator[2]" value="equal-to">
            <input type="hidden" name="FilterValue[2]" id="12_currValue" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
            
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


    