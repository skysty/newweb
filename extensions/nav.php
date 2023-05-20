<?php

		include('../incs/connect.php');
		
		$_SESSION['tutor'];		
        $query = mysqli_query($connection,"SELECT * FROM tutors WHERE Login = '$_SESSION[tutor]'") or die(mysqli_error($connection));
		$tut = mysqli_fetch_array($query);
        $roleID=$tut['roleID']

?>    
    
    <nav id="primary_nav_wrap">
        <ul>
            <li><a href="#">Негізгі</a>
		        <ul>
				    <li><a href="index.php">Негізгі бет</a></li>
					<?php 
						if($roleID=="3"){
							echo '<li><a href="tekseruler.php">Еңбектерді тексеру</a></li>';
							echo '<li><a href="enbek_filter.php">Фильтр</a></li>';
							echo '<li><a href="manu.php">Қосылған балл</a></li>';	
						}
						if($roleID=="2"){
							echo '<li><a href="manu.php">Қосылған балл</a></li>';	
						}
						if($roleID=="4"){
							echo '<li><a href="manu.php">Қосылған балл</a></li>';	
						}
						if($roleID=="5"){
							echo '<li><a href="manu.php">Қосылған балл</a></li>';	
						}
						if($roleID=="6"){
							echo '<li><a href="tekseruler.php">Еңбектерді тексеру</a></li>';
							echo '<li><a href="manu.php">Қосылған балл</a></li>';	
						}
					?>		  
				    <li><a href="korsetkishter.php">Көрсеткіштер</a></li>
				    <li><a href="#">Құжаттар</a>
				    <ul>                             
					    <li><a target = "_blank" href = "../files/erezhe2023.pdf">Ереже 2022-2023</a></li>
                        <!-- <li><a target = "_blank" href = "../files/hat1.pdf">№1 хаттама 14.10.21</a></li>
                        <li><a target = "_blank" href = "../files/hat2.pdf">№2 хаттама 08.12.21</a></li> 
                        <li><a target = "_blank" href = "../files/sds.pdf">№2 хаттама 06.05.2021</a></li>
                        <li><a target = "_blank" href = "../files/hattama3.pdf">№3 хаттама 25.05.2021</a></li> 
                        <li><a target = "_blank" href = "../files/hattama4.pdf">№4 хаттама 24.06.2021</a></li>   -->
                        <li><a target = "_blank" href = "../files/rastau.pdf">Растаушылар Ғылыми бағыт</a></li>                                                                 
                        <li><a target = "_blank" href = "../files/akademia.PDF">Растаушылар Академиялық бағыт</a></li>                                                              
                        <li><a target = "_blank" href = "../files/aleumettik.pdf">Әлеуметтік-мәдени - Растаушылар</a></li>
                        <li><a target = "_blank" href = "../files/okim.PDF">ӨКІМ  Халықаралық байланыс</a></li>   
                        <li><a target = "_blank" href = "../files/уткырлык.pdf">Растаушылар академиялық ұтқырлық</a></li>               
                    </ul>
			</li>  
                        <li><a href="#">Архив </a>
                            <ul>
								<li><a href="http://ip2022.ayu.edu.kz">2021-2022 оқу жылы</a></li>
								<li><a href="http://ip3.ayu.edu.kz">2020-2021 оқу жылы</a></li>				     
                                <li><a href="http://ip4.ayu.edu.kz">2019-2020 оқу жылы</a></li>
                            </ul>
			           </li>
                       <li><a href="change_password.php">Құпия сөзді ауыстыру</a></li>
				</ul>
			  </li>
			  <li><a href="#">Орындау</a>
				<ul>
				  <li><a href="engbek_jukteu.php">ОПҚ/ҒҚ</a></li>
				  <?php
				  if($roleID=="4"){
					echo '<li><a href="engbek_jukteu_cafedra.php">Каф./ҒЗИ орт. ендіру</a></li>';
				  }
				  if($roleID=="5"){
					echo '<li><a href="engbek_jukteu_faculty.php">Фак./ҒЗО орт. ендіру</a></li>'; 
				  }
				  if($roleID=="2"){
					echo '<li><a href="engbek_jukteu_faculty.php">Фак./ҒЗО орт. ендіру</a></li>'; 
					echo '<li><a href="engbek_jukteu_cafedra.php">Каф./ҒЗИ орт. ендіру</a></li>';
					echo '<li><a href="enbek_jukteuopk.php">ОПҚ орт. ендіру</a></li>';
				  }
				  if($roleID=="6"){
					echo '<li><a href="engbek_jukteu_faculty.php">Фак./ҒЗО орт. ендіру</a></li>'; 
					echo '<li><a href="engbek_jukteu_cafedra.php">Каф./ҒЗИ орт. ендіру</a></li>';
					echo '<li><a href="enbek_jukteuopk.php">ОПҚ орт. ендіру</a></li>';
				  }
				  ?>
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