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
	<title>Басқа оқытушыны көру</title>
	<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
	<script type = "text/javascript" src = "../js/jquery.js"></script>
	<script type = "text/javascript" src = "../js/functions.js"></script>
	<link rel="icon" type="image/png" href="../img/favicon.png" />
	<style>
		.select_box{
			width: 900px;
			padding: 20px;
			margin: 0 auto;
			margin-top: 30px;
			margin-bottom: 30px;
			border: 1px black solid;
			border-bottom: 1px black dashed;
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
	</style>
</head>
<body>
	<div class = "upper_header">
		<img src = "../img/login_logo.png" style = "width: 200px; float:left;">
		<p style = "font-size: 24px; text-align: center; color: #0094de; font-weight: bold;">АХМЕТ ЯСАУИ УНИВЕРСИТЕТІ</p>
		<p style = "font-size: 24px; text-align: center; color: red;font-weight: bold;">ІШКІ КӘСІБИ РЕЙТИНГІ</p>
		<div style = "font-size: 18px; text-align: center; color: #0094de;font-weight: bold;">		
<?php
$result= mysqli_query($connection, "SELECT text_jildar FROM jildar WHERE id_jildar= '1'");
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
				<h2 style = "text-align: center;">Басқа оқытушыны немесе ғылыми қызметкерді көру</h2>
				<?php
					
				/*	if(isset($_SESSION['teacher'])){
					
					} else {
					
						header('Location: login.php');
					}
				
					$_SESSION['teacher'];
					$query = mysql_query("SELECT * FROM teachers WHERE login = '$_SESSION[teacher]'") or die(mysql_error());
					$teacher = mysql_fetch_array($query); */
					function load_faculty(){
						global $connection;
						$output = '';
						$sql = "SELECT * FROM faculties";
						$result = mysqli_query($connection,$sql) or die(mysqli_error($connection));
						
						while($row = mysqli_fetch_array($result)){			
							$output .= '<option value = "'.$row["FacultyID"].'">' . $row["facultyNameKZ"] . '</option>';				
						}
						return $output;
					}
					
					//$sql = mysql_query("SELECT * FROM engbekter WHERE kod_kizm = ''") or die(mysql_error());
				?>
				<div class = "select_box">
					<form method = "post" action = "sendShagym.php" style = "margin-top: 10px;">
						Факультет немесе ҒЗО
						<select name = "faculty" id = "faculty">
							<option value = "">Факультетті немесе ҒЗО-ны таңдаңыз</option>
								<?php echo load_faculty(); ?>
						</select><br><br>
						Кафедра немесе ҒЗИ
						<select name = "cafedra" id = "cafedra">
							<option value = "">---</option>
								
						</select><br><br>
						Оқытушы немесе ғылыми қызметкер
						<select name = "tutor" id = "tutor">
							<option value = "">---</option>
								
						</select><br /><br />
						<script>
							$(document).ready(function(){
							
								$("#faculty").change(function(){
									var FacultyID = $(this).val();
									$.ajax({
										url:"get_cafedra.php",
										method:"POST",
										data:{FacultyID:FacultyID},
										dataType:"text",
										success:function(data){
											$("#cafedra").html(data);
										}
									});
								});
								$("#cafedra").change(function(){
									var cafedraID = $(this).val();
									$.ajax({
										url:"get_tutor.php",
										method:"POST",
										data:{cafedraID:cafedraID},
										dataType:"text",
										success:function(data){
											$("#tutor").html(data);
										}
									});
								});
								$("#tutor").change(function(){									
									var TutorID = $(this).val();
									$.ajax({
										url:"get_korsetkish.php",
										method:"POST",
										data:{TutorID:TutorID},
										dataType:"text",
										success:function(data){
											$("#korsetkish").html(data);
										}
									});
								});
								
							});
						</script>
					</form>
				</div>				
				<div id = "korsetkish">
				</div>
			</div>
		</div>
	</div>
	<div class = "footer">
	
	</div>
</body>
</html>