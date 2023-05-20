<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM cafedras WHERE FacultyID = "'.$_POST["FacultyID"].'"';
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	?><option selected="selected">---</option><?php
    while($row = mysqli_fetch_array($result)){
        $output .= "<option value=" . $row['cafedraID'] . ">" . $row['cafedraNameKZ'] . "</option>";
    } 
	echo $output; 	
?>