
	<div id="site" class="container-fluid">
		<div class="row">

			<div class="header-main">
				<p id="loginName">Witaj: <i class="orange"><?php echo strtoupper($_SESSION['userName']) ?></i></p>
				<p id="logout"><a href="../../components/logout.php">Wyloguj</a></p>	
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-phone" aria-hidden="true"></i><i class="orange">Pokaż wszystkie 
							<?php 
								if($_GET['tel'] == "Naprawa"){
									echo "naprawy: ";
								}else if($_GET['tel'] == "Zapytanie"){
									echo "zaputania: ";
								} 
							?>  
						</i></p>
						<br>
						<?php getOrders(); ?>

						<br><br>
						<div id="backButton" class="buttons"><< Powrót</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	