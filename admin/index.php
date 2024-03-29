<html>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<head>

	<?php

		include('../incs/connect.php');

		

		session_start();

		$_SESSION['tutor'];		

		

		if(!isset($_SESSION['tutor'])){

			header('Location: ../login.php');

		}

	?>

	<title>Басты бет</title>

	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">

	<script type = "text/javascript" src = "../dataTables/jquery-3.5.1.js"></script>

	<link rel = "stylesheet" type = "text/css" href = "../dataTables/jquery.dataTables.min.css">

	<script type = "text/javascript" src = "../dataTables/jquery.dataTables.min.js"></script> 

    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  

    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

	<script type = "text/javascript" src = "../js/functions.js"></script>

	<script type = "text/javascript" src = "../chartjs/js/chart.min.js"></script>

	<script type = "text/javascript" src = "../chartjs/js/app.js"></script>

	<link rel="icon" type="image/png" href="../img/favicon.png" />

	<style>

		.content_wrapper{

			width: 1050px;

			margin: 0 auto;

		}

		.tutors_table{

			margin: 10px;

			width: 500px;

			float:left;

		}

		.univer_table{

			margin: 10px;

			width: 500px;

			float:left;

		}

		.faculty_table{

			margin: 10px;

			width: 500px;

			float:left;

		}

		.cafedra_table{

			margin: 10px;

			width: 500px;

			float:left;

		}

		table {

			border-collapse: collapse;

			border:1px black solid;

			width: 100%;

			font-size: 12px;

		}

		a{

			color: blue;

			text-decoration:none;

		}

		a:hover{

			color: red;

			text-decoration:underline;

		}



		th, td {

			text-align: left;

			padding: 6px;

			border:1px black solid;

		}



		tr:nth-child(even){background-color: #f2f2f2}



		th {

			background-color: #003366;

			color: white;

		}

		#chart_container{

			width: 900px;

			padding: 50px;

			height: 400px;

			margin: 0 auto;

			border: 2px #049eff solid;

		}

	</style>

</head>

<body>

	<div class = "upper_header">

		<img src = "../img/login_logo.png" style = "width: 175px; float:left;">

		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>

		<p style = "font-size: 24px; text-align: center; color: #db261b; font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>

	</div><br />

	<div class = "header">	

	<div id = "menu_nav">
		<?php include '../extensions/nav.php'; ?>
	</div>

	</div>

	<div class = "content">

		<div class = "content_wrapper" style = "margin-top: 5px;">					

			<?php

				$Login=$_SESSION['tutor'];

				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$Login'") or die(mysqli_error());

				$tut = mysqli_fetch_array($query);

				echo "<h2 style = 'color:#0094aa'>Оқытушы: " . $tut['lastname'] ." ". $tut['firstname'] ." ". $tut['patronymic'] . "</h2>";

				?>

			<hr />		



            <h1 style = "text-align: center; color: red">Ағымдағы рейтинг 2022-2023</h1><hr />

			<h2 align = 'center' style = "color: #0094de">Факультеттер рейтингі</h2>

			<div id = "chart_container">

				<canvas id = "mycanvas"></canvas>

			</div>	

			

			

			<div class = 'tutors_table'><h3 align = 'center' style = "color: #0094de">Оқытушы-профессорлар және ғылыми қызметкерлер рейтингі</h3>

				<?php

					$sql1 = mysqli_query($connection, "SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_val

					FROM (SELECT

						  tutors.TutorID,

						  tutors.RATE, 

						  tutors.job_titleID,

						  tutors.lastname, 

						  engbekter.kod_kizm,

						  tutors.firstname,

					  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,

					  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,

					  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,

					  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4

					FROM engbekter

					Left JOIN tutors ON tutors.TutorID = engbekter.kod_kizm

					LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset

					WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3)

					GROUP BY tutors.lastname, tutors.firstname) AS T1 ORDER by sum_val DESC") or die(mysqli_error($connection));

					

					$sql_tuts = mysqli_query($connection, "SELECT 

					tutors.RATE,

					 tutors.job_titleID, 

					 tutors.lastname, 

					 tutors.TutorID, 

					 engbekter.kod_kizm, 

					 tutors.firstname, 

					 SUM(engbekter.ball) AS sum_val FROM engbekter 

					RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm

					WHERE tutors.deleted=0 AND tutors.RATE IN(1,2,3) AND engbekter.kod_kizm IS NULL

					GROUP BY tutors.lastname, tutors.firstname ORDER BY sum_val DESC") or die(mysqli_error($connection));

					?>

					<button onclick="HtmlTOExcel('xlsx')">Экспорт EXCEL</button>

					<table  id="univ_data" class="table table-striped table-bordered" border="1">

						<thead>

							<tr>

								<th>№</th>

								<th>Аты жөні</th>

								<th style="display: none;">Ғылым бағыты</th>

								<th style="display: none;">Академиялық бағыт</th>

								<th style="display: none;">Әлеуметтік-мәдени бағыт</th>

								<th style="display: none;">Қосылып алынған балл</th>

								<th>Жалпы балл</th>

								<th>Толық көру</th>

							</tr>

						<thead>

				<?php



					$i = 0;

					

					while($tutor = mysqli_fetch_array($sql1))

					{

						$i++;

						$sum_val = sprintf("%.2f", $tutor['sum_val']);

						echo "

						    <tbody>

							<tr>

								<td>".$i."</td>

								<td>".$tutor['lastname']." ".$tutor['firstname']."</td>

								<td style='display: none;'>" .$tutor['typ1']."</td>

								<td style='display: none;'>" .$tutor['typ2']."</td>

								<td style='display: none;'>" .$tutor['typ3']."</td>

								<td style='display: none;'>" .$tutor['typ4']."</td>

								<td>" . $sum_val . "</td>

								<td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">Толық >></a></td>

							</tr>

							</tbody>";

					}

					

					while($tutor2 = mysqli_fetch_array($sql_tuts)){

						$i++;

						$sum_val = sprintf("%.2f", $tutor2['sum_val']);

						echo "<tr><td>".$i."</td><td>".$tutor2['lastname']." ".$tutor2['firstname']."</td><td>" . $sum_val . "</td><td><a href = \"tolyk.php?ID=" . $tutor2['TutorID'] . "\">Толық >></a></td></tr>";

					}

					   

						/*

						if($tutor['RATE'] == 0.5 || $tutor['RATE'] == 0.25 || $tutor['RATE'] == 0.75 || $tutor['job_titleID'] == 2 || $tutor['job_titleID'] == 3 || $tutor['job_titleID'] == 4 || $tutor['job_titleID'] == 5 || $tutor['job_titleID'] == 6 || $tutor['job_titleID'] == 7 || $tutor['job_titleID'] == 8){

							$sum_val = sprintf("%.2f", $tutor['sum_val']);

							echo "<tr><td>".'*'."</td><td>".$tutor['lastname']." ".$tutor['firstname']."</td><td>" . $sum_val . "</td><td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">Толық >></a></td></tr>";							

						}	*/

			?>

						<tfoot>

							<tr>

								<th>№</th>

								<th>Аты жөні</th>

								<th style="display: none;">Ғылым</th>

								<th style="display: none;">Академия</th>

								<th style="display: none;">Әлеуметтік</th>

								<th>Жалпы балл</th>

								<th>Толық көру</th>

							</tr>

						</tfoot>

					</table>

					

					</div>

					<div class = "univer_table">

						<?php

						//###########################################univer table display###############################################

							$sql3 = mysqli_query($connection, "SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_univer FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul") or die(mysqli_error($connection));

							

							$univer = mysqli_fetch_array($sql3);

							

							$sql4 = mysqli_query($connection,"SELECT engbekter.kod_fakul, SUM(engbekter.ball)*0.50 AS sum_univer_gylym, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 1") or die(mysqli_error($connection));

							

							$univer2 = mysqli_fetch_array($sql4);

							

							$sql5 = mysqli_query($connection, "SELECT engbekter.kod_fakul, SUM(engbekter.ball)*0.35 AS sum_univer_oku, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 2") or die(mysqli_error($connection));

							

							$univer3 = mysqli_fetch_array($sql5);

							

							$sql6 = mysqli_query($connection, "SELECT engbekter.kod_fakul, SUM(engbekter.ball)*0.15 AS sum_univer_tarbie, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE korsetkishter.typeID = 3") or die(mysqli_error($connection));

							

							$univer4 = mysqli_fetch_array($sql6);

							$sql7 = mysqli_query($connection, "SELECT engbekter.kod_fakul, SUM(engbekter.ball) AS sum_baska, korsetkishter.typeID FROM engbekter INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset WHERE  korsetkishter.typeID = 5") or die(mysqli_error($connection));

							

							$univer5 = mysqli_fetch_array($sql7);

							$a = array($univer4['sum_univer_tarbie'],$univer2['sum_univer_gylym'],$univer3['sum_univer_oku'],$univer5['sum_baska']);

							$univ = array_sum($a);

						?>

						<h3 align = 'center' style = "color: #0094de">Университет бойынша</h3>

						<table id ="univer_t" class="display" style="width:100%">

							<thead>

								<tr>

									<th>ШТАТ САНЫ</th>

									<th>ҒЫЛЫМ</th>

									<th>АКАДЕМИЯЛЫҚ</th>

									<th>ӘЛЕУМЕТТІК-МӘДЕНИ</th>

									<th>ЖАЛПЫ БАЛЛ</th>

									<th>ОРТА БАЛЛ</th>

								</tr>

							</thead>

							<tbody>

								<tr>

									<td>

										<div>

											<?php

												$result= mysqli_query($connection, "SELECT shtat_sani FROM jildar WHERE id_jildar= '1'");

												while($row = mysqli_fetch_array($result)){

														echo $row['shtat_sani'];

												}

											?>

										</div>

									</td>

									<td><?php echo sprintf("%.2f",$univer2['sum_univer_gylym']);?></td>

									<td><?php echo sprintf("%.2f",$univer3['sum_univer_oku']);?></td>

									<td><?php echo sprintf("%.2f",$univer4['sum_univer_tarbie']);?></td>

									<td><?php echo sprintf("%.2f",$univ);?></td><td><?php $shtat_sani = 1178.25; $avg = ($univ)/$shtat_sani; echo sprintf("%.2f",$avg);?></td>

								</tr>

							</tbody>

						</table>

					</div>

					<div class = "faculty_table">

						<?php

							

							/*$f_sql = mysqli_query($connection,"SELECT faculties.facultyNameKZ, faculties.shtat_sany, SUM(engbekter.ball) AS sum_faculty, (SUM(engbekter.ball))/faculties.shtat_sany AS avg_faculty, faculties.FacultyID

							FROM engbekter

							RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul

							where faculties.activ=1 

							GROUP BY faculties.facultyNameKZ

							ORDER BY avg_faculty DESC") or die(mysqli_error($connection));*/

							$f_sql = mysqli_query($connection,"SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4) AS SumAllType, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4)/T1.shtat_sany AS avg_faculty

							FROM (SELECT

							  faculties.FacultyID,

							  faculties.facultyNameKZ, 

							  faculties.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,

							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END) AS typ4

							FROM engbekter

							RIGHT JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 1

							GROUP BY faculties.facultyNameKZ) AS T1 ORDER by avg_faculty DESC") or die(mysqli_error($connection));					

						?>

						<h3 align = 'center' style = "color: #0094de">Факультеттер</h3>

						<table >

							<tr>

								<th>№</th>

								<th>Факультет атауы</th>

								<th>Штат саны</th>

								<th>Жалпы балл</th>

								<th>Орта балл</th>

								<th>Толық көру</th>

							</tr>

							<?php

								$i = 1;

								while($faculty = mysqli_fetch_array($f_sql)){

									echo "<tr><td>".$i."</td><td>".$faculty['facultyNameKZ']."</td><td>".$faculty['shtat_sany']."</td><td>". sprintf("%.2f",$faculty['SumAllType'])."</td><td>". sprintf("%.2f",$faculty['avg_faculty'])."</td><td><a href = \"tolyk_faculty.php?ID=" . $faculty['FacultyID'] . "\">Толық >></a></td></tr>";

									$i++;

								}

							?>

						</table>							

					</div>

						<div class = "cafedra_table">

						<?php

							$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4)/T1.shtat_sany AS avg_cafedra

							FROM (SELECT

							  cafedras.cafedraID,

							  cafedras.cafedraNameKZ, 

							  cafedras.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,

							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4

							FROM engbekter

							RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra

							LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 1

							GROUP BY cafedras.cafedraNameKZ) AS T1 ORDER by avg_cafedra DESC") or die(mysqli_error($connection));

						?>

						<h3 align = 'center' style = "color: #0094de">Кафедралар</h3>

						<table>

							<thead>

								<tr>

									<th>№</th>

									<th>Кафедра атауы</th>

									<th>Штат саны</th>

									<th>Жалпы балл</th>

									<th>Орта балл</th>

									<th>Толық көру</th>

								</tr>

							</thead>

							<?php

								$i = 1;

								while($cafedra = mysqli_fetch_array($c_sql)){

									echo "

									<tr>

									<td>".$i."</td>

									<td>".$cafedra['cafedraNameKZ']."</td>

									<td>".$cafedra['shtat_sany']."</td>

									<td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td>

									<td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td>

									<td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">Толық >></a></td

									></tr>";

									$i++;

								}

							?>

						</table>

					</div>

					

					<div class = "cafedra_table">

						<?php

							$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+ T1.typ4)/T1.shtat_sany AS avg_cafedra

							FROM (SELECT

							  cafedras.cafedraID,

							  cafedras.cafedraNameKZ, 

							  cafedras.shtat_sany,

							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,

							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,

							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,

							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END)  AS typ4

							FROM engbekter

							RIGHT JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra

							LEFT JOIN faculties ON faculties.FacultyID = cafedras.FacultyID

							left JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset 

							WHERE faculties.activ = 0

							GROUP BY cafedras.cafedraNameKZ) AS T1 ORDER by avg_cafedra DESC") or die(mysqli_error($connection));

						?>

						<h3 align = 'center' style = "color: #0094de">Ғылыми зерттеу институттары</h3>

						<table>

							<tr>

								<th>№</th>

								<th>Орталық атауы</th>

								<th>Штат саны</th>

								<th>Жалпы балл</th>

								<th>Орта балл</th>

								<th>Толық көру</th>

							</tr>

							<?php

								$i = 1;

								while($cafedra = mysqli_fetch_array($c_sql)){

									echo "<tr>

									<td>".$i."</td>

									<td>".$cafedra['cafedraNameKZ']."</td>

									<td>".$cafedra['shtat_sany']."</td>

									<td>". sprintf("%.2f",$cafedra['sum_cafedra'])."</td>

									<td>". sprintf("%.2f",$cafedra['avg_cafedra'])."</td>

									<td><a href = \"tolyk_cafedra.php?ID=" . $cafedra['cafedraID'] . "\">Толық >></a></td></tr>";

									$i++;

								}

							?>

						</table>

					</div>		

				</div>

	</div>

	<div class = "footer">

	</div>

	<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

	

<script>

	function HtmlTOExcel(type, fun, dl) {

    var elt = document.getElementById('univ_data');

    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

    return dl ?

        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :

        XLSX.writeFile(wb, fun || ('tutor-recored.' + (type || 'xlsx')));

}

</script>

</body>

</html>

