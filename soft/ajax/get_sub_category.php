<?php
include('../../config/db_connection.php');
	$CATEGORY_NO = $_POST['CATEGORY_NO'];
	$sql="SELECT * FROM `gen_subcategorys` WHERE `IS_DELETED`=0 AND `CATEGORY_NO`='$CATEGORY_NO' ";
	$query = mysqli_query($con,$sql);
	$html = "";
	if(mysqli_num_rows($query) > 0){
	 	$html .="<select class='form-control' name='SUBCATEGORY_NO' id='SUBCATEGORY_NO'>";
	 	$html .="<option value='-1'>".'--Select One--'."</option>";
	    while($row = mysqli_fetch_array($query)):
	        $html .="<option value='".$row['SUBCATEGORY_NO']."'>".$row['SUBCATEGORY_NAME']."</option>";
	    endwhile;
	    $html .="</select>";  
	}
    echo $html;
?>