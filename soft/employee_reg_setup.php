<?php include 'include/header.php';?>
<?php $table_heading = " Employee Registration";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
 <?php
        $tbl_name="trn_employee_regs";        //your table name
        $targetpage = "employee_reg_setup.php";  //your file name  (the name of this file)
    $user_no =$_SESSION['user']['user_no'];
    $login_time = $_SESSION['login_time'] ;
    $CURR_TIME = date('Y-m-d :H:i:s'); 
        $mgs = '';
    if(isset($_GET['inactivate']))
    {
        $ID = $_GET['inactivate'];
        $sql = "UPDATE $tbl_name SET `IS_ACTIVE` = 0 ,`UPDATED_BY` = '$user_no', `UPDATED_ON` = '$CURR_TIME' WHERE EMPLOYEE_REG_NO = $ID";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Employee Inactivated Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
        }
        else
        {
            $mgs = "Data Deleted Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    }
    if(isset($_GET['activate']))
    {
        $ID = $_GET['activate'];
        $sql = "UPDATE $tbl_name SET `IS_ACTIVE` = 1 ,`UPDATED_BY` = '$user_no', `UPDATED_ON` = '$CURR_TIME' WHERE EMPLOYEE_REG_NO = $ID";
        $result = mysqli_query($con,$sql);
        if($result)
        {
            $mgs = "Employee Activated Successfully!";
            $class = "green_color alert alert-success col-md-6 alert-dismissable";
        }
        else
        {
            $mgs = "Data Deleted Fail!";
            $class = "red_color alert alert-warning alert-dismissable col-md-6";
        }
    }
    if(isset($_POST['submit']))
    {

           
           $USER_NAME=mysqli_real_escape_string($con,trim($_POST['USER_NAME']));
           $EMPLOYEE_ID = trim($_POST['EMPLOYEE_ID']);
           $EMPLOYEE_PASSWORD = md5(trim($_POST['EMPLOYEE_PASSWORD']));
           $EMPLOYEE_NAME = trim($_POST['EMPLOYEE_NAME']);
		   $EMPLOYEE_EMAIL = trim($_POST['EMPLOYEE_EMAIL']);
           $MOBILE_NO = trim($_POST['MOBILE_NO']);
           $ZONE_NO=trim($_POST['ZONE_NO']);
           $DESIGNATION_NO = trim($_POST['DESIGNATION_NO']);
		   $JOINING_DATE=mysqli_real_escape_string($con,trim($_POST['JOINING_DATE']));
            $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND (`USER_NAME` = '$USER_NAME'   OR `EMPLOYEE_ID` = '$EMPLOYEE_ID'   OR `EMPLOYEE_EMAIL` = '$EMPLOYEE_EMAIL' OR `MOBILE_NO` = '$MOBILE_NO' )  ";
            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1):
        if ($_FILES["IMAGE_URL"]["error"] > 0) {
            $IMAGE_URL = "No.png";
            
        } else {
            $IMAGE_URL = time().$_FILES["IMAGE_URL"]["name"];
            move_uploaded_file($_FILES["IMAGE_URL"]["tmp_name"],"upload/" . $IMAGE_URL);
        }
               
              $sql = "INSERT INTO $tbl_name ( `USER_NAME`,`EMPLOYEE_ID` ,`EMPLOYEE_PASSWORD` , `EMPLOYEE_NAME`,`EMPLOYEE_EMAIL` ,`MOBILE_NO` ,`DESIGNATION_NO` ,`JOINING_DATE`,`ZONE_NO` ,`IS_ACTIVE`,`IMAGE_URL`,
			   `CREATED_BY` , `CREATED_ON`) VALUES( '$USER_NAME', '$EMPLOYEE_ID', '$EMPLOYEE_PASSWORD', '$EMPLOYEE_NAME','$EMPLOYEE_EMAIL','$MOBILE_NO','$DESIGNATION_NO','$JOINING_DATE','$ZONE_NO',1,'$IMAGE_URL','$user_no', '$CURR_TIME')";
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
           $USER_NAME=mysqli_real_escape_string($con,trim($_POST['USER_NAME']));
           
           $EMPLOYEE_REG_NO = $_POST['EMPLOYEE_REG_NO'];
           $EMPLOYEE_ID = trim($_POST['EMPLOYEE_ID']);
           $EMPLOYEE_NAME = trim($_POST['EMPLOYEE_NAME']);
		   $EMPLOYEE_EMAIL = trim($_POST['EMPLOYEE_EMAIL']);
           $MOBILE_NO = trim($_POST['MOBILE_NO']);
           $ZONE_NO = trim($_POST['ZONE_NO']);
           $DESIGNATION_NO = trim($_POST['DESIGNATION_NO']);
		   $JOINING_DATE=mysqli_real_escape_string($con,trim($_POST['JOINING_DATE']));
            $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND (`USER_NAME` = '$USER_NAME'   OR  `EMPLOYEE_ID` = '$EMPLOYEE_ID'   OR `EMPLOYEE_EMAIL` = '$EMPLOYEE_EMAIL' OR `MOBILE_NO` = '$MOBILE_NO' ) AND `EMPLOYEE_REG_NO` != '$EMPLOYEE_REG_NO' ";
            $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
            if($COUNT < 1): 
                if ($_FILES["IMAGE_URL"]["error"] > 0) {
            $IMAGE_URL =$_POST['IMAGE_URL'];
            
        } else {
            $IMAGE_URL = time().$_FILES["IMAGE_URL"]["name"];
            move_uploaded_file($_FILES["IMAGE_URL"]["tmp_name"],"upload/" . $IMAGE_URL);
        }
                $sql = "UPDATE $tbl_name SET `USER_NAME` = '$USER_NAME' ,  `EMPLOYEE_ID` = '$EMPLOYEE_ID' , `EMPLOYEE_NAME` = '$EMPLOYEE_NAME' ,
				`EMPLOYEE_EMAIL` = '$EMPLOYEE_EMAIL', `MOBILE_NO` = '$MOBILE_NO' ,`DESIGNATION_NO` = '$DESIGNATION_NO',`JOINING_DATE`='$JOINING_DATE',`ZONE_NO` = '$ZONE_NO' ,`IMAGE_URL` = '$IMAGE_URL' , `IS_UPDATED` = 1, `UPDATED_BY` = '$user_no' ,
				`UPDATED_ON` = '$CURR_TIME'  WHERE `EMPLOYEE_REG_NO` = '$EMPLOYEE_REG_NO' ";
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
        $sql = "SELECT * FROM $tbl_name WHERE `EMPLOYEE_REG_NO` = '$id' ";
        $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
     <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
     <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-5 col-md-offset-3 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="EMPLOYEE_REG_NO" value="<?=$result['EMPLOYEE_REG_NO']?>" />
                <input type="hidden" id="login_time" name="login_time" value="<?=$login_time?>" />
            </div>
        </div>
      <div class="form-group ">
            <label for="USER_NAME" class="control-label col-lg-3">User Name</label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="USER_NAME" type="text" value="<?=$result['USER_NAME']?>" required />
            </div>
            
        </div>  
      <div class="form-group ">
            <label for="EMPLOYEE_ID" class="control-label col-lg-3">Employee ID</label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="EMPLOYEE_ID" type="text" value="<?=$result['EMPLOYEE_ID']?>" required />
            </div>
            
        </div>
	   <div class="form-group ">
            <label for="EMPLOYEE_NAME" class="control-label col-lg-3">Employee Name</label>
            <div class="col-lg-5">
                <input class=" form-control" id="EMPLOYEE_NAME" name="EMPLOYEE_NAME" type="text" value="<?=$result['EMPLOYEE_NAME']?>" required />
            </div>
        </div>
		<div class="form-group ">
            <label for="EMPLOYEE_EMAIL" class="control-label col-lg-3">EMPLOYEE_EMAIL</label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="EMPLOYEE_EMAIL" type="text" value="<?=$result['EMPLOYEE_EMAIL']?>" required />
            </div>
            
        </div>
       
       <div class="form-group ">
            <label for="MOBILE_NO" class="control-label col-lg-3">Mobile Number</label>
            <div class="col-lg-5">
                <input class=" form-control" id="MOBILE_NO" name="MOBILE_NO" type="text" value="<?=$result['MOBILE_NO']?>" required />
            </div>
        </div>

 <div class="form-group ">
            <label for="ZONE_NO" class="control-label col-lg-3">Select Zone</label>
            <div class="col-lg-5">
                <select class="form-control" name="ZONE_NO">
                <option value="-1">--Select Zone--</option>
                    <?php
                            $sql = "SELECT * FROM `gen_zones` where `IS_DELETED`=0 ";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['ZONE_NO']?>" 
                            <?php if($result['ZONE_NO'] == $row['ZONE_NO'])  echo 'selected'; ?>>
                            <?=$row['ZONE_NAME']?></option>
                        <?php endwhile;?>
                </select>
            </div>
            
        </div>
        <div class="form-group ">
            <label for="GROUP_NAME" class="control-label col-lg-3">Select Designation</label>
            <div class="col-lg-5">
                <select class="form-control" name="DESIGNATION_NO">
                <option value="-1">--Select Designation--</option>
                    <?php
                            $sql = "SELECT * FROM `gen_designations` where `IS_DELETED`=0 ";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['DESIGNATION_NO']?>" 
                            <?php if($result['DESIGNATION_NO'] == $row['DESIGNATION_NO'])  echo 'selected'; ?>>
                            <?=$row['DESIGNATION_NAME']?></option>
                        <?php endwhile;?>
                </select>
            </div>
            
        </div>
        <div class="form-group ">
            <label for="JOINING_DATE" class="control-label col-lg-3">Joining Date</label>
            <div class="col-lg-5">
                <input class=" form-control" id="JOINING_DATE" name="JOINING_DATE" type="date" value="<?php echo strftime('%Y-%m-%d',strtotime($result['JOINING_DATE'])); ?>"  required />
            </div>
        </div>
        
        <div class="form-group ">
            <label for="IMAGE_URL" class="control-label col-lg-3">Image </label>
            <div class="col-lg-5">
                <input type="file"  name="IMAGE_URL" id="" value="<?=$result['IMAGE_URL']?>">
                <img src="upload/<?=$result['IMAGE_URL']?>" height="80" width="60"/> 
            </div>
           <div>
                <input type="hidden" name="IMAGE_URL" value="<?=$result['IMAGE_URL']?>" />
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
            <input type="hidden" id="login_time" name="login_time" value="<?=$login_time?>" />
            
        </div>
       
         <div class="form-group ">
            <label for="USER_NAME" class="control-label col-lg-3">User Name</label>
            <div class="col-lg-5">
                <input class=" form-control" id="USER_NAME" name="USER_NAME" type="text"  required />
                <P class="error_message" id="USER_NAME_ERROR"></P>
            </div>
            
        </div> 
      <div class="form-group ">
            <label for="EMPLOYEE_ID" class="control-label col-lg-3">Employee ID </label>
            <div class="col-lg-5">
                <input class=" form-control" id="EMPLOYEE_ID" name="EMPLOYEE_ID" type="text"  required />
                <P class="error_message" id="ID_ERROR"></P>
            </div>
            
        </div>
         
		<div class="form-group ">
            <label for="EMPLOYEE_NAME" class="control-label col-lg-3">Employee Name</label>
            <div class="col-lg-5">
                <input class=" form-control" id="EMPLOYEE_NAME" name="EMPLOYEE_NAME" type="text" required=""  />
                <P class="error_message" id="NAME_ERROR"></P>
            </div>
        </div>
        
        

        <div class="form-group ">
            <label for="EMPLOYEE_EMAIL" class="control-label col-lg-3">Employee Email </label>
            <div class="col-lg-5">
                <input class=" form-control" id="EMPLOYEE_EMAIL" name="EMPLOYEE_EMAIL" type="email"  required />
                <P class="error_message" id="EMAIL_ERROR"></P>
            </div>
            
        </div>

         <div class="form-group ">
            <label for="MOBILE_NO" class="control-label col-lg-3">Mobile Number</label>
            <div class="col-lg-5">
                <input class=" form-control" id="MOBILE_NO" name="MOBILE_NO" type="text"  required />
                <P class="error_message" id="MOBILE_ERROR"></P>
            </div>
        </div>
          
          <div class="form-group ">
            <label for="ZONE_NO" class="control-label col-lg-3">Select Zone</label>
            <div class="col-lg-5">
                <select class="form-control" name="ZONE_NO" id="ZONE_NO">
                <option value="-1">--Select Zone--</option>
                    <?php
                        $sql="SELECT * FROM `gen_zones` WHERE `IS_DELETED`=0";
                        $query=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_array($query)):
                    ?>
                        <option value="<?=$row['ZONE_NO']?>"><?=$row['ZONE_NAME']?></option>
                    <?php endwhile; ?>
                </select>
                <P class="error_message" id="ZONE_ERROR"></P>
            </div>
            
        </div>

		<div class="form-group ">
            <label for="GROUP_NAME" class="control-label col-lg-3">Select Designation</label>
            <div class="col-lg-5">
                <select class="form-control" name="DESIGNATION_NO" id="DESIGNATION_NO">
				<option value="-1">--Select Designation--</option>
                    <?php
                        $sql="SELECT * FROM `gen_designations` WHERE `IS_DELETED`=0";
                        $query=mysqli_query($con,$sql);
                        while($row=mysqli_fetch_array($query)):
                    ?>
                        <option value="<?=$row['DESIGNATION_NO']?>"><?=$row['DESIGNATION_NAME']?></option>
                    <?php endwhile; ?>
                </select>
                <P class="error_message" id="DESIGNATION_ERROR"></P>
            </div>
            
        </div>
        <div class="form-group ">
            <label for="JOINING_DATE" class="control-label col-lg-3">Joining Date</label>
            <div class="col-lg-5">
                <input class=" form-control" id="JOINING_DATE" name="JOINING_DATE" type="date" required />
                <P class="error_message" id="DATE_ERROR"></P>
            </div>
        </div>
		
        <div class="form-group ">
            <label for="EMPLOYEE_PASSWORD" class="control-label col-lg-3">  Password </label>
            <div class="col-lg-5">
                <input class=" form-control" id="PASSWORD" name="EMPLOYEE_PASSWORD" type="password"  required />
                <P class="error_message" id="PASSWORD_ERROR"></P>
            </div>
            
        </div>
        <div class="form-group ">
            <label for="EMPLOYEE_PASSWORD" class="control-label col-lg-3"> Confirm Password </label>
            <div class="col-lg-5">
                <input class=" form-control" id="RE_PASSWORD" name="EMPLOYEE_PASSWORD" type="password"  required />
                <P class="error_message" id="REPASSWORD_ERROR"></P>
            </div>
            
        </div>
       
		<div class="form-group ">
            <label for="IMAGE_URL" class="control-label col-lg-3"> Image </label>
            <div class="col-lg-5">
                <input class=" form-control" id="IMAGE_URL" name="IMAGE_URL" type="file" />

            </div>
            
        </div>
        
		
		
       <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" id="btnAdd" name="submit" value="Add" id="create_user" />
                
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
                     <label for="location" class="control-label col-lg-2"> Employee ID</label>
                    <div class="col-lg-4">

                        <input class=" form-control" id="" name="EMPLOYEE_ID" type="text"  style="" >
                        
                    </div>
                   
                    <label for="item" class="control-label col-lg-2">Zone</label>
                    <div class="col-lg-4">
                        <select class="form-control search" name="ZONE_NO" id="" style="width: 100%">
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
                    
                    <label for="location" class="control-label col-lg-2">Designation </label>
                    <div class="col-lg-4">
                       <select class="form-control search" name="DESIGNATION_NO" id="" style="width: 100%">
                            <option value="-1">-- Select Designation --</option>
                         <?php
                                $sql = "SELECT * FROM `gen_designations` where IS_DELETED=0 ";
                                $result1 = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result1)):
                            ?>
                                <option value="<?=$row['DESIGNATION_NO']?>" ><?=$row['DESIGNATION_NAME']?> ( <?=$row['DESIGNATION_LEVEL']?> )</option>
                            <?php endwhile;?>
                        </select>
                    </div>
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
        
        $EMPLOYEE_ID =mysqli_real_escape_string($con,trim($_POST['EMPLOYEE_ID']));
          if($EMPLOYEE_ID != ""){
            $where.=" AND `trn_employee_regs`.`EMPLOYEE_ID` LIKE '%$EMPLOYEE_ID%'";
          }
          $ZONE_NO =$_POST['ZONE_NO'];
          if($ZONE_NO != -1){
            $where.=" AND `trn_employee_regs`.`ZONE_NO` = '$ZONE_NO'";
          }
         
          $DESIGNATION_NO =$_POST['DESIGNATION_NO'];
          if($DESIGNATION_NO != -1){
            $where.=" AND `trn_employee_regs`.`DESIGNATION_NO` = '$DESIGNATION_NO'";
          }
    }
    
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    
    /* 
       First get total number of rows in data table. 
       If you have a WHERE clause in your query, make sure you mirror it here.
    */
    $query = "SELECT COUNT(*) as num FROM $tbl_name WHERE $tbl_name.`IS_DELETED` = 0 $where";
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
  
   
       $sql = "SELECT * FROM $tbl_name  LEFT JOIN `gen_designations` ON `gen_designations`.`DESIGNATION_NO`=$tbl_name.`DESIGNATION_NO` LEFT JOIN `gen_zones` ON `gen_zones`.`ZONE_NO`=$tbl_name.`ZONE_NO` WHERE $tbl_name.`IS_DELETED` = 0 $where ORDER  BY $tbl_name.`EMPLOYEE_REG_NO` DESC LIMIT $start, $limit";
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
<div style="overflow: auto;">
    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>
            <th><center>Sl</center></th>
            <th><center>User Name</center></th>
            <th><center>Employee ID</center></th>
             <th><center>Employee Name</center></th>
            <th><center>Employee Email</center></th>
            <th><center>Mobile Number</center></th>
            <th><center>Zone</center></th>
            <th><center>Designation</center></th>
            <th><center>Joining Date</center></th>
            <th><center>Image</center></th>
            <th><center>Action</center></th>
            
            
         </tr>
    <?php $i=$page*$limit-$limit+1; while($row = mysqli_fetch_array($result)):?>
        <tr>
            <td><center><?=$i++?></center></td>
            <td><?=$row['USER_NAME']?></td>
            <td><?=$row['EMPLOYEE_ID']?></td>
           <td><?=$row['EMPLOYEE_NAME']?></td>
            <td><?=$row['EMPLOYEE_EMAIL']?></td>
            <td><?=$row['MOBILE_NO']?></td>
            <td><center><?=$row['ZONE_NAME']?></center></td>
            <td><center><?=$row['DESIGNATION_NAME']?></center></td>
            <td><?=$row['JOINING_DATE']?></td>
            <td><a class="" target="_blank" href="upload/<?=$row['IMAGE_URL']?>" title="Click to view full image"><img src="upload/<?=$row['IMAGE_URL']?>" height="70px" width="60px"></a></td>
           <td>
               <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['EMPLOYEE_REG_NO']?>" class="btn btn-primary"> Edit</a>
            <?php if($row['IS_ACTIVE']==1):
              ?>
                <a onclick="return confirm('Are you Sure Want to Inactivate this Employee?');" href="<?=$targetpage.'?inactivate='.$row['EMPLOYEE_REG_NO']?>" class="btn btn-danger"> Inactive</a></center>
            <?php else:?>
                 <a onclick="return confirm('Are you Sure Want to Activate this Employee?');" href="<?=$targetpage.'?activate='.$row['EMPLOYEE_REG_NO']?>" class="btn btn-info"> Activate</a></center>
            <?php endif;?>
            </td>
        </tr>
    <?php endwhile;?>
    </table>
</div>
<?=$pagination?>
    
    <!---main content end---->
<?php include 'include/footer.php';?>
<script type="text/javascript">
    $("#btnAdd").on("click",function() {

             $("#USER_NAME_ERROR").html("");
            $("#USER_NAME").attr("class","form-control");
           
            var USER_NAME = $("#USER_NAME").val().trim();
            if(USER_NAME == "") {
                $("#USER_NAME_ERROR").text("User Name is required");
                $("#USER_NAME").attr("class","form-control error_input");
                $("#USER_NAME").focus();
                return false;
            }
            $("#ID_ERROR").html("");
            $("#EMPLOYEE_ID").attr("class","form-control");
           
            var EMPLOYEE_ID = $("#EMPLOYEE_ID").val().trim();
            if(EMPLOYEE_ID == "") {
                $("#ID_ERROR").text("Employee ID is required");
                $("#EMPLOYEE_ID").attr("class","form-control error_input");
                $("#EMPLOYEE_ID").focus();
                return false;
            }

            $("#NAME_ERROR").html("");
            $("#EMPLOYEE_NAME").attr("class","form-control");
           
            var EMPLOYEE_NAME = $("#EMPLOYEE_NAME").val().trim();
            if(EMPLOYEE_NAME == "") {
                $("#NAME_ERROR").text("Employee Name is required");
                $("#EMPLOYEE_NAME").attr("class","form-control error_input");
                $("#EMPLOYEE_NAME").focus();
                return false;
            }
            $("#EMAIL_ERROR").html("");
            $("#EMPLOYEE_EMAIL").attr("class","form-control");
           
            var EMPLOYEE_EMAIL = $("#EMPLOYEE_EMAIL").val().trim();
            if(EMPLOYEE_EMAIL == "") {
                $("#EMAIL_ERROR").text("Email is required");
                $("#EMPLOYEE_EMAIL").attr("class","form-control error_input");
                $("#EMPLOYEE_EMAIL").focus();
                return false;
            }

            $("#MOBILE_ERROR").html("");
            $("#MOBILE_NO").attr("class","form-control");
           
            var MOBILE_NO = $("#MOBILE_NO").val().trim();
            if(MOBILE_NO == "") {
                $("#MOBILE_ERROR").text("Employee Contact is required");
                $("#MOBILE_NO").attr("class","form-control error_input");
                $("#MOBILE_NO").focus();
                return false;
            }

            $("#DESIGNATION_ERROR").html("");
            $("#DESIGNATION_NO").attr("class","form-control");
           
            var DESIGNATION_NO = $("#DESIGNATION_NO").val().trim();
            if(DESIGNATION_NO == "-1") {
                $("#DESIGNATION_ERROR").text("Designation is required");
                $("#DESIGNATION_NO").attr("class","form-control error_input");
                $("#DESIGNATION_NO").focus();
                return false;
            }

            $("#ZONE_ERROR").html("");
            $("#ZONE_NO").attr("class","form-control");
           
            var ZONE_NO = $("#ZONE_NO").val().trim();
            if(ZONE_NO == "-1") {
                $("#ZONE_ERROR").text("Zone is required");
                $("#ZONE_NO").attr("class","form-control error_input");
                $("#ZONE_NO").focus();
                return false;
            }
            

             $("#DATE_ERROR").html("");
            $("#JOINING_DATE").attr("class","form-control");
           
            var JOINING_DATE = $("#JOINING_DATE").val();
             var login_time = $("#login_time").val();
            if(JOINING_DATE == "") {
                $("#DATE_ERROR").text("Joining Date is required");
                $("#JOINING_DATE").attr("class","form-control error_input");
                $("#JOINING_DATE").focus();
                return false;
            }
            else if(JOINING_DATE > login_time){
                $("#DATE_ERROR").text("Joining Date Can Not Be Greater Than Current Date!");
                $("#JOINING_DATE").attr("class","form-control error_input");
                $("#JOINING_DATE").focus();
                return false;
            }

         $("#PASSWORD_ERROR").html("");
        $("#PASSWORD").attr("class","form-control");
           
        var PASSWORD = $("#PASSWORD").val().trim();
        if(PASSWORD == "") {
            $("#PASSWORD_ERROR").text("Password is Required");
            $("#PASSWORD").attr("class","form-control error_input");
            $("#PASSWORD").focus();
            return false;
        }
         $("#REPASSWORD_ERROR").html("");
        $("RE_PASSWORD").attr("class","form-control");
        
        var RE_PASSWORD = $("#RE_PASSWORD").val().trim();
        if(RE_PASSWORD == "") {
            $("#REPASSWORD_ERROR").text("Confirm Password is Required");
            $("#RE_PASSWORD").attr("class","form-control error_input");
            $("#RE_PASSWORD").focus();
            return false;
        }
         $("#REPASSWORD_ERROR").html("");
       $("RE_PASSWORD").attr("class","form-control");
        
        var PASSWORD = $("#PASSWORD").val().trim();
         var RE_PASSWORD = $("#RE_PASSWORD").val().trim();
        
        if(PASSWORD != RE_PASSWORD){
                $("#REPASSWORD_ERROR").text("Password Mismatch!");
                 $("#RE_PASSWORD").focus();
                return false;
            }
        });

</script>
