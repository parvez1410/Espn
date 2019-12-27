<?php include 'include/header.php';?>
<?php $table_heading = " Item Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 <?php
        $tbl_name="gen_items";        //your table name
        $targetpage = "items_setup.php";  //your file name  (the name of this file)
        $user_no =$_SESSION['user']['user_no'];
        $CURR_TIME = date('Y-m-d H:i:s'); 
        $mgs = '';
    if(isset($_GET['delete']))
    {
        $ID = $_GET['delete'];
        $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1 ,`DELETED_BY` = '$user_no', `DELETED_ON` = '$CURR_TIME' WHERE ITEM_NO = $ID";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Data Delete Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
        }
        else
        {
            $mgs = "Data Delete Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    }
    if(isset($_POST['submit']))
    {
           $ITEM_NAME = trim($_POST['ITEM_NAME']);
            $ITEM_CODE = trim($_POST['ITEM_CODE']);
           $CATEGORY_NO = trim($_POST['CATEGORY_NO']);
           $SUBCATEGORY_NO = trim($_POST['SUBCATEGORY_NO']);
           
           $ITEM_UNIT = trim($_POST['ITEM_UNIT']);
           $ITEM_RATE = trim($_POST['ITEM_RATE']);
           

           $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND (`ITEM_CODE`='$ITEM_CODE') OR  (`ITEM_NAME` = '$ITEM_NAME' AND `CATEGORY_NO` = '$CATEGORY_NO'  AND `ITEM_UNIT`= '$ITEM_UNIT' AND `ITEM_RATE`= '$ITEM_RATE' )";
            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1):
               if ($_FILES["ITEM_IMAGE"]["error"] > 0) {
                    $ITEM_IMAGE = "No.png";
                    
                } else {
                    $ITEM_IMAGE = time().$_FILES["ITEM_IMAGE"]["name"];
                    move_uploaded_file($_FILES["ITEM_IMAGE"]["tmp_name"],"upload/" . $ITEM_IMAGE);
                }
               $sql = "INSERT INTO $tbl_name SET `ITEM_NAME` = '$ITEM_NAME',`ITEM_CODE`='$ITEM_CODE',`CATEGORY_NO` = '$CATEGORY_NO',`SUBCATEGORY_NO` = '$SUBCATEGORY_NO',`ITEM_UNIT` = '$ITEM_UNIT',`ITEM_RATE`= '$ITEM_RATE',`ITEM_IMAGE` = '$ITEM_IMAGE', `CREATED_BY`='$user_no', `CREATED_ON`='$CURR_TIME'";

               

                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $mgs = "Data Insert Successfully!";
                    $class = "green_color alert alert-success col-md-6 alert-dismissable";
                }
                else
                {
                    $mgs = "Data Insert Fail!";
                    $class = "red_color alert alert-warning alert-dismissable col-md-6";
                }
            else:
                $mgs = "Duplicate Entry!";
                $class = "red_color alert alert-warning alert-dismissable col-md-6 alert alert-warning alert-dismissable col-md-6";
            endif;
    }
    if(isset($_POST['update']))
    {
           $ITEM_NO = trim($_POST['ITEM_NO']);
           $ITEM_NAME = trim($_POST['ITEM_NAME']);
           $ITEM_CODE = trim($_POST['ITEM_CODE']);
           
           $CATEGORY_NO = trim($_POST['CATEGORY_NO']);
           $SUBCATEGORY_NO = trim($_POST['SUBCATEGORY_NO']);
          
           $ITEM_UNIT = trim($_POST['ITEM_UNIT']);
           $ITEM_RATE = trim($_POST['ITEM_RATE']);
           

            $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND ((`ITEM_CODE`='$ITEM_CODE') OR  (`ITEM_NAME` = '$ITEM_NAME' AND `CATEGORY_NO` = '$CATEGORY_NO'  AND `ITEM_UNIT`= '$ITEM_UNIT' AND `ITEM_RATE`= '$ITEM_RATE' )) AND `ITEM_NO` != '$ITEM_NO' ";
            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1): 
                if ($_FILES["ITEM_IMAGE"]["error"] > 0) {
                    $ITEM_IMAGE =$_POST['ITEM_IMAGE'];
                    
                } else {
                    $ITEM_IMAGE = time().$_FILES["ITEM_IMAGE"]["name"];
                    move_uploaded_file($_FILES["ITEM_IMAGE"]["tmp_name"],"upload/" . $ITEM_IMAGE);
                }
              $sql = "UPDATE $tbl_name SET `ITEM_NAME` = '$ITEM_NAME',`ITEM_CODE`='$ITEM_CODE',`CATEGORY_NO` = '$CATEGORY_NO',`SUBCATEGORY_NO` = '$SUBCATEGORY_NO',`ITEM_UNIT` = '$ITEM_UNIT',`ITEM_RATE`= '$ITEM_RATE', `ITEM_IMAGE` = '$ITEM_IMAGE',`IS_UPDATED`= 1, `UPDATED_BY`= '$user_no' WHERE ITEM_NO = $ITEM_NO";
                $result = mysqli_query($con,$sql);
                if($result)
                {
                    $mgs = "Data Update Successfully!";
                    $class = "green_color alert alert-success col-md-6 alert-dismissable";
                }
                else
                {
                    $mgs = "Data Update Fail!";
                    $class = "red_color alert alert-warning alert-dismissable col-md-6";
                }
            else:
                $mgs = "Duplicate Entry!";
                $class = "red_color alert alert-warning alert-dismissable col-md-6";
            endif;
    }
?> 
    <?php
        if(isset($_GET['edit'])):
        $id = $_GET['edit'];
        $sql = "SELECT * FROM $tbl_name WHERE `ITEM_NO` = '$id' ";
        $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
     <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
     <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-5 col-md-offset-3 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="ITEM_NO" value="<?=$result['ITEM_NO']?>" />
            </div>
        </div>
        
      
         <div class="form-group ">
            <label for="ITEM_NAME" class="control-label col-lg-3">Item Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" value="<?=$result['ITEM_NAME']?>" name="ITEM_NAME" type="text" 
                  required />
            </div>
        </div>
        <div class="form-group ">
            <label for="ITEM_CODE" class="control-label col-lg-3">Item Code </label>
            <div class="col-lg-5">
                <input class=" form-control" id="ITEM_CODE" name="ITEM_CODE" type="text" value="<?=$result['ITEM_CODE']?>" required />
                   
            </div>
        </div>
       
        <div class="form-group ">
            <label for="CATEGORY_NO" class="control-label col-lg-3">Category Name  </label>
            <div class="col-lg-5">
                <select class="form-control" name="CATEGORY_NO" id="CATEGORY_NO">
                        <?php
                            $sql = "SELECT * FROM `gen_categorys` WHERE IS_DELETED=0 ";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['CATEGORY_NO']?>" <?php if($result['CATEGORY_NO'] == $row['CATEGORY_NO'])  echo 'selected'; ?>><?=$row['CATEGORY_NAME']?></option>
                        <?php endwhile;?>
                    </select>
            </div>
        </div>

         <div class="form-group" id="" >
            <label for="class_no" class="control-label col-lg-3">Sub Category</label>
            <div class="col-lg-5" >
                <select class="form-control" id="SUBCATEGORY_NO" name="SUBCATEGORY_NO">
                     <?php
                       $sql="SELECT * FROM `gen_subcategorys` WHERE `IS_DELETED`=0  AND  `CATEGORY_NO` = ".$result['CATEGORY_NO'] ;
                        $query = mysqli_query($con,$sql);
                        while($row = mysqli_fetch_array($query)):
                    ?>
                    <option value="<?=$row['SUBCATEGORY_NO']?>"<?php if($result['SUBCATEGORY_NO'] == $row['SUBCATEGORY_NO'])  echo 'selected'; ?>><?=$row['SUBCATEGORY_NAME']?></option>
                    <?php endwhile;?>
                </select>     
            </div>
             
        </div>

         <div class="form-group ">
            <label for="ITEM_UNIT" class="control-label col-lg-3">Item Unit</label>
            <div class="col-lg-5">
                <input class=" form-control" id="" value="<?=$result['ITEM_UNIT']?>" name="ITEM_UNIT" type="text" 
                  required />
            </div>
        </div>
        <div class="form-group ">
            <label for="ITEM_RATE" class="control-label col-lg-3">Item Rate </label>
            <div class="col-lg-5">
                <input class=" form-control"  id="" value="<?=$result['ITEM_RATE']?>" name="ITEM_RATE" type="text" 
                  required />
            </div>
        </div>
        
        <div class="form-group ">
            <label for="ITEM_IMAGE" class="control-label col-lg-3">Item Image </label>
            <div class="col-lg-5">
                <input type="file"  name="ITEM_IMAGE" id="" value="<?=$result['ITEM_IMAGE']?>">
                <img src="upload/<?=$result['ITEM_IMAGE']?>" height="80" width="60"/> 
            </div>
           <div>
                <input type="hidden" name="ITEM_IMAGE" value="<?=$result['ITEM_IMAGE']?>" />
            </div>
        
            
        </div>
        
        
     <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" name="update" value="Update"/> 
            </div>
    </div>

    </form>
    
    <?php
        else:
    ?>

   <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data">
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-5 col-md-offset-3 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            
        </div>
       
      
        <div class="form-group ">
            <label for="ITEM_NAME" class="control-label col-lg-3">Item Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="ITEM_NAME" name="ITEM_NAME" type="text" 
                  required />
                   <P class="error_message" id="ITEM_ERROR"></P>
            </div>
        </div>
        <div class="form-group ">
            <label for="ITEM_CODE" class="control-label col-lg-3">Item Code </label>
            <div class="col-lg-5">
                <input class=" form-control" id="ITEM_CODE" name="ITEM_CODE" type="text" 
                  required />
                   <P class="error_message" id="CODE_ERROR"></P>
            </div>
        </div>
       
        <div class="form-group ">
            <label for="CATEGORY_NO" class="control-label col-lg-3">Select Category</label>
            <div class="col-lg-5">
                <select class="form-control" name="CATEGORY_NO" id="CATEGORY_NO" required="">
                    <option value="-1">--Select category--</option>
                        <?php
                            $sql = "SELECT * FROM `gen_categorys` where IS_DELETED=0 ";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['CATEGORY_NO']?>" ><?=$row['CATEGORY_NAME']?></option>
                        <?php endwhile;?>
                    </select>
                    <P class="error_message" id="CATEGORY_ERROR"></P>
            </div>
            
        </div>

        <div class="form-group" id="show_sub_category" >
            <label for="class_no" class="control-label col-lg-3">Sub Category</label>
            <div class="col-lg-5" >
                <select class="form-control" id="SUBCATEGORY_NO" name="SUBCATEGORY_NO" required="">
                    <option value="-1">--Select One--</option>
                </select> 
                 <P class="error_message" id="SUBCATEGORY_ERROR"></P>    
            </div>
             
        </div>
         <div class="form-group ">
            <label for="ITEM_UNIT" class="control-label col-lg-3">Item Unit </label>
            <div class="col-lg-5">
                <input class=" form-control" id="ITEM_UNIT" name="ITEM_UNIT" type="text" 
                  required />
                   <P class="error_message" id="UNIT_ERROR"></P>
            </div>
        </div>
        <div class="form-group ">
            <label for="ITEM_RATE" class="control-label col-lg-3">Item Rate </label>
            <div class="col-lg-5">
                <input class=" form-control" id="ITEM_RATE" name="ITEM_RATE" type="text" 
                  required />
                   <P class="error_message" id="RATE_ERROR"></P>
            </div>
        </div>
        <div class="form-group ">
            <label for="ITEM_IMAGE" class="control-label col-lg-3">Item Image </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="ITEM_IMAGE" type="file" />
            </div>
            
        </div>
       <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" id="btnAdd" name="submit"  />
                
            </div>
        </div>
    </form>
    
    
    <?php
        endif;
    ?>

    <form method="post" class="cmxform form-horizontal ">
        <fieldset class="scheduler-border">
                <legend class="scheduler-border">Search</legend>
              
                <div class="form-group ">
                     <label for="location" class="control-label col-lg-2">Item Name</label>
                    <div class="col-lg-4">

                        <input class=" form-control" id="" name="ITEM_NAME" type="text"  style="" >
                        
                    </div>
                   
                    <label for="item" class="control-label col-lg-2">Item Code</label>
                    <div class="col-lg-4">
                        <input class=" form-control" id="" name="ITEM_CODE" type="text"  style="" >
                        
                    </div>
                </div>
                <div class="form-group ">
                    
                    <label for="location" class="control-label col-lg-2">Category </label>
                    <div class="col-lg-4">
                       <select class="form-control search" name="CATEGORY_NO" id="CATEGORY" style="width: 100%">
                            <option value="-1">-- Select Category --</option>
                         <?php
                            $sql = "SELECT * FROM `gen_categorys` where IS_DELETED=0 ";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['CATEGORY_NO']?>" ><?=$row['CATEGORY_NAME']?></option>
                        <?php endwhile;?>
                        </select>
                    </div>
                    <label for="location" class="control-label col-lg-2">Sub Category</label>
                    <div class=" col-lg-4">
                        <select class="form-control" id="SUBCATEGORY" name="SUBCATEGORY_NO" >
                            <option value="-1">--Select One--</option>
                        </select> 
                    </div>
                </div>
                <div class="form-group ">
                    
                    <label for="location" class="control-label col-lg-2"></label>
                    <div class=" col-lg-4">
                        <input type="submit" class="btn btn-primary" id="searchBtn" name="searchBtn" value="Search" />
                        
                    </div>
                </div>
                 
          </fieldset> 
        </form>

    <?php

        $where = "";
        if(isset($_POST['searchBtn']))
        {
            
            $ITEM_NAME =mysqli_real_escape_string($con,trim($_POST['ITEM_NAME']));
              if($ITEM_NAME != ""){
                $where.=" AND `gen_items`.`ITEM_NAME` LIKE '%$ITEM_NAME%'";
              }
              $ITEM_CODE =$_POST['ITEM_CODE'];
              if($ITEM_CODE != ""){
                $where.=" AND `gen_items`.`ITEM_CODE` LIKE '%$ITEM_CODE%'";
              }
             
              $CATEGORY_NO =$_POST['CATEGORY_NO'];
              if($CATEGORY_NO != -1){
                $where.=" AND `gen_items`.`CATEGORY_NO` = '$CATEGORY_NO'";
              }
              $SUBCATEGORY_NO =$_POST['SUBCATEGORY_NO'];
              if($SUBCATEGORY_NO != -1){
                $where.=" AND `gen_items`.`SUBCATEGORY_NO` = '$SUBCATEGORY_NO'";
              }

        }
    // How many adjacent pages should be shown on each side?
        $adjacents = 3;
    
    /* 
       First get total number of rows in data table. 
       If you have a WHERE clause in your query, make sure you mirror it here.
    */
    $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE `IS_DELETED` = 0 $where";
    $total_pages = mysqli_fetch_array(mysqli_query($con,$query));
    $total_pages = $total_pages['num'];
    
    /* Setup vars for query. */
    $limit = 15; 
    if(isset($_GET['page']))
    {                               //how many items to show per page
        $page = $_GET['page'];
    }
    else
    $page = 1;
    
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 0
    
    /* Get data. */
    $sql = "SELECT * FROM $tbl_name LEFT JOIN `gen_categorys` ON `gen_categorys`.`CATEGORY_NO`=$tbl_name.`CATEGORY_NO` LEFT JOIN `gen_subcategorys` ON `gen_subcategorys`.`SUBCATEGORY_NO`=$tbl_name.`SUBCATEGORY_NO`  WHERE $tbl_name.`IS_DELETED` = 0 $where LIMIT $start, $limit";
    $result = mysqli_query($con,$sql);
    
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
    
    /* 
        Now we apply our rules and draw the pagination object. 
        We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1) 
            $pagination.= "<a href=\"$targetpage?page=$prev\"><< previous</a>";
        else
            $pagination.= "<span class=\"disabled\"><< previous</span>";    
        
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<span class=\"current\">$counter</span>";
                else
                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
                $pagination.= "...";
                $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                $pagination.= "...";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";                 
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<a href=\"$targetpage?page=$next\">next >></a>";
        else
            $pagination.= "<span class=\"disabled\">next >></span>";
        $pagination.= "</div>\n";       
    }
?>
<div style="overflow: auto">
    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>

            <th><center>Sl</center></th>
            <th><center>Item Name</center></th>
            <th><center>Item Code</center></th>
            <th><center>Category Name</center></th>
            <th><center>Sub Category Name</center></th>
            <th><center>Item Unit</center></th>
            <th><center>Item Rate</center></th>
            <th><center>Item Image</center></th>
            <th><center>Action</center></th>
            
         </tr>
         <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
        <tr>
            <td><center><?=$i++?></center></td>
            <td><?=$row['ITEM_NAME']?></td>
             <td><?=$row['ITEM_CODE']?></td>
            <td><?=$row['CATEGORY_NAME']?></td>
            <td><?=$row['SUBCATEGORY_NAME']?></td>
            <td><?=$row['ITEM_UNIT']?></td>
            <td><?=$row['ITEM_RATE']?> BDT</td>
            <td><a class="" target="_blank" href="upload/<?=$row['ITEM_IMAGE']?>" title="Click to view full image"><img src="upload/<?=$row['ITEM_IMAGE']?>" height="70px" width="60px"></a></td>
           <td>
               <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['ITEM_NO']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['ITEM_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center>
            </td>
        </tr>
    <?php endwhile;?>
    </table>
</div>
<?=$pagination?>
    
    <!---main content end---->
<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#CATEGORY_NO").on("change",function(){
            var CATEGORY_NO = $(this).val();
            if(CATEGORY_NO!= -1){
                $.post("ajax/get_sub_category.php",{CATEGORY_NO:CATEGORY_NO},function(data){
                   // console.log(data.trim().length);
                    $("#SUBCATEGORY_NO").html(data);
                       
                    
                });


            }else{
                $("#SUBCATEGORY_NO").html("<option value='-1'>--Select One--</option>");
                
            }
        });


        $("#CATEGORY").on("change",function(){
            var CATEGORY = $(this).val();
            if(CATEGORY!= -1){
                $.post("ajax/sub_category.php",{CATEGORY:CATEGORY},function(data){
                   // console.log(data.trim().length);
                    $("#SUBCATEGORY").html(data);
                       
                    
                });


            }else{
                $("#SUBCATEGORY").html("<option value='-1'>--Select One--</option>");
                
            }
        });
        $("#btnAdd").on("click",function() {

            $("#ITEM_ERROR").html("");
            $("#ITEM_NAME").attr("class","form-control");
           
            var ITEM_NAME = $("#ITEM_NAME").val().trim();
            if(ITEM_NAME == "") {
                $("#ITEM_ERROR").text("Item Name is required");
                $("#ITEM_NAME").attr("class","form-control error_input");
                $("#ITEM_NAME").focus();
                return false;
            }

            $("#CODE_ERROR").html("");
            $("#ITEM_CODE").attr("class","form-control");
           
            var ITEM_CODE = $("#ITEM_CODE").val().trim();
            if(ITEM_CODE == "") {
                $("#CODE_ERROR").text("Item Code is required");
                $("#ITEM_CODE").attr("class","form-control error_input");
                $("#ITEM_CODE").focus();
                return false;
            }

            $("#CATEGORY_ERROR").html("");
            $("#CATEGORY_NO").attr("class","form-control");
           
            var CATEGORY_NO = $("#CATEGORY_NO").val().trim();
            if(CATEGORY_NO == '-1') {
                $("#CATEGORY_ERROR").text("Category is required");
                $("#CATEGORY_NO").attr("class","form-control error_input");
                $("#CATEGORY_NO").focus();
                return false;
            }
            $("#SUBCATEGORY_ERROR").html("");
            $("#SUBCATEGORY_NO").attr("class","form-control");
           
            var SUBCATEGORY_NO = $("#SUBCATEGORY_NO").val().trim();
            if(SUBCATEGORY_NO == "-1") {
                $("#SUBCATEGORY_ERROR").text("Subcategory is required");
                $("#SUBCATEGORY_NO").attr("class","form-control error_input");
                $("#SUBCATEGORY_NO").focus();
                return false;
            }

            $("#UNIT_ERROR").html("");
            $("#ITEM_UNIT").attr("class","form-control");
           
            var ITEM_UNIT = $("#ITEM_UNIT").val().trim();
            if(ITEM_UNIT == "") {
                $("#UNIT_ERROR").text("Item Unit is required");
                $("#ITEM_UNIT").attr("class","form-control error_input");
                $("#ITEM_UNIT").focus();
                return false;
            }
            $("#RATE_ERROR").html("");
            $("#ITEM_RATE").attr("class","form-control");
           
            var ITEM_RATE = $("#ITEM_RATE").val().trim();
            if(ITEM_RATE == "") {
                $("#RATE_ERROR").text("Item Rate is required");
                $("#ITEM_RATE").attr("class","form-control error_input");
                $("#ITEM_RATE").focus();
                return false;
            }
       
        });

        
    });
</script>


