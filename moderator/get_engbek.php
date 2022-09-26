<?php
	include('../incs/connect.php');
	
	$output = '';
	
	$sql = 'SELECT * FROM engbekter WHERE kod_kizm = "'.$_POST["TutorID"].'"';
	
	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
	
    while($row = mysqli_fetch_array($result)){
        $output .= "<option value=" . $row['engbekID'] . ">" . $row['file_ati'] . "</option>";
    } 
	echo $output; 	
?>