<?php
session_start();
include('config/db_connection.php');
$mgs = "";
if(isset($_POST['submit'])){  
	date_default_timezone_set('Asia/Dhaka');
	$currentTime = date('Y-m-d H:s:i');
	$user = trim($_POST['username']);
	$pass = trim($_POST['password']);
	$md5pass = md5($pass);
	$sql = "SELECT * FROM `xxx_user` WHERE `user_name` = '$user' AND `pass` = '$md5pass' AND `is_active` = 1 AND `active_from` <= '$currentTime' AND `active_to` >= '$currentTime'";
	$result = mysqli_query($con,$sql);
	$data = mysqli_fetch_assoc($result);
	//$user_no = $data['user_no'];
	//$URL = "http://localhost/shah_sports/admin";
	//$_SESSION['menu_all'] = menu($user_no,$URL,$con);
	if(!empty($data)){
		$_SESSION['user'] = $data;
		$date= date('Y-m-d');
		$_SESSION['login_time'] = $date;
			
		header('Location: soft/index.php');
		exit;
	}else{
		
		$mgs="Your Username or Password is not valid!";
	}
}
?>