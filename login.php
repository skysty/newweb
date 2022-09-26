<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Логин беті</title>
	<link rel = "stylesheet" type = "text/css" href = "css/style.css">
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<script>
		history.pushState(null, null, location.href);
		window.onpopstate = function(event) {
			history.go(1);
		};
	</script>
	<style>
		input[type=text],input[type=password]{
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type=submit] {
			width: 150px;
			background-color: #003366;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: 1px black solid;
			cursor: pointer;
		}

		input[type=submit]:hover {
			background-color: #000;
		}
		
		.login_form{
			margin: 0 auto;
			margin-top: 50px;
			width: 450px;
			padding: 30px;
			background: #eee;
			border: 1px black solid;
		}
		.login_inner{
			margin: 0 auto;
			width: 300px;
		}
		
		.footer{
			margin-top: 100px;
		}
	</style>
		<?php
			include('incs/connect.php');
		?>
</head>
<body>
	<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;padding-top: 30px;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
	<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
	<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">Қош келдіңіз!!!</p>
	<p style = "font-size: 24px; text-align: center; color: ##06ADD2 ; font-weight: bold;"> <a href="mailto:yerbolat.tursynbek@ayu.edu.kz">Жаңадан келген болсаңыз немесе ip базада жоқ болсаңыз yerbolat.tursynbek@ayu.edu.kz  толық кафедра ОПҚ тізімін microsoft excel  файлына жазып жіберіңіз</a></p> 
	<div class = "content">
		<div class = "login_form">
			<div class = "login_inner">
			
				<img src = "img/login_logo.png" style = "width: 200px; margin-left: 50px;">
				<form action = "doLogin.php" method = "post">
					<table>
						<tr>
							<td><strong>Логин</strong></td><td><input type = "text" name = "login" value = "" placeholder = "Логинді теріңіз"></td>
						</tr>
						<tr>
							<td><strong>Құпия сөз</strong></td><td><input type = "password" name = "password" placeholder = "Құпия сөзді теріңіз"></td>
						</tr>
						<tr>
							<td></td><td><input type = "submit" name = "submit_login" value = "Кіру"></td>
						</tr>
                                                <tr>
							<td></td><td><a href="mail/index.php"><br>Құпия сөзді ұмыттым?</br></a></td>
						</tr>                                               

					</table>
				</form>
			</div>
		</div>
		<p style = "font-size: 24px; text-align: center; color: ##06ADD2 ; font-weight: bold;"> <a href="mailto:yerbolat.tursynbek@ayu.edu.kz">Сайтқа қатысты сұрақтар болса</a> </p>                           
	<div class = "footer">
	</div>
</body>
</html>