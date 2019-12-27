<?php
include('../../config/db_connection.php');
	$ITEM_NO = $_POST['ITEM_NO'];
	$sql="SELECT * FROM `gen_items`  WHERE  `ITEM_NO`='$ITEM_NO' AND IS_DELETED=0";
	$query = mysqli_query($con,$sql);
	$result=mysqli_fetch_array($query);
	$item_details['ITEM_UNIT'] = $result['ITEM_UNIT'];
	$item_details['ITEM_RATE'] = $result['ITEM_RATE'];
	echo json_encode($item_details);
?>