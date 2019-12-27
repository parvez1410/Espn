<?php
include('../../config/db_connection.php');
	$ZONE_NO = $_POST['ZONE_NO'];
	 $sql="SELECT * FROM `gen_bits` WHERE `IS_DELETED`=0 AND `ZONE_NO`='$ZONE_NO' ";
	$query = mysqli_query($con,$sql);
	$html = "";
	if(mysqli_num_rows($query) > 0){
	 	$html .="<select class='form-control' name='BIT_NO' id='BIT_NO'>";
	 	$html .="<option value='-1'>".'--Select Root--'."</option>";
	    while($row = mysqli_fetch_array($query)):
	        $html .="<option value='".$row['BIT_NO']."'>".$row['BIT_CODE']."</option>";
	    endwhile;
	    $html .="</select>";  
	}
    echo $html;
?>