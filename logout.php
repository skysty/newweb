﻿<?php
	include('incs/connect.php');
	
	session_start();
	session_destroy();
	header('Location: login.php');
?>