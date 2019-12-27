<?php
    session_start();
    include '../../config/db_connection.php';
	$table_name = $_POST['table_name'];
	//get pk from table
	$sql = "SHOW COLUMNS FROM $table_name";
	$query = mysqli_query($con,$sql);
	$result = mysqli_fetch_array($query);
	$PK = $result[0];

	$fileds = $_POST['fileds'];
	$data_fields = $PK.",".$_POST['fileds'];
	$values = $_POST['values'];
	$fileds  = explode(",", $fileds);
	$values  = explode(",", $values);
	$i = 0;
	$params = "";
	foreach ($fileds as $filed) {
		$value = mysqli_real_escape_string($con,$values[$i]);
		$params .=" AND ($filed = '".$value."' OR '".$value."' = '')";
		$i++;
	}
	$sql = "SELECT * FROM $table_name WHERE IS_DELETED = 0 $params ORDER BY $PK DESC LIMIT 0,100";
    $query = mysqli_query($con,$sql);
    $html="";
    $i=1;
    while($row = mysqli_fetch_array($query)):
    	$html.="<tr>";
		$html.="<td>".$i++."</td>";
		$field_values = $row[0];
    	foreach ($fileds as $field) {
    		$filed_name = $field;
    		$field_value = $row[$field];
    		$html.="<td>".$field_value."</td>";
    		$field_values .= ",".$field_value;
    	}
    	$html.="<td><a class='btn btn-success data_edit' data_fields = '".$data_fields."' field_values = '".$field_values."'>Edit</a> <a class='btn btn-danger data_remove' id_name='".$PK."' id_value = $row[0]>Remove</a></td>";
    	$html.="</tr>";
	endwhile;
	echo $html;
?>