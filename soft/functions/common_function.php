<?php
		function showEmployees($con,$EMPLOYEES){
		 $sql = "SELECT `EMPLOYEE_NAME` FROM `trn_employee_regs` WHERE `EMPLOYEE_REG_NO` IN ($EMPLOYEES)";
		$query = mysqli_query($con,$sql);
		$result="";
		while($row = mysqli_fetch_array($query)):
			$result.=", ".$row['EMPLOYEE_NAME'];
		endwhile;
		return substr($result, 1);
	}
?>