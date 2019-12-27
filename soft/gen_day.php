<?php include 'include/header.php';?>
<?php $table_heading = "Day Setup";?>
<?php include 'include/sidebar.php';?>
<?php include 'include/body-top.php';?>
<?php
$tbl_name="gen_days";        //your table name
$targetpage = "gen_day.php";  
 $user_no =$_SESSION['user']['user_no'];//your file name  (the name of this file)
//$user_no =$_SESSION['user']['USER_NO'];
$CURR_TIME = date('Y-m-d H:i:s');
$mgs = '';
if(isset($_GET['delete']))
{
    $ID = $_GET['delete'];
    $sql = "UPDATE $tbl_name SET `IS_DELETED` = 1 ,`DELETED_BY` = '$user_no', `DELETED_ON` = '$CURR_TIME' WHERE DAY_NO = $ID";
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
    $DAY_NAME = trim($_POST['DAY_NAME']);
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `DAY_NAME` = '$DAY_NAME'  ";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):

        $sql = "INSERT INTO $tbl_name ( `DAY_NAME` , `CREATED_BY` , `CREATED_ON`) VALUES(  '$DAY_NAME','$user_no', '$CURR_TIME')";
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
    $DAY_NAME = trim($_POST['DAY_NAME']);
    $DAY_NO = $_POST['DAY_NO'];
    $SQL = "SELECT * FROM $tbl_name WHERE `IS_DELETED` = 0 AND `DAY_NAME` = '$DAY_NAME'  AND `DAY_NO` != '$DAY_NO'";
    $COUNT = mysqli_num_rows(mysqli_query($con,$SQL));
    if($COUNT < 1):

        $sql = "UPDATE $tbl_name SET   `DAY_NAME` = '$DAY_NAME' , `IS_UPDATED` = 1, `UPDATED_BY` = '$user_no' ,`UPDATED_ON` = '$CURR_TIME'  WHERE DAY_NO = $DAY_NO";
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
    $sql = "SELECT * FROM $tbl_name WHERE `DAY_NO` = '$id' ";
    $result = mysqli_fetch_array(mysqli_query($con,$sql));
    ?>
    <form class="cmxform form-horizontal " id="signupForm" method="post" enctype="multipart/form-data" >
        <div class="form-group " <?php if($mgs=='')echo "style='display:none;'" ?>>
            <div class=" col-md-6 col-md-offset-2 <?=$class?>"><a href="#" class="close" data-dismiss="alert" aria-label="close">x</a><?=$mgs?></div>
            <div>
                <input type="hidden" name="DAY_NO" value="<?=$result['DAY_NO']?>" />
            </div>
        </div>

        <div class="form-group ">
            <label for="FACULTY_NAME" class="control-label col-lg-3">Faculty Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="" name="DAY_NAME" type="text" value="<?=$result['DAY_NAME']?>" required />
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
            <label for="DAY_NAME" class="control-label col-lg-3">Day Name </label>
            <div class="col-lg-5">
                <input class=" form-control" id="DAY_NAME" name="DAY_NAME" type="text"  required />
                <P class="error_message" id="DAY_ERROR"></P>
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
            <th><center>Day Name</center></th>
            <th><center>Action</center></th>
        </tr>
        <?php $i=1; while($row = mysqli_fetch_array($result)):?>
            <tr>
                <td><center><?=$i++?></center></td>
                <td><?=$row['DAY_NAME']?></td>
                <td>
                    <center> <a onclick="return confirm('Are you Sure Want to Edit?');" href="<?=$targetpage.'?edit='.$row['DAY_NO']?>" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a onclick="return confirm('Are you Sure Want to Delete?');" href="<?=$targetpage.'?delete='.$row['DAY_NO']?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></center>
                </td>
            </tr>
        <?php endwhile;?>
    </table>

<?php include 'include/footer.php';?>
<script type="text/javascript">
    $(document).ready(function() {
     $("#btnAdd").on("click",function() {
        $("#DAY_ERROR").html("");
        $("#DAY_NAME").attr("class","form-control");
       
        var DAY_NAME = $("#DAY_NAME").val().trim();
        if(DAY_NAME == "") {
            $("#DAY_ERROR").text("Day is required");
            $("#DAY_NAME").attr("class","form-control error_input");
            $("#DAY_NAME").focus();
            return false;
        }

        
        
    });
});

</script>