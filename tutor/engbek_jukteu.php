<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<head>
	<?php
		session_start();
		$tut=$_SESSION['tutor'];
		include('../incs/connect.php');
		$query = mysqli_query($connection, "SELECT * FROM tutors WHERE Login = '$tut'") or die(mysql_error());
		$tutor = mysqli_fetch_array($query);
		$_SESSION['dostup'] = $tutor['dostup'];
		if(!isset($_SESSION['tutor'])){
			header('Location: ../login.php');
		}
		//$query = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[user]'") or die(mysql_error());
		//$main_me = mysql_fetch_array($query);
	?>
	<title>Еңбекті жүктеу</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
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
	</style>
</head>
<body>
	<div class = "upper_header">
		<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
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
		<div class = "content_wrapper" style = "margin-top: 5px;">
			<div class = "inner_conten" style = "width: 1000px; margin: 0 auto;">
				<h2 style = "text-align: center;">Орындалған жұмыстар</h2>			
				<?php
					
				/*	if(isset($_SESSION['teacher'])){
					
					} else {
					
						header('Location: login.php');
					}
				*/
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
						<select name = "korsetkish" id = "korsetkish">
							<option>---</option>
								<?php echo load_korsetkish(); ?>
						</select><br /><br />
						<span>Көрсеткіштің толық атауы</span><br />
						<textarea rows="8" cols="109" name = "tolyk_korset" id = "tolyk_korset" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br /><br />
						Орындалған күні
						<input type = "date" name = "date" required placeholder = "жжжж-аа-кк енгізіңіз"/><br /><br />
						ХҚТУ авторлар саны (Өзіңізді қоса санағанда) <span style="color:red">Макс 8 автор</span><br/>
						<input type = "number" id = "univ_avtor_san" name = "univ_avtor_san" value = "1" min="1"  oninput="compareSelectedValue()"/>
						<br /><br />
						<div id="hidingElem">
						Еңбек санының түрлері
						<select id = "select_sany" >
							<option value = "0">---</option>
							<option value = "1">Әр 1 млн. теңге үшін</option>
							<option value = "2">Деңгейі</option>
							<option value = "5">Саны</option>
						</select><br /><br />
						<label for="sany" id = "label_sany">---</label><br /><input type = "number" id = "sany" name = "sany" value = "1" step="0.01"><br />
						</div><br />
						<div class="avtor1">
							<label for="avtor_bir">Автор 1:</label>
							<input type ="text" id ="avtor_bir" name="avtor_bir"  placeholder="Type to search...">
							<div id="myDropdown"></div>
						</div>
						<div class="avtor2">
							<label for="avtor_eki" id = "avtor_eki">Автор 3</label><br />
							<input type = "text" id = "avtor_eki" name = "avtor_eki" ><br />
						</div>
						<div class="avtor3">
							<label for="avtor_ush" id = "avtor_ush">Автор 4</label><br />
							<input type = "text" id = "avtor_ush" name = "avtor_ush"><br />
						</div>
						<div class="avtor4">
							<label for="avtor_tort" id = "avtor_tort">Автор 5</label><br />
							<input type = "text" id = "avtor_tort" name = "avtor_tort"><br />
						</div>
						<div class="avtor5">
							<label for="avtor_bes" id = "avtor_bes">Автор 6</label><br />
							<input type = "text" id = "avtor_bes" name = "avtor_bes"><br />
						</div>
						<div class="avtor6">
							<label for="avtor_alty" id = "avtor_alty">Автор 7</label><br />
							<input type = "text" id = "avtor_alty" name = "avtor_alty"><br />
						</div>
						<div class="avtor7">
							<label for="avtor_jeti" id = "avtor_jeti">Автор 8</label><br />
							<input type = "text" id = "avtor_jeti" name = "avtor_jeti"><br />
						</div>		
						<span>Ескерту</span><br />
						<textarea rows="8" cols="109" name = "eskertu" style = "font-size: 18px; font-family: Tahoma; margin-top: 8px; border-radius:4px;"></textarea><br/><br/><hr />
						<span>Растаушы файлды таңдау (PDF, JPG форматындағы файлдар)</span><br/><br/>


						
			 			<!--<input type = "file" name = "file" /><br /><br /><hr />-->

					
						
						<input type = "file" name="file" accept="application/pdf, image/*" /><br /><br /><hr />

						
						<input type = "hidden" name = "tutor_id" value = "<?php echo $tutor['TutorID'];?>"/>
						<input type = "hidden" name = "cafedra" value = "<?php echo $tutor['cafedraID'];?>"/>
						<input type = "hidden" name = "faculty" value = "<?php echo $tutor['FacultyID'];?>"/>
						<input type = "hidden" name = "save_date" value = "<?php date_default_timezone_set("Asia/Dhaka"); echo date("d/m/Y H:i:s");?>"/>						
                                                <!--<br>Деректер қоры жабылды! 20.05.2022 00:00<br/>-->
												<input type = "submit" name = "upload" value = "Жүктеу"/>

					</form>
				</div>
				<div class = "works">
					<style>
						table {
							border-collapse: collapse;
							border:1px black solid;
							width: 100%;
							font-size: 12px;
						}

						th, td {
							text-align: left;
							padding: 6px;
							border:1px black solid;
						}

						th {
							background-color: #003366;
							color: white;
						}
					</style>
					<?php
						
						$tutor_id = $_SESSION['tutor'];
						
						$sql = "SELECT engbekter.ball, 
						engbekter.engbekID, 
						tutors.firstname, tutors.lastname, 
						tutors.patronymic, 
						korsetkishter.korsetkish_ati, 	
						engbekter.sani, 
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
						WHERE Login = '$tutor_id' ORDER BY engbekter.engbekID DESC";
						
						$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
						
						echo "<table>
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
						</tr>";
						
						$i = 1;
						
						while($row = mysqli_fetch_array($result)){
							echo "<tr>
								<td>".$i."</td>
								<td>".$row["cafedraNameKZ"]."</td>
								<td>".$row["lastname"]." ".$row["firstname"]."</td>
								<td>".$row["korsetkish_ati"]."</td>
								<td>".$row["sani"]."</td>
								<td>".$row["univ_avtor_san"]."</td>
								<td><a target='_blank' href = " .$row['file_ati'] .">".$row["file_ati"]."</a></td>
								<td>".$row["ball"]."</td><td>".$row["kayt_sebeb"]."</td><td>".$row["status_name"]."</td>
							</tr>";
							$i++;
						}
						
						echo "</table>";    	
					?>
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	</div>

	<script>
		$(document).ready(function(){
		
			$("#korsetkish").change(function(){
				var kod_korsetkish = $("#korsetkish option:selected").text();
				var id_esep =$("#korsetkish option:selected").attr('id_esep');
				var id_shekteu =$("#korsetkish option:selected").attr('id_shekteu');

				if (id_shekteu <= 1) {
					$("#sany").prop('disabled', true); 
				}else {
					$("#sany").prop('disabled', false); 
				}
				if (id_shekteu <= 1) {
					$("#select_sany").prop('disabled', true); 
				}else {
					$("#select_sany").prop('disabled', false); 
				}
				
				$("#select_sany").val(id_esep);									
				
				var id_comment =$("#korsetkish option:selected").attr('id_comment');
				$("#label_sany").text(id_comment);
				$.ajax({
					method:"POST",
					data:{kod_korsetkish:kod_korsetkish},
					dataType:"text",
					success:function(data){
						$("#tolyk_korset").text(kod_korsetkish);
					}
				});
			});
			

			$("#form1").submit(function( event ) {

				var id_shekteu = $("#korsetkish option:selected").attr('id_shekteu');
				var sany = $("#sany").val();

					if ( parseInt(id_shekteu) <= parseInt(sany) && !$("#sany").prop('disabled')) {
						alert("Шектік санынан асып кеттіңіз!\nқайта толтырыңыз");
					event.preventDefault();
					
				}
			
			});
			$("#select_sany").change(function(){
				var select_sany = $("#select_sany option:selected").text();
				var select_sanyID = $("#select_sany option:selected").val();
				$.ajax({
					method:"POST",
					data:{select_sany:select_sany},
					dataType:"text",
					success:function(data){
						$("#label_sany").text(select_sany);
						if(select_sanyID == 3){
							alert("Сағат саны максимал 36");
							$('#sany').prop('min','1');
							$('#sany').prop('max','36');
						} else if(select_sanyID == 4){
							alert("Шаршы см. максимал 500");
							$('#sany').prop('min','1');
							$('#sany').prop('max','500');
						}								
					}
				});
			});
		});
		function limit(element){
			var max_chars = 3;
			if(element.value.length > max_chars) {
				element.value = element.value.substr(0, max_chars);
			}
		} 
		function hideInputText(){
				// Получаем значение поля ввода
				var avtor1 = document.querySelector('.avtor1');
				var avtor2 = document.querySelector('.avtor2');
				var avtor3 = document.querySelector('.avtor3');
				var avtor4 = document.querySelector('.avtor4');
				var avtor5 = document.querySelector('.avtor5');
				var avtor6 = document.querySelector('.avtor6');
				var avtor7 = document.querySelector('.avtor7');
				
					avtor1.style.display = "none";
					avtor2.style.display = "none";
					avtor3.style.display = "none";
					avtor4.style.display = "none";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
			}
			// Вызываем функцию при загрузке страницы
			window.onload = function() {
				hideInputText();
			};
		function compareSelectedValue() {
			// Получаем элемент input по его ID
				var avtor_san = document.getElementById("univ_avtor_san");
				// Получаем элемент input по его Class
				var avtor1 = document.querySelector('.avtor1');
				var avtor2 = document.querySelector('.avtor2');
				var avtor3 = document.querySelector('.avtor3');
				var avtor4 = document.querySelector('.avtor4');
				var avtor5 = document.querySelector('.avtor5');
				var avtor6 = document.querySelector('.avtor6');
				var avtor7 = document.querySelector('.avtor7');
				// Получаем значение поля ввода
				var inputValue = avtor_san.value;
				
				if (inputValue === "1") {
					hidingElem.style.display = "block";
					avtor1.style.display = "none";
					avtor2.style.display = "none";
					avtor3.style.display = "none";
					avtor4.style.display = "none";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				// Сравниваем значение поля ввода с другим значением
				if (inputValue === "2") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "none";
					avtor3.style.display = "none";
					avtor4.style.display = "none";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				if (inputValue === "3") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "none";
					avtor4.style.display = "none";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				if (inputValue === "4") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "block";
					avtor4.style.display = "none";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				if (inputValue === "5") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "block";
					avtor4.style.display = "block";
					avtor5.style.display = "none";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				if (inputValue === "6") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "block";
					avtor4.style.display = "block";
					avtor5.style.display = "block";
					avtor6.style.display = "none";
					avtor7.style.display = "none";
				}
				if (inputValue === "7") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "block";
					avtor4.style.display = "block";
					avtor5.style.display = "block";
					avtor6.style.display = "block";
					avtor7.style.display = "none";
				}
				if (inputValue === "8") {
					hidingElem.style.display = "none";
					avtor1.style.display = "block";
					avtor2.style.display = "block";
					avtor3.style.display = "block";
					avtor4.style.display = "block";
					avtor5.style.display = "block";
					avtor6.style.display = "block";
					avtor7.style.display = "block";
				}
			}
			
	</script>
<script type = "text/javascript" src = "../js/searcher.js"></script>
</body>
</html>