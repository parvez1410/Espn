<?php include 'include/header.php';?>
<?php $table_heading = "Package Image upload";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$tbl_name="gen_packagemasters";        //your table name
$targetpage = "package_image.php";  //your file name  (the name of this file)
$user_no =$_SESSION['user']['user_no'];
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_POST['btnAdd']))
{
    $PACKAGEMASTER_NO = trim($_POST['PACKAGEMASTER_NO']);
     if ($_FILES["PACKAGE_IMAGE"]["error"] > 0) {
            $PACKAGE_IMAGE =$_POST['PACKAGE_IMAGE'];
            
        } else {
            $PACKAGE_IMAGE = time().$_FILES["PACKAGE_IMAGE"]["name"];
            move_uploaded_file($_FILES["PACKAGE_IMAGE"]["tmp_name"],"upload/" . $PACKAGE_IMAGE);
        }
        $sql = "UPDATE $tbl_name SET   `PACKAGE_IMAGE` = '$PACKAGE_IMAGE' , `IS_UPDATED` = 1, `UPDATED_BY` = '$user_no' ,`UPDATED_ON` = '$CURR_TIME'  WHERE PACKAGEMASTER_NO = $PACKAGEMASTER_NO";
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
   // echo "<meta http-equiv='Refresh' content='5; url=package_image.php'>";
}
?>
    <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data">
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>

        </div>

        <div class="form-group ">
            <label for="CATEGORY_NAME" class="control-label col-lg-3"> Select Package </label>
            <div class="col-lg-5">
                <select class="form-control search" name="PACKAGEMASTER_NO" id="PACKAGEMASTER_NO" style="width: 100%">
                            <option value="-1">-- Select Package --</option>
                         <?php
                                $sql = "SELECT * FROM `gen_packagemasters` where IS_DELETED=0 ";
                                $result1 = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result1)):
                            ?>
                                <option value="<?=$row['PACKAGEMASTER_NO']?>" ><?=$row['PACKAGE_NAME']?> ( <?=$row['PACKAGE_CODE']?> )</option>
                            <?php endwhile;?>
                        </select>
                <P class="error_message" id="PACKAGE_ERROR"></P>
            </div>

        </div>
        <div class="form-group ">
            <label for="PACKAGE_IMAGE" class="control-label col-lg-3">Package Image </label>
            <div class="col-lg-5">
                <input class=" form-control" id="PACKAGE_IMAGE" name="PACKAGE_IMAGE" type="file" />
                <P class="error_message" id="IMAGE_ERROR"></P>
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-md-offset-2 col-sm-offset-3 col-xs-offset-3 col-lg-5">
                <input type="submit" class="btn btn-primary" id="btnAdd" name="btnAdd" value="Add" />
            </div>
        </div>
    </form>

    


  
<?php include 'include/footer.php';?>
<script type="text/javascript">
    $("#btnAdd").on("click",function() {

     $("#PACKAGE_ERROR").html("");
        $("#PACKAGEMASTER_NO").attr("class","form-control");
           
        var PACKAGEMASTER_NO = $("#PACKAGEMASTER_NO").val().trim();
        if(PACKAGEMASTER_NO == "-1") {
            $("#PACKAGE_ERROR").text("Select a Package");
            $("#PACKAGEMASTER_NO").attr("class","form-control error_input");
            $("#PACKAGEMASTER_NO").focus();
            return false;
        }

        $("#IMAGE_ERROR").html("");
        $("#PACKAGE_IMAGE").attr("class","form-control");
           
        var PACKAGE_IMAGE = $("#PACKAGE_IMAGE").val().trim();
        if(PACKAGE_IMAGE == "") {
            $("#IMAGE_ERROR").text("Image is Required!");
            $("#PACKAGE_IMAGE").attr("class","form-control error_input");
            $("#PACKAGE_IMAGE").focus();
            return false;
        }
    });
</script>
