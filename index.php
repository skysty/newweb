<?php
	include('incs/connect.php');
	
	session_start();
	$_SESSION['tutor'];
	
	if(!isset($_SESSION['tutor'])){
		header('Location: login.php');
	} else {
		if($_SESSION['roleID'] == 1){
			header('Location: tutor/index.php');
		} else if($_SESSION['roleID'] == 2){
			header('Location: admin/index.php');
		} if($_SESSION['roleID'] == 3){
			header('Location: moderator/index.php');
		} else {
			echo "error in session roles";
		}
	}	
?>