<?php include 'include/header.php';?>
<?php $table_heading = "Root Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 <?php
        $tbl_name="gen_bits";        //your table name
        $targetpage = "bit_setup.php";  //your file name  (the name of this file)
    $user_no =$_SESSION['user']['user_no'];
    $CURR_TIME = date('Y-m-d :H:i:s'); 
        $mgs = '';
    if(isset($_GET['delete']))
    {


        $ID = $_GET['delete'];
        $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1 ,`DELETED_BY` = '$user_no', `DELETED_ON` = '$CURR_TIME' WHERE BIT_NO = $ID";
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
       
           
           $ZONE_NO = $_POST['ZONE_NO'];
           $BIT_CODE = mysqli_real_escape_string($con,trim($_POST['BIT_CODE']));
           $BIT_AREA = mysqli_real_escape_string($con,trim($_POST['BIT_AREA']));
        
           
           

           $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `ZONE_NO` = '$ZONE_NO' AND `BIT_CODE` = '$BIT_CODE' AND `BIT_AREA` = '$BIT_AREA' ";

            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1):
               
                
               $sql = "INSERT INTO $tbl_name SET `ZONE_NO` = '$ZONE_NO',`BIT_CODE` = '$BIT_CODE', `BIT_AREA` = '$BIT_AREA' ,`CREATED_BY`='$user_no',`CREATED_ON`='$CURR_TIME' ";
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


           $BIT_NO = trim($_POST['BIT_NO']);
           $BIT_CODE = mysqli_real_escape_string($con,trim($_POST['BIT_CODE']));
           $BIT_AREA = mysqli_real_escape_string($con,trim($_POST['BIT_AREA']));
            $ZONE_NO = $_POST['ZONE_NO'];

            $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `ZONE_NO` = '$ZONE_NO' AND `BIT_CODE` = '$BIT_CODE' AND `BIT_AREA` = '$BIT_AREA' AND  `BIT_NO` != '$BIT_NO'";
            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1): 
                
                $sql = "UPDATE $tbl_name SET `ZONE_NO` = '$ZONE_NO',  `BIT_CODE` = '$BIT_CODE' , `BIT_AREA` = '$BIT_AREA' ,`IS_UPDATED` = 1, `UPDATED_BY` = '$user_no' ,
                `UPDATED_ON` = '$CURR_TIME'  WHERE BIT_NO = $BIT_NO";
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
        $sql = "SELECT * FROM $tbl_name WHERE `BIT_NO` = '$id' ";
        $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
     <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
     <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-5 col-md-offset-3 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="BIT_NO" value="<?=$result['BIT_NO']?>" />
            </div>
        </div>
        <div class="form-group ">
            <label for="ZONE_NO" class="control-label col-lg-3">Select Zone </label>
            <div class="col-lg-5">
                <select class="form-control" name="ZONE_NO" id="ZONE_NO" required="">
                    <option value="-1">--Select Zone--</option>
                    <?php
                    $sql = "SELECT * FROM `gen_zones` where IS_DELETED=0 ";
                    $result1 = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result1)):
                        ?>
                        <option value="<?=$row['ZONE_NO']?>" <?php if($result['ZONE_NO'] == $row['ZONE_NO'])  echo 'selected'; ?>><?=$row['ZONE_NAME']?></option>
                    <?php endwhile;?>
                </select>
                
            </div>

        </div>
        <div class="form-group ">
            <label for="BIT_CODE" class="control-label col-lg-3">Root Code </label>
            <div class="col-lg-5">
                <input class=" form-control" id="BIT_CODE" value="<?=$result['BIT_CODE']?>" name="BIT_CODE" type="text"  required />
            </div>  
        </div>

        

        <div class="form-group ">
            <label for="BIT_AREA" class="control-label col-lg-3">Root Address </label>
            <div class="col-lg-5">
                <textarea class="form-control" name="BIT_AREA"><?=$result['BIT_AREA']?></textarea>
            </div>
            
        </div>
        
     <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" name="update" value="Update" />
                
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
            <label for="ZONE_NO" class="control-label col-lg-3">Select Zone </label>
            <div class="col-lg-5">
                <select class="form-control" name="ZONE_NO" id="ZONE_NO" required="">
                    <option value="-1">--Select Zone--</option>
                    <?php
                    $sql = "SELECT * FROM `gen_zones` where IS_DELETED=0 ";
                    $result1 = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result1)):
                        ?>
                        <option value="<?=$row['ZONE_NO']?>"><?=$row['ZONE_NAME']?></option>
                    <?php endwhile;?>
                </select>
                <P class="error_message" id="ZONE_ERROR"></P>
            </div>

        </div>       
          <div class="form-group ">
            <label for="BIT_CODE" class="control-label col-lg-3">Root Code </label>
            <div class="col-lg-5">
                <input class=" form-control" id="BIT_CODE" name="BIT_CODE" type="text"  required />
                <P class="error_message" id="CODE_ERROR"></P>
            </div>  
        </div>

    


        <div class="form-group ">
            <label for="BIT_AREA" class="control-label col-lg-3">Root Address </label>
            <div class="col-lg-5">
                <textarea class="form-control" name="BIT_AREA"></textarea>
            </div>
            
        </div>


       <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" id="btnAdd" name="submit" value="Add" />
                
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
                     
                   
                    <label for="item" class="control-label col-lg-3">Zone</label>
                    <div class="col-lg-5">
                        <select class="form-control search" name="ZONE_NO" id="ZONE_NO" style="width: 100%">
                            <option value="-1">-- Select Zone --</option>
                         <?php
                                $sql = "SELECT * FROM `gen_zones` where IS_DELETED=0 ";
                                $result1 = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result1)):
                            ?>
                                <option value="<?=$row['ZONE_NO']?>" ><?=$row['ZONE_NAME']?></option>
                            <?php endwhile;?>
                        </select>
                        
                    </div>
                </div>
                <div class="form-group ">
                    
                    <label for="BIT_CODE" class="control-label col-lg-3">Root </label>
                    <div class="col-lg-5">
                       <input type="text" class="form-control" name="BIT_CODE">
                    </div>
                    
                </div>
                <div class="form-group ">
                    <label for="location" class="control-label col-lg-3"></label>
                    <div class=" col-lg-5">
                        <input type="submit" class="btn btn-primary" id="searchBtn" name="searchBtn" value="Search" />
                        
                    </div>
                </div>
                 
          </fieldset> 
        </form>

    <?php

    $where = "";
    if(isset($_POST['searchBtn']))
    {
        
        
          $ZONE_NO =$_POST['ZONE_NO'];
          if($ZONE_NO != -1){
            $where.=" AND `gen_bits`.`ZONE_NO` = '$ZONE_NO'";
          }
         $BIT_CODE =mysqli_real_escape_string($con,trim($_POST['BIT_CODE']));
          if($BIT_CODE != ""){
            $where.=" AND `gen_bits`.`BIT_CODE` LIKE '%$BIT_CODE%'";
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
    $sql = "SELECT * FROM $tbl_name LEFT JOIN `gen_zones` ON `gen_zones`.`ZONE_NO`=$tbl_name.`ZONE_NO` WHERE $tbl_name.`IS_DELETED` = 0 $where ORDER  BY $tbl_name.`BIT_NO` DESC LIMIT $start, $limit";
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

    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>
            <th><center>Sl</center></th>
            <th><center>Zone Name</center></th>
            <th><center>Root Code</center></th>
            <th><center>Root Address</center></th>
            
            <th><center>Action</center></th>
         </tr>
    <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
        <tr>
            <td><center><?=$i++?></center></td>
            <td><?=$row['ZONE_NAME']?></td>
            <td><?=$row['BIT_CODE']?></td>
            <td><?=$row['BIT_AREA']?></td>
           <td>
               <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['BIT_NO']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['BIT_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center>
            </td>
        </tr>
    <?php endwhile;?>
    </table>

<?=$pagination?>
    
    <!---main content end---->
<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function() {
     $("#btnAdd").on("click",function() {

        $("#ZONE_ERROR").html("");
        $("#ZONE_NO").attr("class","form-control");
       
        var ZONE_NO = $("#ZONE_NO").val().trim();
        if(ZONE_NO == '-1') {
            $("#ZONE_ERROR").text("Zone is required");
            $("#ZONE_NO").attr("class","form-control error_input");
            $("#ZONE_NO").focus();
            return false;
        }

        $("#CODE_ERROR").html("");
        $("#BIT_CODE").attr("class","form-control");
       
        var BIT_CODE = $("#BIT_CODE").val().trim();
        if(BIT_CODE == "") {
            $("#CODE_ERROR").text("Bit Code is required");
            $("#BIT_CODE").attr("class","form-control error_input");
            $("#BIT_CODE").focus();
            return false;
        }

        
        
    });
});

</script>