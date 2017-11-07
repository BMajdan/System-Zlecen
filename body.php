	<div class="container-fluid">
		<div class="row">

			<div class="header-main">
				<p id="loginName">Witaj: <i class="orange"><?php echo strtoupper($_SESSION['userName']) ?></i></p>
				<p id="logout"><a href="components/logout.php">Wyloguj</a></p>	
			</div>

			<br><br><br><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-search" aria-hidden="true"></i><i class="orange"> Wyszukiawnie numeru telefonu:</i></p>
						<div class="search-box">
							<form>
								<input type="text" id="inputSearchNumber" placeholder="Wpisz numer..." autofocus="">				
							</form>
						</div>
					</div>
					<div id="ifNumberResult" class="col-md-12"></div>
				</div>
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<p><i class="fa fa-search-plus" aria-hidden="true"></i><i class="orange"> Wyszukiwanie zaawansowane: </i></p><br><br>
						<span id="setting"> Opcja: </span> 
						<select name="advancedSearchSetting" id="advancedSearchSetting">
							<option selected value="address">Adres</option>
			  				<option value="deliveryDate">Data odebrania sprzętu</option>
			  				<option value="telephoneDate">Data telefonu</option>
						</select>
						<div id="searchForm">
							<div id="changeSearch">
								<div id="firstInputD" class="inputs">
									<p id="firstInputP">Adres: </p> <input id="firstInput" type="text" placeholder="Kobierzyńska@57/6" name="firstInput"><br>
								</div>
							</div>
						</div>
						<br><p><a id="searchButton">Wyszukaj <i class="fa fa-search" aria-hidden="true"></i></a></p>
					</div>
					<div id="ifAdvResult" class="col-md-12"></div>
				</div>
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-briefcase" aria-hidden="true"></i><i class="orange"> Ostatnio rozpoczęte naprawy/zapytania: </i></p><br><br>
						<div style="max-height: 400px; overflow-y: scroll;">
							<?php getOrders(); ?>
						</div>
						<br><br>
						<a href="sites/show_all/index.php?tel=Naprawa@All"><span id='allRepair'>Zobacz wszystkie naprawy <i class='fa fa-angle-double-right' aria-hidden='true'></i></span></a>
						<a href="sites/show_all/index.php?tel=Zapytanie@-"><span id='allInquiry'>Zobacz wszystkie zapytania <i class='fa fa-angle-double-right' aria-hidden='true'></i></span></a>
					</div>
				</div>
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-briefcase" aria-hidden="true"></i><i class="orange"> Pokaż zlecenia przypisane do pracownika: </i></p><br><br>
						<span>Wybierz pracownika: </span>
						<select id="workerSelect">
							<?php getEmpl(); ?>
						</select>
						<div id="ifOrderResult" style="max-height: 400px; overflow-y: scroll;"></div>
					</div>
				</div>
			</div>

			<br><hr><br>

			<div id="stats" class="container">
				<div class="row">
					<div class="col-md-12">
						<p> <i class="fa fa-bar-chart" aria-hidden="true"></i><i class="orange"> Statystyki: </i></p><br><br>
							<span>Otwarte naprawy: </span><i><a href="sites/show_all/index.php?tel=Naprawa@Open"><?php getStat("Naprawa", "Open")?></a></i><br>
							<span>Zamknięte naprawy: </span><i><a href="sites/show_all/index.php?tel=Naprawa@Closed"><?php getStat("Naprawa", "Closed")?></a></i><br>
							<span>Zapytania: </span><i><a href="sites/show_all/index.php?tel=Zapytanie@-"><?php getStat("Zapytanie", "-")?></a></i>
					</div>
				</div>
			</div>
			<br><hr><br>
		</div>
	</div>
	
		
		                     