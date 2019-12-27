<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    	include '../../config/db_connection.php';
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT EMPLOYEE_REG_NO, DESIGNATION_NO FROM trn_employee_regs WHERE EMPLOYEE_ID = '$username' AND EMPLOYEE_PASSWORD = '$password' AND IS_DELETED = 0";
	$query = mysqli_query($con,$sql);
	if(mysqli_num_rows($query) > 0){
		$result = mysqli_fetch_array($query);
		echo json_encode($result);
	}else{
		echo json_encode(-1);
	}
?>