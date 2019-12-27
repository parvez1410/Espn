<?php include 'include/header.php';?>
<?php $table_heading = "Sub Category Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$tbl_name="gen_subcategorys";        //your table name
$targetpage = "sub_category.php"; 
$user_no =$_SESSION['user']['user_no']; //your file name  (the name of this file)
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_GET['delete']))
{
    $ID = $_GET['delete'];
    $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1  WHERE SUBCATEGORY_NO = $ID";
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
    $CATEGORY_NO = trim($_POST['CATEGORY_NO']);
    $SUBCATEGORY_NAME = $_POST['SUBCATEGORY_NAME'];
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `CATEGORY_NO` = '$CATEGORY_NO' AND `SUBCATEGORY_NAME` = '$SUBCATEGORY_NAME'  ";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        if ($_FILES["SUB_CATEGORY_IMAGE"]["error"] > 0) {
            $SUB_CATEGORY_IMAGE = "No.png";
            
        } else {
            $SUB_CATEGORY_IMAGE = time().$_FILES["SUB_CATEGORY_IMAGE"]["name"];
            move_uploaded_file($_FILES["SUB_CATEGORY_IMAGE"]["tmp_name"],"upload/" . $SUB_CATEGORY_IMAGE);
        }
        $sql = "INSERT INTO $tbl_name ( `CATEGORY_NO` , `SUBCATEGORY_NAME`,`SUB_CATEGORY_IMAGE` ) VALUES(  '$CATEGORY_NO','$SUBCATEGORY_NAME','$SUB_CATEGORY_IMAGE')";
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
    $SUBCATEGORY_NO = trim($_POST['SUBCATEGORY_NO']);
    $CATEGORY_NO = trim($_POST['CATEGORY_NO']);
    $SUBCATEGORY_NAME= $_POST['SUBCATEGORY_NAME'];
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `CATEGORY_NO` = '$CATEGORY_NO' AND `SUBCATEGORY_NAME` = '$SUBCATEGORY_NAME' AND `SUBCATEGORY_NO` != '$SUBCATEGORY_NO'";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        if ($_FILES["SUB_CATEGORY_IMAGE"]["error"] > 0) {
            $SUB_CATEGORY_IMAGE =$_POST['SUB_CATEGORY_IMAGE'];
            
        } else {
            $SUB_CATEGORY_IMAGE = time().$_FILES["SUB_CATEGORY_IMAGE"]["name"];
            move_uploaded_file($_FILES["SUB_CATEGORY_IMAGE"]["tmp_name"],"upload/" . $SUB_CATEGORY_IMAGE);
        }
        $sql = "UPDATE $tbl_name SET   `CATEGORY_NO` = '$CATEGORY_NO' , `SUBCATEGORY_NAME`='$SUBCATEGORY_NAME',`SUB_CATEGORY_IMAGE`='$SUB_CATEGORY_IMAGE', `IS_UPDATED` = 1 WHERE SUBCATEGORY_NO = $SUBCATEGORY_NO";
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
    $sql = "SELECT * FROM $tbl_name WHERE `SUBCATEGORY_NO` = '$id' ";
    $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
    <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="SUBCATEGORY_NO" value="<?=$result['SUBCATEGORY_NO']?>" />
            </div>
        </div>

        <div class="form-group ">
            <label for="CATEGORY_NO" class="control-label col-lg-3">CATEGORY </label>
            <div class="col-lg-5">
                <select class="form-control" name="CATEGORY_NO" id="CATEGORY_NO" required="">
                    <?php
                    $sql = "SELECT * FROM `gen_categorys` where IS_DELETED=0 ";
                    $result1 = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result1)):
                        ?>
                        <option value="<?=$row['CATEGORY_NO']?>" <?php if($result['CATEGORY_NO'] == $row['CATEGORY_NO'])  echo 'selected'; ?>><?=$row['CATEGORY_NAME']?></option>
                    <?php endwhile;?>
                </select>
            </div>

        </div>
        <div class="form-group ">
            <label for="SUBCATEGORY_NO" class="control-label col-lg-3">Sub Category Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="SUBCATEGORY_NAME" type="text" value="<?=$result['SUBCATEGORY_NAME']?>"  />
            </div>

        </div>
        <div class="form-group ">
            <label for="SUB_CATEGORY_IMAGE" class="control-label col-lg-3">Category Image </label>
            <div class="col-lg-5">
                <input type="file"  name="SUB_CATEGORY_IMAGE" id="" value="<?=$result['SUB_CATEGORY_IMAGE']?>">
                <img src="upload/<?=$result['SUB_CATEGORY_IMAGE']?>" height="80" width="60"/> 
            </div>
           <div>
                <input type="hidden" name="SUB_CATEGORY_IMAGE" value="<?=$result['SUB_CATEGORY_IMAGE']?>" />
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
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>

        </div>

        <div class="form-group ">
            <label for="CATEGORY_NO" class="control-label col-lg-3">Category </label>
            <div class="col-lg-5">
                <select class="form-control" name="CATEGORY_NO" id="CATEGORY_NO" required="">
                    <option value="-1">--Select Category--</option>
                    <?php
                    $sql = "SELECT * FROM `gen_categorys` where IS_DELETED=0 ";
                    $result1 = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result1)):
                        ?>
                        <option value="<?=$row['CATEGORY_NO']?>"><?=$row['CATEGORY_NAME']?></option>
                    <?php endwhile;?>
                </select>
                <P class="error_message" id="CATEGORY_ERROR"></P>
            </div>

        </div>


        <div class="form-group ">
            <label for="SUBCATEGORY_NAME" class="control-label col-lg-3">Sub Category Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="SUBCATEGORY_NAME" name="SUBCATEGORY_NAME" type="text"  required="" />
                <P class="error_message" id="SUBCATEGORY_ERROR"></P>
            </div>

        </div>
        <div class="form-group ">
            <label for="SUB_CATEGORY_IMAGE" class="control-label col-lg-3">Category Image </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="SUB_CATEGORY_IMAGE" type="file" />
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


$sql = "SELECT * FROM $tbl_name LEFT JOIN `gen_categorys` ON `gen_categorys`.`CATEGORY_NO`=$tbl_name.`CATEGORY_NO`  WHERE $tbl_name.`IS_DELETED` = 0  ";
$result = mysqli_query($con,$sql);


?>

    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>
            <th><center>Sl</center></th>
            <th><center>Category</center></th>
            <th><center>Sub Category Name</center></th>
             <th><center>Sub Category Image</center></th>
            <th><center>Action</center></th>
        </tr>
        <?php $i=1; while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td><center><?=$i++?></center></td>
                <td><?=$row['CATEGORY_NAME']?></td>
                <td><?=$row['SUBCATEGORY_NAME']?></td>
                <td><a class="" target="_blank" href="upload/<?=$row['SUB_CATEGORY_IMAGE']?>" title="Click to view full image"><img src="upload/<?=$row['SUB_CATEGORY_IMAGE']?>" height="70px" width="60px"></a></td>
                <td>
                    <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['SUBCATEGORY_NO']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['SUBCATEGORY_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center>
                </td>
            </tr>
        <?php endwhile;?>
    </table>

<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function() {
    $("#btnAdd").on("click",function() {
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
        $("#SUBCATEGORY_NAME").attr("class","form-control");
       
        var SUBCATEGORY_NAME = $("#SUBCATEGORY_NAME").val().trim();
        if(SUBCATEGORY_NAME == "") {
            $("#SUBCATEGORY_ERROR").text("Subcategory is required");
            $("#SUBCATEGORY_NAME").attr("class","form-control error_input");
            $("#SUBCATEGORY_NAME").focus();
            return false;
        }

       
    });
});

</script>