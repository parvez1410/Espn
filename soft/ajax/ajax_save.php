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
	$i = 0;
	$params = "";
	foreach ($fileds as $filed) {
		$params .=" $filed = '".mysqli_real_escape_string($con,$values[$i])."',";
		$i++;
	}
	$params = substr($params, 0,-1);
	$sql = "INSERT INTO $table_name SET $params, CREATED_BY = $user_no, CREATED_ON = '$CURR_TIME'";
    echo $query = mysqli_query($con,$sql);
?>