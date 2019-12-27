<?php
	session_start();
	include '../../config/db_connection.php';
	$CREATED_BY = $_SESSION['user']['user_no'];
	$CREATED_ON = date("Y-m-d h:i:s");
	$PACKAGE_NAME =$_POST['PACKAGE_NAME'];
	$PACKAGE_CODE =$_POST['PACKAGE_CODE'];
	$PACKAGE_RATE = $_POST['PACKAGE_RATE'];
	$PACKAGE_BENEFIT = $_POST['PACKAGE_BENEFIT'];
	
	 $sql = "INSERT INTO `gen_packagemasters` SET `PACKAGE_NAME` = '$PACKAGE_NAME', `PACKAGE_RATE` = '$PACKAGE_RATE',`PACKAGE_CODE` = '$PACKAGE_CODE', `PACKAGE_BENEFIT` = '$PACKAGE_BENEFIT', `CREATED_BY` = '$CREATED_BY', `CREATED_ON` = '$CREATED_ON'";
	$query = mysqli_query($con,$sql);
	
	$PACKAGEMASTER_NO = mysqli_insert_id($con);
	//
	$item_no_list = $_POST['item_no_list'];
	$item_no_list = explode(",",$item_no_list);

	$item_unit_list = $_POST['item_unit_list'];
	$item_unit_list = explode(",",$item_unit_list);

	$item_rate_list = $_POST['item_rate_list'];
	$item_rate_list = explode(",",$item_rate_list);
	$row_count = count($item_no_list);
	for ($i=0;$i<$row_count;$i++) {
		$ITEM_NO = $item_no_list[$i];
		$ITEM_UNIT = $item_unit_list[$i];
		$ITEM_RATE = $item_rate_list[$i];
	 $sql = "INSERT INTO `gen_packagedtls` SET `PACKAGEMASTER_NO` = '$PACKAGEMASTER_NO', `ITEM_NO` = '$ITEM_NO', `ITEM_UNIT` = '$ITEM_UNIT',  `ITEM_RATE` = '$ITEM_RATE', `CREATED_BY` = '$CREATED_BY', `CREATED_ON` = '$CREATED_ON'";
		$query = mysqli_query($con,$sql);
	}
	echo $query;
?>