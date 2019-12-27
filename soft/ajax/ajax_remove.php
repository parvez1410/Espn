<?php
    session_start();
    include '../../config/db_connection.php';
    $user_no = 1;//$_SESSION['user']['USER_NO'];
	$CURR_TIME = date('Y-m-d H:i:s'); 
	$table_name = $_POST['table_name'];
	$id_name = $_POST['id_name'];
	$id_value = $_POST['id_value'];
	echo $sql = "UPDATE $table_name SET IS_DELETED = 1, DELETED_BY = $user_no, DELETED_ON = '$CURR_TIME' WHERE $id_name = '$id_value'";
    echo $query = mysqli_query($con,$sql);
?>