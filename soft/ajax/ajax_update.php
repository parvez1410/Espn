<?php
    session_start();
    include '../../config/db_connection.php';
    $user_no = 1;//$_SESSION['user']['USER_NO'];
	$CURR_TIME = date('Y-m-d H:i:s'); 
	$table_name = $_POST['table_name'];
	$fileds = $_POST['fileds'];
	$values = $_POST['values'];
	$fileds  = explode(",", $fileds);
	$values  = explode(",", $values);
	$id_name = $_POST['id_name'];
	$id_value = $_POST['id_value'];
	$i = 0;
	$params = "";
	foreach ($fileds as $filed) {
		$params .=" $filed = '".mysqli_real_escape_string($con,$values[$i])."',";
		$i++;
	}
	$params = substr($params, 0,-1);
	$sql = "UPDATE $table_name SET $params, IS_UPDATED = 1, UPDATED_BY = $user_no, UPDATED_ON = '$CURR_TIME' WHERE $id_name = '$id_value'";
    echo $query = mysqli_query($con,$sql);
?>