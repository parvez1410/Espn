<?php include 'include/header.php';?>
<?php $table_heading = "Item Package";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php include 'functions/common_function.php';?>
<?php
   
?>
        <form class="cmxform form-horizontal " id="signupForm" method="post" action="" >
            

            <div class="form-group ">
                    <label for="PACKAGE_NAME" class="control-label col-lg-2"> Pakage Name</label>
                    <div class="col-lg-4">
                        <input type="text" class=" form-control" id="PACKAGE_NAME" name="PACKAGE_NAME"   style="" >
                        <P class="error_message" id="PACKAGE_ERROR"></P>
                    </div>
                   <label for="PACKAGE_RATE" class="control-label col-lg-2">Package Item Rate</label>
                    <div class="col-lg-4">
                        <input type="text" class=" form-control" id="PACKAGE_RATE" name="PACKAGE_RATE"   style="" >
                        <P class="error_message" id="RATE_ERROR"></P>
                    </div>

                   
                </div>

                <div class="form-group ">
                    <label for="PACKAGE_CODE" class="control-label col-lg-2"> Pakage Code</label>
                    <div class="col-lg-4">
                        <input type="text" class=" form-control" id="PACKAGE_CODE" name="PACKAGE_CODE"   style="" >
                        <P class="error_message" id="PACKAGE_CODE_ERROR"></P>
                    </div>
                  
                   
                </div>


                <div class="form-group ">
                    <label for="PACKAGE_BENEFIT" class="control-label col-lg-2">Package Benefit</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" id="PACKAGE_BENEFIT" style="height: 150px;" name="PACKAGE_BENEFIT"></textarea>
                    </div>
                </div>
                
             <fieldset class="scheduler-border">
                <legend class="scheduler-border">Package Details</legend>
              
                <div class="form-group ">
                     <label for="location" class="control-label col-lg-2"> Select Item</label>
                    <div class="col-lg-4">

                        <select class="form-control" name="ITEM_NO" id="ITEM_NO">
                            <option value="0">--Select Item--</option>
                            <?php
                                    $sql = "SELECT * FROM `gen_items` where IS_DELETED=0 ";
                                    $result1 = mysqli_query($con,$sql);
                                    while($row = mysqli_fetch_array($result1)):
                                ?>
                                    <option value="<?=$row['ITEM_NO']?>" ><?=$row['ITEM_NAME']?></option>
                                <?php endwhile;?>
                            </select>
                        
                    </div>
                   
                    <label for="ITEM_UNIT" class="control-label col-lg-2">Unit</label>
                    <div class="col-lg-4">
                        <input class=" form-control" id="ITEM_UNIT" name="ITEM_UNIT" type="text"  style="" >
                        
                    </div>
                </div>
                <div class="form-group ">
                    
                    <label for="ITEM_RATE" class="control-label col-lg-2">Rate </label>
                    <div class="col-lg-4">
                        <input class=" form-control" id="ITEM_RATE" name="ITEM_RATE" type="text"  style="" >
                    </div>
                    <label for="location" class="control-label col-lg-2"></label>
                    <div class=" col-lg-4">
                        <input type="button" class="btn btn-primary" id="addItem" name="add" value="Add" />
                        
                    </div>
                </div>
                
                 
          </fieldset> 
        </form>
    <form>
    <div style="overflow: auto;">
    <table class="table table-bordered table-hover dataTable" max-width="90%">
        <thead>
            <tr>
                <th>Item</th>
                <th>Unit</th>
                <th>Rate</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="item_details">
        </tbody>
        </table>
    </div>
    </form>
       <input type="button" class="btn btn-primary " id="loadAll" value="Create Package">
    <!---main content end---->
<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function(){
        //load store
        
        $("#loadAll").on("click",function() {

            $("#PACKAGE_ERROR").html("");
            $("#PACKAGE_NAME").attr("class","form-control");
           
            var PACKAGE_NAME = $("#PACKAGE_NAME").val().trim();
            if(PACKAGE_NAME == "") {
                $("#PACKAGE_ERROR").text("Package Name is required");
                $("#PACKAGE_NAME").attr("class","form-control error_input");
                $("#PACKAGE_NAME").focus();
                return false;
            }

            $("#RATE_ERROR").html("");
            $("#PACKAGE_RATE").attr("class","form-control");
           
            var  PACKAGE_RATE= $("#PACKAGE_RATE").val().trim();
            if(PACKAGE_RATE == "") {
                $("#RATE_ERROR").text("Package Rate is required");
                $("#PACKAGE_RATE").attr("class","form-control error_input");
                $("#PACKAGE_RATE").focus();
                return false;
            }
            $("#PACKAGE_CODE_ERROR").html("");
            $("#PACKAGE_CODE").attr("class","form-control");
           
            var  PACKAGE_CODE= $("#PACKAGE_CODE").val().trim();
            if(PACKAGE_CODE == "") {
                $("#PACKAGE_CODE_ERROR").text("Package Code is required");
                $("#PACKAGE_CODE").attr("class","form-control error_input");
                $("#PACKAGE_CODE").focus();
                return false;
            }


       
        });


        //Load Unit.....
        $("#ITEM_NO").on("change",function(){
            var html = "";
            if($(this).val() != 0){
                $.post("ajax/get_item_details.php",{ITEM_NO: $(this).val()},
                function(data,status){ 
                    $("#ITEM_UNIT").val(data.ITEM_UNIT);
                  $("#ITEM_RATE").val(data.ITEM_RATE);
                  },"Json");


            }else{
                $("#ITEM_UNIT").val("");
                 $("#ITEM_RATE").val("");
            }
        });

        function duplicate_item_no_check(ITEM_NO,ITEM_RATE,ITEM_CODE,ITEM_UNIT){
            var is_duplicate = 0;
            $(".edit_list").each(function(){
                var CHK_ITEM_NO = $(this).attr("ITEM_NO");
                var CHK_ITEM_RATE = $(this).attr("ITEM_RATE");
                var CHK_ITEM_CODE = $(this).attr("ITEM_CODE");
                 var CHK_ITEM_UNIT = $(this).attr("ITEM_UNIT");
                var is_edit = $(this).attr("is_edit");
                if(isNaN(is_edit)){
                    is_edit = 0;
                }
                if(CHK_ITEM_NO == ITEM_NO &&  CHK_ITEM_RATE == ITEM_RATE && CHK_ITEM_UNIT == ITEM_UNIT && is_edit == 0)
                    is_duplicate = 1;
            });
            return is_duplicate;
        }

        function remove_set_edit(){
            $(".set_edit").each(function(){
                $(this).removeAttr("class");
            });
        }


        //add list item
        $("#addItem").on("click",function(){
            var ITEM_NAME = $("#ITEM_NO option:selected").text();
            var ITEM_NO = $("#ITEM_NO").val();
            var ITEM_UNIT = $("#ITEM_UNIT").val();
            var ITEM_RATE = $("#ITEM_RATE").val();
            var is_duplicate = duplicate_item_no_check(ITEM_NO,ITEM_RATE,ITEM_UNIT);
            if(is_duplicate == 0){
                var html = "";
                var innerHtml = "";
                html+="<tr>";
                innerHtml+="<td>"+ITEM_NAME+"</td>";
                innerHtml+="<td>"+ITEM_UNIT+"</td>";
                innerHtml+="<td>"+ITEM_RATE+"</td>";
                innerHtml+="<td><a class='btn btn-danger remove_list'>Remove</a><a class='btn btn-success edit_list' ITEM_NAME = '"+ITEM_NAME+"' ITEM_NO = '"+ITEM_NO+"' ITEM_UNIT = '"+ITEM_UNIT+"' ITEM_RATE = '"+ITEM_RATE+"'>Edit</a></td>";
                html+=innerHtml;
                html+="</tr>";
                if($(this).val() == "Add"){
                    $("#item_details").append(html);
                }else{
                    $(this).val("Add");
                    $("#item_details tr.set_edit").html(innerHtml);
                }
            }else{
                alert("Duplicate Record Found");
            }
        });

        //remove from list
        $(document).on("click",".remove_list",function(){
            var con = confirm("Are you Sure to Remove?");
            if(con){
                $(this).parents('tr').remove();
            }
        });


        //edit list item
        $(document).on("click",".edit_list",function(){
            remove_set_edit();
            $(this).parents('tr').attr("class","set_edit");
            $(this).attr("is_edit",1);
            var ITEM_NO = $(this).attr("ITEM_NO");
            var ITEM_UNIT = $(this).attr("ITEM_UNIT");
            var ITEM_RATE = $(this).attr("ITEM_RATE");
            $("#ITEM_NO").val(ITEM_NO);
            $("#ITEM_UNIT").val(ITEM_UNIT);
            $("#ITEM_RATE").val(ITEM_RATE);
            $("#addItem").val("Update");
        });

        //save all data
        $("#loadAll").on("click",function(){
            var empty_child = 1;
            var item_no_list = [];
            var item_unit_list = [];
            var item_rate_list = []; 
            $(".edit_list").each(function(){
                empty_child = 0;
                item_no_list.push($(this).attr("item_no"));
                item_unit_list.push($(this).attr("ITEM_UNIT"));
                item_rate_list.push($(this).attr("ITEM_RATE"));
            });
            if(empty_child == 1){
                alert("Items Required!");
                return false;
            }
            var PACKAGE_NAME = $("#PACKAGE_NAME").val();
            var PACKAGE_RATE=$("#PACKAGE_RATE").val();
             var PACKAGE_CODE=$("#PACKAGE_CODE").val();
              var PACKAGE_BENEFIT=$("#PACKAGE_BENEFIT").val();
          $.post("ajax/save_package_item.php",{
                PACKAGE_NAME: PACKAGE_NAME, PACKAGE_CODE: PACKAGE_CODE, PACKAGE_RATE : PACKAGE_RATE,PACKAGE_BENEFIT : PACKAGE_BENEFIT, item_no_list : item_no_list.toString(), item_unit_list : item_unit_list.toString(), item_rate_list : item_rate_list.toString(), },
                function(data,status){
                    if(data == true){
                        alert("Data Saved Successfully");
                        $("#PACKAGE_NAME").val("");
                         $("#PACKAGE_RATE").val("");
                          $("#PACKAGE_CODE").val("");
                         $("#PACKAGE_BENEFIT").val("");
                         $("#ITEM_NO").val("0");
                         $("#ITEM_UNIT").val("");
                         $("#ITEM_RATE").val("");
                        $("#item_details").html("");

                    }
                });
        });

    });


</script>
