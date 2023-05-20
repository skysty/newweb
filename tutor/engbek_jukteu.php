<!DOCTYPE html>
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<head>
	<?php include '../extensions/head_enbek.php'; ?>
	</head>
	<body>
		<div class = "upper_header">
			<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
			<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
			<p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
			<div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">		
				<?php
					$result= mysqli_query($connection,"SELECT text_jildar FROM jildar WHERE id_jildar= '1'");
					while($row = mysqli_fetch_array($result))
					{
						echo $row['text_jildar'];
					}
				?>
			</div>
				</br>	
		</div>
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
			<div class = "content_wrapper" style = "margin-top: 5px;">
				<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
					<h2 style = "text-align: center;">Орындалған жұмыстар</h2>	
					<div id="dialog">
						<div class="dialog-content">
							<span class="close" onclick="closeDialog()">&times;</span>
							<p style="color:red">Ескерту:2.1 - 2.1.6 аралығындағы көрсеткіштерге салынған еңбек өшірлмейді бірақ функция қосу үстіндеміз</p>
							<p>Әлемдік рейтингтік ғылыми индекстегі  жарияланымдар (Ахмет Ясауи университеті атауы көрсетілген жағдайда, қосалқы авторлық тек өз ғылыми және пәнаралық бағыты бойынша, Journal Citation Reports (Clarivate Analytics) үшін квартиль және CiteScore (Scopus) индикаторы және барлық ғылыми мақалалар мен монографиялар үшін ұпайларды есептеу кезінде жарияланымның ішкі авторлар санына қарай ұпай төмендегіше бөлінеді:</p>
							<ul>
								<li>1 автор – 100 % ; </li>
								<li>2 автор, 1-ші авторға 60% болса, екінші авторға 40 % беріледі;</li>
								<li>3 автор, 1-ші авторға 40%, қалған екі авторға 30-% теңдей бөлінеді;</li>
								<li>4 автор, 1-ші авторға 40%, қалған 3 авторға 20 % теңдей бөлінеді;</li>
								<li>5 автор, 1-ші авторға 40%, қалған 4 авторға 15 %-дан теңдей бөлінеді;</li>
								<li>6 автор, 1-ші авторға 25 %, қалған 5 авторға 15 %-дан теңдей бөлінеді,</li>
								<li>7 авторлар, 1-ші авторға 20 %, қалған авторларға 80 % үлес бөлінеді.</li>
							</ul>
							<p style="color:red">Ескерту:Екі немесе одан да көп автор болған жайғдайда еңбектеріңізді жүктеу кезінде басқа авторға да хабарлаңыз себебі басқа автор білмей жатып екінші рет тағы салуы мүмкін</p>
							<p style="color:red">Таңдалған авторларға сіз жүктеген еңбек көрінеді және оларға ұпай беріледі</p>
							<p style="color:red">басқа авторларды белгілеп жүктемеген жағдайда еңбегіңіз қайтарылады</p>
						</div>
					</div>
					<?php
						$_SESSION['tutor'];
						$query = mysqli_query($connection,"SELECT cafedras.cafedraID, cafedras.FacultyID, tutors.TutorID
						FROM cafedras
						INNER JOIN faculties ON faculties.FacultyID = cafedras.FacultyID
						INNER JOIN tutors ON tutors.CafedraID = cafedras.cafedraID
						WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
						$tutor = mysqli_fetch_array($query);
						$tut = $tutor['TutorID'];
							function load_korsetkish(){
								global $connection;
								global $tut;
								$output = '';
								$sql = "SELECT * FROM korsetkishter k
								WHERE k.bolimderID='1' ";
								$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
								
								while($row = mysqli_fetch_array($result)){			
									$output .= '<option id_esep="'.$row["id_esep"].'" id_comment="'.$row["id_comment"].'" value = "'.$row["kod_korsetkish"].'" id_shekteu="'.$row["id_shekteu"].'">' . $row["korsetkish_ati"] . '</option>';				
								}
								return $output;
							}
						
						
					?>	
					<div class = "select_box">
						<form id="form1" method = "post" action = "load_engbek.php" style = "margin-top: 10px;" enctype = "multipart/form-data">
							Көрсеткіштер
							<select name = "korsetkish" id = "korsetkish" onchange="handleChange()">
								<option>---</option>
									<?php echo load_korsetkish(); ?>
							</select><br /><br />
							<span>Көрсеткіштің толық атауы</span><br />
							<textarea rows="8" cols="109" name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br /><br />
							Орындалған күні
							<input type = "date" name = "date" required/><br /><br />
							ХҚТУ авторлар саны (Өзіңізді қоса санағанда) <span style="color:red" id="hideText">Макс 7 автор</span><br/>
							<input type = "number" id = "univ_avtor_san" name = "univ_avtor_san" value = "1" min="1"/>
							<input type = "number" id = "univ_avtor_san2" name = "univ_avtor_san2" value = "1" min="1"  oninput="compareSelectedValue()" required="Автор санын енгізіңіз" />
							<br /><br />
							<div id="hidingElem">
								Еңбек санының түрлері
								<select id = "select_sany" >
									<option value = "0">---</option>
									<option value = "1">Әр 1 млн. теңге үшін</option>
									<option value = "2">Деңгейі</option>
									<option value = "5">Саны</option>
								</select><br /><br />
								<label for="sany" id = "label_sany">---</label><br />
								<input type = "number" id = "sany" name = "sany" value = "1" step="0.01"><br />
							</div><br />
							<div class="avtor1">
								<label for="avtor_bir">Автор 2:<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type ="text" id ="avtor_bir" name="avtor_bir"  placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box"></div>
							</div>
							<div class="avtor2">
								<label for="avtor_eki">Автор 3<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type = "text" id = "avtor_eki" name = "avtor_eki" placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box2"></div>
							</div>
							<div class="avtor3">
								<label for="avtor_ush">Автор 4<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type = "text" id = "avtor_ush" name = "avtor_ush" placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box3"></div>
							</div>
							<div class="avtor4">
								<label for="avtor_tort">Автор 5<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type = "text" id = "avtor_tort" name = "avtor_tort" placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box4"></div>
							</div>
							<div class="avtor5">
								<label for="avtor_bes" >Автор 6<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type = "text" id = "avtor_bes" name = "avtor_bes" placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box5"></div>
							</div>
							<div class="avtor6">
								<label for="avtor_alty">Автор 7<span style="color:red">* Автордың толық  аты-жөнін қараңыз</span></label>
								<input type = "text" id = "avtor_alty" name = "avtor_alty" placeholder="Іздеу үшін теріңіз...">
								<div id="suggesstion-box6"></div>
							</div>
							<span>Ескерту</span><br />
							<textarea rows="8" cols="109" name = "eskertu" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br/><br/><hr />
							<span>Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)</span><br/><br/>


							
							<!--<input type = "file" name = "file" /><br /><br /><hr />-->

						
							
							<input type = "file" name="file" accept="application/pdf, image/*" required /><br /><br /><hr />

							
							<input type = "hidden" name = "tutor_id" value = "<?php echo $tutor['TutorID'];?>"/>
							<input type = "hidden" name = "id_esep" id ="id_esep1" />
							<input type = "hidden" name = "cafedra" value = "<?php echo $tutor['cafedraID'];?>"/>
							<input type = "hidden" name = "faculty" value = "<?php echo $tutor['FacultyID'];?>"/>
							<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>						
													<!--<br>Деректер қоры жабылды! 20.05.2022 00:00<br/>-->
							<input type = "submit" name = "upload" value = "Жүктеу"/>

						</form>
					</div>
					<div class = "works">
						<table>
							<thead>
							<tr>
								<th>№</th>
								<th>Кафедра/ҒЗИ</th>
								<th>Аты жөні</th>
								<th>Көрсеткіш</th>
								<th>Саны</th>
								<th>Автор саны</th>
								<th>Файл аты</th>
								<th>Балл</th>
								<th>Қайтару себебі</th>
								<th>Статус</th>
							</tr>
							</thead>
							<tbody>
						<?php
							
							$tutor_id = $_SESSION['tutor'];
							
							$sql = "SELECT engbekter.ball, 
							engbekter.engbekID, 
							tutors.firstname, tutors.lastname, 
							tutors.patronymic, 
							korsetkishter.korsetkish_ati, 	
							engbekter.sani, 
							engbekter.divBall,
							engbekter.univ_avtor_san, 
							engbekter.file_ati, 
							engbekter.kayt_sebeb, 
							engbekter.eskertu, 
							status.status_name,
							faculties.FacultyID, 
							status.statusID, 
							cafedras.cafedraNameKZ, 
							faculties.facultyNameKZ 
							FROM engbekter 
							INNER JOIN cafedras ON cafedras.cafedraID = engbekter.kod_kafedra 
							INNER JOIN tutors ON tutors.TutorID = engbekter.kod_kizm
							INNER JOIN korsetkishter ON korsetkishter.kod_korsetkish = engbekter.kod_korset
							INNER JOIN faculties ON faculties.FacultyID = engbekter.kod_fakul 
							INNER JOIN status ON status.statusID = engbekter.kod_stat 
							WHERE Login = '$tutor_id' and engbekter.del=0 ORDER BY engbekter.engbekID DESC";
							
							$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
							
							$i = 1;
							
							while($row = mysqli_fetch_array($result)){
								echo "<tr> ";
								echo "<td>".$i."</td>";
								echo "<td>".$row["cafedraNameKZ"]."</td>";
								echo "<td>".$row["lastname"]." ".$row["firstname"]."</td>";
								echo "<td>".$row["korsetkish_ati"]."</td>";
								echo "<td>".$row["sani"]."</td>";
								echo "<td>".$row["univ_avtor_san"]."</td>";
								echo "<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>";
								echo "<td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$row["status_name"]."</td>";
								echo "<td><button class='btn btn-danger delete-btn' data-id=".$row['engbekID']." onClick='deleteRecord(this)'>Өшіру</button></td>";	
								echo "</tr>";
								$i++;
							}
							   	
						?>
						</tbody>
						</table> 
					</div>
				</div>
			</div>
		</div>
		<div class = "footer">
		</div>
	</body>
	<?php include '../extensions/scripts_enbek.php'; ?>
</html>