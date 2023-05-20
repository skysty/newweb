<?php

	include('../incs/connect.php');

	

	$output = '';

	

	$sql = 'SELECT * FROM tutors WHERE deleted=0 AND cafedraID = "'.$_POST["cafedraID"].'"';

	

	$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));

	?><option selected="selected">---</option><?php

    while($row = mysqli_fetch_array($result)){

        $output .= "<option value=" . $row['TutorID'] . ">" . $row['lastname'] ." ". $row['firstname'] ." ". $row['patronymic'] ."</option>";

    } 

	echo $output; 	

?>