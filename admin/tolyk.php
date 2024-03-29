<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		session_start();
		$_SESSION['tutor'];
		include('../incs/connect.php');
		
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
		//$query = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[user]'") or die(mysql_error());
		//$main_me = mysql_fetch_array($query);
	?>
	<title>Еңбектерді растау</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		.engbek{
			width: 900px;
			padding: 20px;
			margin: 0 auto;
			margin-bottom: 100px;
			border: black solid 1px;
		}
		.engbek select{
			padding: 5px;
		}
		.engbek	table {
			width: 100%;
			font-size: 14px;
			border: black solid 1px;
		}

		.engbek th td {
			text-align: left;
			padding: 6px;
			border: 0px white solid;
		}
		.to_back:hover{
			background: gray;
		}
		input[type=text],input[type=password],input[type=date]{
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		input[type=number]{
			width: 200px;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}
		.select_box{
			width: 1000px;
			padding: 20px;
			margin: 0 auto;
			margin-top: 30px;
			margin-bottom: 30px;
			border: 1px black solid;
			background: #ddd;
		}
		.btn {
			  background: #3498db;
			  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
			  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
			  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
			  background-image: -o-linear-gradient(top, #3498db, #2980b9);
			  background-image: linear-gradient(to bottom, #3498db, #2980b9);
			  font-family: Arial;
			  color: #ffffff;
			  font-size: 20px;
			  padding: 10px 20px 10px 20px;
			  text-decoration: none;
			}

			.btn:hover {
			  background: #3cb0fd;
			  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
			  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
			  text-decoration: none;
			}
			.btn:focus {
				background: #3cb0fd;
			}
			select{
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
				margin-top: 100px;
				width: 300px;
				padding: 20px;
				border: 1px black solid;				
			}
			
			.footer{
				margin-top: 100px;
			}
			.works{
				margin: 0 auto;
				width: 1045px;
			}
			.works table {
							border-collapse: collapse;
							border:1px black solid;
							width: 100%;
							font-size: 12px;
						}

						.works th, td {
							text-align: left;
							padding: 6px;
							border:1px black solid;
						}

						.works th {
							background-color: #003366;
							color: white;
						}
	</style>
</head>
<body>
	<div class = "upper_header">
		<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
		<div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">		
<?php
$result= mysqli_query($connection,"SELECT text_jildar FROM jildar WHERE id_jildar= '1'");
while($row = mysqli_fetch_array($result)){
echo $row['text_jildar'];
 }
?>
</div></br>	</div>		
	<div class = "header">
	<div id = "menu_nav">
		<nav id="primary_nav_wrap">
			<ul>
			  <li><a href="index.php">Негізгі</a>
				<ul>
				  <li><a href="index.php">Негізгі бет</a></li>				  
				</ul>
			  </li>
			  
			  <li><a href="#">Орындау</a>
				<ul>
				  <li><a href="engbek_jukteu.php">ОПҚ/ҒҚ</a></li>
				</ul>
			  </li>
			  <li><a href="#">Басқа</a>
				<ul>
				  <li><a href="baska_okitushyny_koru.php">ОПҚ/ҒҚ</a></li>
				</ul>
			  </li>
			  
			  <li><a href="#">Сенім жәшігі</a>
				<ul>
				  <li><a href="shagym_tusiru.php">Шағым түсіру</a></li>
				  <li><a href="shagymdar.php">Шағымдарды көру</a></li>
				</ul>
			  </li>
			  <li><a href="../logout.php">Шығу</a></li>
			</ul>
		</nav>
	</div>
	</div>
	<div class = "content">
		<div class = "content_wrapper" style = "width: 100%; margin: 0 auto; margin-top: 10px;">
		
			<?php
			
				$_SESSION['tutor'];
				$sql = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysql_error());
				$result = mysqli_fetch_array($sql);
				
				$sql2 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_val, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, tutors.TutorID, tutors.lastname, tutors.firstname, tutors.patronymic, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, status.status_name, kaytaru_sebebi.sebepter
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE TutorID = '$_GET[ID]'") or die(mysqli_error());
				
			/*	$sql2 = "SELECT engbekter.ball, SUM(engbekter.ball) AS sum_val, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ
				FROM engbekter 
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm 
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
				INNER JOIN status ON status.statusID = engbekter.kod_stat 
				WHERE kod_kizm = '$tutor_id'"; */
				
				$engbek = mysqli_fetch_array($sql2);
				
				$sql3 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball)*0.50 AS sum_gylym, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, tutors.TutorID, tutors.lastname, tutors.firstname, tutors.patronymic, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, status.status_name, kaytaru_sebebi.sebepter, korsetkishter.typeID
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 1") or die(mysqli_error($connection));
				
				$engbek2 = mysqli_fetch_array($sql3);
				
				$sql4 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball)*0.35 AS sum_oku, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, tutors.TutorID, tutors.lastname, tutors.firstname, tutors.patronymic, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, status.status_name, kaytaru_sebebi.sebepter, korsetkishter.typeID
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 2") or die(mysql_error());
				
				$engbek3 = mysqli_fetch_array($sql4);
				
				$sql5 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball)*0.15 AS sum_tarbie, engbekter.file_ati, engbekter.sani, engbekter.univ_avtor_san, engbekter.eskertu, engbekter.ball, tutors.TutorID, tutors.lastname, tutors.firstname, tutors.patronymic, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, status.status_name, kaytaru_sebebi.sebepter, korsetkishter.typeID
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE TutorID = '$_GET[ID]' AND korsetkishter.typeID = 3") or die(mysqli_error($connection));
				
				$engbek4 = mysqli_fetch_array($sql5);
				/*type4*/
				$sql6 = mysqli_query($connection,"SELECT engbekter.engbekID, SUM(engbekter.ball) AS sum_baska, engbekter.file_ati, engbekter.sani, engbekter.eskertu, engbekter.ball, tutors.TutorID, tutors.lastname, tutors.firstname, tutors.patronymic, faculties.facultyNameKZ, cafedras.cafedraNameKZ, korsetkishter.korsetkish_ati, status.status_name, kaytaru_sebebi.sebepter, korsetkishter.typeID
				FROM engbekter
				INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
				INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul
				INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra
				INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
				INNER JOIN status ON status.statusID = engbekter.kod_stat
				INNER JOIN kaytaru_sebebi ON kaytaru_sebebi.kod_kayt_sebeb = engbekter.kod_kayt_sebeb
				WHERE TutorID = '$_GET[ID]' AND engbekter.kod_korset=129 ") or die(mysqli_error($connection));
				
				$engbek5 = mysqli_fetch_array($sql6);
				$a = array($engbek4['sum_tarbie'],$engbek2['sum_gylym'],$engbek3['sum_oku'],$engbek5['sum_baska']);
				$univ = array_sum($a);
			?>
			
			<h2 align = "center">Оқытушы: <?php echo " " . $engbek['lastname'] . " ". $engbek['firstname'] . " ". $engbek['patronymic'];?> рейтингі жайлы жалпы мәлімет</h2>
			
			<div class = "engbek">
				<form action = "confirmation.php" method = "post">
					<table style = "font-size: 19px;">
						<tr>
							<td><span><strong>Факультет/ҒЗО:</strong></td><td><?php echo $engbek['facultyNameKZ']; ?></span></td>
						</tr>
							<td><span><strong>Кафедра/ҒЗИ:</strong></td><td><?php echo $engbek['cafedraNameKZ']; ?></span></td>
						</tr>
						<tr>
							<td><span><strong>Аты-жөні:</strong></td><td><?php echo $engbek['lastname'] . " " . $engbek['firstname'] . " " . $engbek['patronymic']; ?></span> </td>
						</tr>						
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
						<tr>
							<td><strong>Ғылым бағыты:</strong></td><td><?php echo sprintf("%.2f",$engbek2['sum_gylym']); ?></td>
						</tr>
						<tr>
							<td><strong>Академиялық бағыты:</strong></td><td><?php echo sprintf("%.2f",$engbek3['sum_oku']); ?></td>
						</tr>
						<tr>
							<td><strong>Әлеуметтік-мәдени бағыты:</strong></td><td><?php echo sprintf("%.2f",$engbek4['sum_tarbie']); ?></td>
						</tr>
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
						<tr>
							<td><strong>Жалпы балл:</strong></td><td><?php echo sprintf("%.2f",$univ); ?></td>
						</tr>
						<tr>
							<td><hr/></td><td><hr /></td>
						</tr>
					</table>
				</form>
			</div>
			<div class = "works">
					<?php
						
						$sql = "SELECT engbekter.ball, engbekter.engbekID, tutors.firstname, tutors.lastname, tutors.patronymic, korsetkishter.korsetkish_ati, 	engbekter.sani, engbekter.univ_avtor_san, engbekter.file_ati, engbekter.kayt_sebeb, engbekter.eskertu, status.status_name, faculties.FacultyID, status.statusID, cafedras.cafedraNameKZ, faculties.facultyNameKZ,  cafedras.CafedraID, tutors.roleID, tutors.TutorID
						FROM engbekter 
						INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
						INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
						INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
						INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
						INNER JOIN status ON status.statusID = engbekter.kod_stat 
						WHERE tutors.TutorID = '$_GET[ID]' ORDER BY engbekter.engbekID DESC";
						
						$result = mysqli_query($connection,$sql) or die(mysqli_error());
						
						echo "<table><tr><th>№</th><th>Кафедра/ҒЗИ</th><th>Аты жөні</th><th>Көрсеткіш</th><th>Саны</th><th>Автор саны</th><th>Файл аты</th><th>Балл</th><th>Қайтару себебі</th><th>Статус</th></tr>";
						
						$i = 1;
						
						while($row = mysqli_fetch_array($result)){
							echo "<tr><td>".$i."</td><td>".$row["cafedraNameKZ"]."</td><td>".$row["lastname"]." ".$row["firstname"]."</td><td>".$row["korsetkish_ati"]."</td><td>".$row["sani"]."</td><td>".$row["univ_avtor_san"]."</td><td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td><td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$row["status_name"]."</td></tr>";
							$i++;
						}
						
						echo "</table>";    	
					?>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>
</body>
</html>