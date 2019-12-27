<?php include 'include/header.php';?>
<?php $table_heading = "Change password";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
	if(isset($_POST['update']))
	{
		$old_pass = md5(trim($_POST['old_pass']));
		$new_pass1 = trim($_POST['new_pass1']);
		$new_pass2 = trim($_POST['new_pass2']);
		$user_no = $_SESSION['user']['user_no'];
		$sql = "SELECT * FROM `xxx_user` WHERE `pass` = '$old_pass' AND `user_no` = '$user_no'";
		$query = mysqli_query($con,$sql);
		$row_count = mysqli_num_rows($query);
		
		if($row_count == 1)
		{
			if(strlen($new_pass1) < 6)
			{
				$mgs = "Password is too short! Password Length should be at least of 6 characters.";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
			elseif (!preg_match("#[0-9]+#", $new_pass1)) {
				$mgs = "Password must include at least one number!";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
			elseif (!preg_match("#[a-zA-Z]+#", $new_pass1)) {
				$mgs = "password must include at least one letter!";
				$class = "red_color";
			}    
			elseif($new_pass1 == $new_pass2)
			{
				$new_pass = md5($new_pass1);
				$sql = "UPDATE `xxx_user` SET `pass`= '$new_pass' WHERE `user_no` = '$user_no'";
				$result = mysqli_query($con,$sql);
				if($result)
				{
					$mgs = "Password Changed Successfully!";
					$class = "green_color alert alert-success col-md-6 alert-dismissable";
				}
				else
				{
					$mgs = "Password Change Failed!";
					$class = "red_color alert alert-warning alert-dismissable col-md-6";
				}
			}
			else
			{
				$mgs = "New password does not match!";
				$class = "red_color alert alert-warning alert-dismissable col-md-6";
			}
		}
		else
		{
			$mgs = "Old password does not match!";
			$class = "red_color alert alert-warning alert-dismissable col-md-6";	
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
                <input type="hidden" name="user_no" value="<?=$result['user_no']?>"   />
            </div>
        </div>
        <div class="form-group ">
            <label for="location" class="control-label col-lg-3">Old password  </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="old_pass" type="text" required style="" >
                
            </div>
        </div>
        <div class="form-group ">
            <label for="location" class="control-label col-lg-3">New password  </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="new_pass1" type="text"  style="" >
            </div>
        </div>
        <div class="form-group ">
            <label for="contact" class="control-label col-lg-3">Confirm password </label>
            <div class="col-lg-4">
                <input type="password" class=" form-control" id="" name="new_pass2" type="text" required style="" >
                
            </div>
        </div>
         <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" name="update" value="Change password" />
                
            </div>
        </div>
       
    </form>
                                
<?php include 'include/body-bottom.php';?>
<?php include 'include/footer.php';?>
