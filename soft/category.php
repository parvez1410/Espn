<?php include 'include/header.php';?>
<?php $table_heading = "Category";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$tbl_name="gen_categorys";        //your table name
$targetpage = "category.php";  //your file name  (the name of this file)
$user_no =$_SESSION['user']['user_no'];
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_GET['delete']))
{
    $ID = $_GET['delete'];
    $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1 ,`DELETED_BY` = '$user_no', `DELETED_ON` = '$CURR_TIME' WHERE CATEGORY_NO = $ID";
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
    $CATEGORY_NAME = trim($_POST['CATEGORY_NAME']);
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `CATEGORY_NAME` = '$CATEGORY_NAME'  ";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        if ($_FILES["CATEGORY_IMAGE"]["error"] > 0) {
            $CATEGORY_IMAGE = "No.png";
            
        } else {
            $CATEGORY_IMAGE = time().$_FILES["CATEGORY_IMAGE"]["name"];
            move_uploaded_file($_FILES["CATEGORY_IMAGE"]["tmp_name"],"upload/" . $CATEGORY_IMAGE);
        }
        $sql = "INSERT INTO $tbl_name ( `CATEGORY_NAME` ,`CATEGORY_IMAGE`, `CREATED_BY` , `CREATED_ON`) VALUES(  '$CATEGORY_NAME','$CATEGORY_IMAGE','$user_no', '$CURR_TIME')";
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
    $CATEGORY_NAME = trim($_POST['CATEGORY_NAME']);
    $CATEGORY_NO = $_POST['CATEGORY_NO'];
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `CATEGORY_NAME` = '$CATEGORY_NAME'  AND `CATEGORY_NO` != '$CATEGORY_NO'";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):
        if ($_FILES["CATEGORY_IMAGE"]["error"] > 0) {
            $CATEGORY_IMAGE =$_POST['CATEGORY_IMAGE'];
            
        } else {
            $CATEGORY_IMAGE = time().$_FILES["CATEGORY_IMAGE"]["name"];
            move_uploaded_file($_FILES["CATEGORY_IMAGE"]["tmp_name"],"upload/" . $CATEGORY_IMAGE);
        }
        $sql = "UPDATE $tbl_name SET   `CATEGORY_NAME` = '$CATEGORY_NAME' , `CATEGORY_IMAGE` = '$CATEGORY_IMAGE' , `IS_UPDATED` = 1, `UPDATED_BY` = '$user_no' ,`UPDATED_ON` = '$CURR_TIME'  WHERE CATEGORY_NO = $CATEGORY_NO";
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
    $sql = "SELECT * FROM $tbl_name WHERE `CATEGORY_NO` = '$id' ";
    $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
    <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="CATEGORY_NO" value="<?=$result['CATEGORY_NO']?>" />
            </div>
        </div>

        <div class="form-group ">
            <label for="CATEGORY_NAME" class="control-label col-lg-3">Category Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="CATEGORY_NAME" type="text" value="<?=$result['CATEGORY_NAME']?>" required />
            </div>

        </div>
         <div class="form-group ">
            <label for="CATEGORY_IMAGE" class="control-label col-lg-3">Category Image </label>
            <div class="col-lg-5">
                <input type="file"  name="CATEGORY_IMAGE" id="" value="<?=$result['CATEGORY_IMAGE']?>">
                <img src="upload/<?=$result['CATEGORY_IMAGE']?>" height="80" width="60"/> 
            </div>
           <div>
                <input type="hidden" name="CATEGORY_IMAGE" value="<?=$result['CATEGORY_IMAGE']?>" />
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
            <label for="CATEGORY_NAME" class="control-label col-lg-3">Category Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="CATEGORY_NAME" name="CATEGORY_NAME" type="text"  required />
                <P class="error_message" id="CATEGORY_ERROR"></P>
            </div>

        </div>
        <div class="form-group ">
            <label for="CATEGORY_IMAGE" class="control-label col-lg-3">Category Image </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="CATEGORY_IMAGE" type="file" />

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

$sql = "SELECT * FROM $tbl_name  WHERE $tbl_name.`IS_DELETED` = 0 ";
$result = mysqli_query($con,$sql);

?>

    <table   class="table table-bordered table-hover table-responsive table-condensed table-striped dataTable col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
        <tr>
            <th><center>Sl</center></th>
            <th><center>Category Name</center></th>
            <th><center>Category Image</center></th>
            <th><center>Action</center></th>
        </tr>
        <?php $i=1; while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td><center><?=$i++?></center></td>
                <td><?=$row['CATEGORY_NAME']?></td>
                <td><a class="" target="_blank" href="upload/<?=$row['CATEGORY_IMAGE']?>" title="Click to view full image"><img src="upload/<?=$row['CATEGORY_IMAGE']?>" height="70px" width="60px"></a></td>
                <td>
                    <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['CATEGORY_NO']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['CATEGORY_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center>
                </td>
            </tr>
        <?php endwhile;?>
    </table>

<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function() {
    
    
    

    $("#btnAdd").on("click",function() {
        $("#CATEGORY_ERROR").html("");
        $("#CATEGORY_NAME").attr("class","form-control");
       
        var CATEGORY_NAME = $("#CATEGORY_NAME").val().trim();
        if(CATEGORY_NAME == "") {
            $("#CATEGORY_ERROR").text("Category is required");
            $("#CATEGORY_NAME").attr("class","form-control error_input");
            $("#CATEGORY_NAME").focus();
            return false;
        }

       
    });
});

</script>