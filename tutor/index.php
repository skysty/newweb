<!DOCTYPE html>
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
	<link rel = "stylesheet" type = "text/css" href = "../css/tutorStyle.css">
	<link rel = "stylesheet" type = "text/css" href = "../dataTables/jquery.dataTables.min.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/chart.min.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/jquery.min.js"></script>
	<script type = "text/javascript" src = "../chartjs/js/app.js"></script>
	<script type = "text/javascript" src = "../dataTables/jquery.dataTables.min.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
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
				$_SESSION['tutor'];
				$query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
				$tut = mysqli_fetch_array($query);
				
				echo "<h2 style = 'color:#0094aa'>Оқытушы: " . $tut['lastname'] ." ". $tut['firstname'] ." ". $tut['patronymic'] . "</h2>";
				?>
			<hr />		
			<h1 style = "text-align: center; color: red">Ағымдағы рейтинг 2022-2023</h1><hr />
			<h2 align = 'center' style = "color: #0094de">Факультеттер рейтингі</h2>
			<div id = "chart_container">
				<canvas id = "mycanvas"></canvas>
			</div>				
			<div class = 'tutors_table'>
				<h3 align = 'center' style = "color: #0094de">Оқытушы-профессорлар және ғылыми қызметкерлер рейтингі</h3>
				<?php
					$sql1 = mysqli_query($connection,"SELECT 
					T1.TutorID,
					T1.job_titleID,
					T1.lastname,
					T1.firstname,
					SUM(T1.typ1) AS sum_typ1,
					SUM(T1.typ2) AS sum_typ2,
					SUM(T1.typ3) AS sum_typ3,
					SUM(T1.typ4) AS sum_typ4,
					(SUM(T1.typ1) + SUM(T1.typ2) + SUM(T1.typ3) + SUM(T1.typ4)) AS sum_val
				FROM (
					SELECT
						tutors.TutorID,
						tutors.RATE, 
						tutors.job_titleID,
						tutors.lastname, 
						engbekter.kod_kizm,
						tutors.firstname,
						CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END * 0.50 AS typ1,
						CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END * 0.35 AS typ2,
						CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END * 0.15 AS typ3,
						CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END AS typ4
					FROM engbekter
					LEFT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					LEFT JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
					WHERE tutors.deleted=0 AND tutors.RATE IN (1,2,3)
					UNION ALL
					SELECT 
						tutors.TutorID,
						tutors.RATE,
						tutors.job_titleID, 
						tutors.lastname, 
						engbekter.kod_kizm, 
						tutors.firstname, 
						0 AS typ1,
						0 AS typ2,
						0 AS typ3,
						engbekter.ball AS typ4
					FROM engbekter 
					RIGHT JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
					WHERE tutors.deleted=0 AND tutors.RATE IN (1,2,3) AND engbekter.kod_kizm IS NULL
				) AS T1
				GROUP BY T1.lastname, T1.firstname
				ORDER BY sum_val DESC") or die(mysqli_error($connection));
					?>
					<table id="tutorTable" class="display" style="witdth:100%">
						<thead>
							<tr>
								<th>№</th>
								<th>Аты жөні</th>
								<th>Жалпы балл</th>
								<th>Толық көру</th>
							</tr>
						</thead>
						<tbody>
				<?php

					$i = 0;
					
					while($tutor = mysqli_fetch_array($sql1)){
						$i++;
						$sum_val = sprintf("%.2f", $tutor['sum_val']);
						echo "<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$tutor['lastname']." ".$tutor['firstname']."</td>";
						echo "<td>" . $sum_val . "</td>";
						echo "<td><a href = \"tolyk.php?ID=" . $tutor['TutorID'] . "\">Толық >></a></td>";
						echo "</tr>";
					}
					
				?>
					</tbody>
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
								<table>
									<thead>
										<tr>
											<th>Штат саны</th>
											<th>Ғылым</th>
											<th>Академиялық</th>
											<th>Әлеуметтік-мәдени</th>
											<th>Жалпы балл</th>
											<th>Орта балл</th>
										</tr>
									</thead>
									<tr>	
										<td>
											<div>
												<?php
													$result= mysqli_query($connection,"SELECT shtat_sani FROM jildar WHERE id_jildar= '1'");
													while($row = mysqli_fetch_array($result)){
													echo $row['shtat_sani'];
													}
												?>
												</div>
										</td>
										<td><?php echo sprintf("%.2f",$univer2['sum_univer_gylym']);?></td>
											<td><?php echo sprintf("%.2f",$univer3['sum_univer_oku']);?></td>
											<td><?php echo sprintf("%.2f",$univer4['sum_univer_tarbie']);?></td>
											<td><?php echo sprintf("%.2f",$univ);?></td>
											<td><?php $shtat_sani = 1178.25; $avg = ($univ)/$shtat_sani; echo sprintf("%.2f",$avg);?></td>
									</tr>
						 		</table>
					</div>
					<div class = "faculty_table">
						<?php
							$f_sql = mysqli_query($connection,"SELECT T1.*, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4) AS sum_faculty, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4)/T1.shtat_sany AS avg_faculty
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
						<table>
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
									echo "<tr><td>".$i."</td><td>".$faculty['facultyNameKZ']."</td><td>".$faculty['shtat_sany']."</td><td>". sprintf("%.2f",$faculty['sum_faculty'])."</td><td>". sprintf("%.2f",$faculty['avg_faculty'])."</td><td><a href = \"tolyk_faculty.php?ID=" . $faculty['FacultyID'] . "\">Толық >></a></td></tr>";
									$i++;
								}
							?>
						</table>							
					</div>
						<div class = "cafedra_table">
						<?php
								$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3+T1.typ4)/T1.shtat_sany AS avg_cafedra
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
							$c_sql = mysqli_query($connection,"SELECT T1.*,  (T1.typ1 + T1.typ2 + T1.typ3) AS sum_cafedra, (T1.typ1 + T1.typ2 + T1.typ3)/T1.shtat_sany AS avg_cafedra
							FROM (SELECT
							  cafedras.cafedraID,
							  cafedras.cafedraNameKZ, 
							  cafedras.shtat_sany,
							  SUM(CASE WHEN korsetkishter.typeID = 1 THEN engbekter.ball ELSE 0 END) * 0.50 AS typ1,
							  SUM(CASE WHEN korsetkishter.typeID = 2 THEN engbekter.ball ELSE 0 END) * 0.35 AS typ2,
							  SUM(CASE WHEN korsetkishter.typeID = 3 THEN engbekter.ball ELSE 0 END) * 0.15 AS typ3,
							  SUM(CASE WHEN korsetkishter.typeID = 5 THEN engbekter.ball ELSE 0 END) AS typ4
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
</body>
</html>