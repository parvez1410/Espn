<?php include 'include/header.php';?>
<?php $table_heading = "Change Password";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
	if(isset($_POST['update']))
	{
		$NEW_PASS1 = trim($_POST['NEW_PASS1']);
		$NEW_PASS2 = trim($_POST['NEW_PASS2']);
		$EMPLOYEE_REG_NO = $_POST['EMPLOYEE_REG_NO'];
		$sql = "SELECT * FROM `trn_employee_regs` WHERE  `EMPLOYEE_REG_NO` = '$EMPLOYEE_REG_NO'";
		$query = mysqli_query($con,$sql);
		$row_count = mysqli_num_rows($query);
		
		if($row_count == 1)
		{
			if(strlen($NEW_PASS1) < 6)
			{
				$mgs = "Password too short! Password Length at least 6 characters.";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
			elseif (!preg_match("#[0-9]+#", $NEW_PASS1)) {
				$mgs = "Password must include at least one number!";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
			elseif (!preg_match("#[a-zA-Z]+#", $NEW_PASS1)) {
				$mgs = "Password must include at least one letter!";
				$class = "red_color";
			}    
			elseif($NEW_PASS1 == $NEW_PASS2)
			{
				$NEW_PASS = md5($NEW_PASS1);
				$sql = "UPDATE `trn_employee_regs` SET `EMPLOYEE_PASSWORD`= '$NEW_PASS' WHERE `EMPLOYEE_REG_NO` = '$EMPLOYEE_REG_NO'";
				$result = mysqli_query($con,$sql);
				if($result)
				{
					$mgs = "Password Changed Successfully!";
					$class = "green_color alert alert-success col-md-6 alert-dismissable";
				}
				else
				{
					$mgs = "Password Change Faild!";
					$class = "red_color alert alert-warning alert-dismissable col-md-6";
				}
			}
			else
			{
				$mgs = "Password does not match!";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
		}
		
	}
	else
	{
		$class = "";
		$mgs = "";
	}
?>

     <form class="cmxform form-horizontal " id="signupForm" method="post" action="" >
     <div class="form-group " <?php if($mgs=="")echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-1 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="address_id" value="<?=$result['address_id']?>"   />
            </div>
        </div>
        <div class="form-group ">
            <label for="ZONE_NO" class="control-label col-lg-3">Select Employee</label>
            <div class="col-lg-4">
                <select class="form-control search" name="EMPLOYEE_REG_NO" style="width: 100%" required="">
                <option value="-1">--Select Employee--</option>
                    <?php
                            $sql = "SELECT * FROM `trn_employee_regs` where `IS_ACTIVE`=1";
                            $result1 = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_array($result1)):
                        ?>
                            <option value="<?=$row['EMPLOYEE_REG_NO']?>" >
                            <?=$row['EMPLOYEE_NAME']?> ( <?=$row['EMPLOYEE_ID']?> )</option>
                        <?php endwhile;?>
                </select>
            </div>
            
        </div>
        <!-- <div class="form-group ">
            <label for="location" class="control-label col-lg-3">Old Password  </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="OLD_PASS" type="text" required style="" >
                
            </div>
        </div> -->
        <div class="form-group ">
            <label for="location" class="control-label col-lg-3">New Password  </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="NEW_PASS1" type="text"  style="" required="">
            </div>
        </div>
        <div class="form-group ">
            <label for="contact" class="control-label col-lg-3">Confirm Password </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="NEW_PASS2" type="text" required style="" >
                
            </div>
        </div>
         <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" name="update" value="Change Password" />
                
            </div>
        </div>
       
    </form>
                                
<?php include 'include/body-bottom.php';?>
<?php include 'include/footer.php';?>
