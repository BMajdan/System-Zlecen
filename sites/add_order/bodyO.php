	<div id="site" class="container-fluid">
	<form method="post" action="../../components/addOrder.php">
		<div class="row">

			<div class="header-main">
				<p id="loginName">Witaj: <i class="orange"><?php echo strtoupper($_SESSION['userName']) ?></i></p>
				<p id="logout"><a href="../../components/logout.php">Wyloguj</a></p>	
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-phone" aria-hidden="true"></i><i class="orange"> Lista zapytań/napraw powiązanych z numerem: </i></p>
						<div style="max-height: 400px; overflow-y: scroll;">
							<?php  getInfoNumber(); ?>
						</div>
					</div>
				</div>
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<p><i class="fa fa-plus" aria-hidden="true"></i><i class="orange"> Dodaj zgłoszenie zapytania/naprawy: </i></p><br>
					<div class="col-md-6">
						<span id="numberInfo" class="green"> Numer telefonu: <br></span> <?php getInput(); ?><a><span id="changeNumber">Zmień <i class="fa fa-retweet" aria-hidden="true"></i></span></a>
					</div>
					<div class="col-md-6">
						<span class="green">Typ zgłoszenia:</span><br>
							<?php getRadio(); ?>
					</div>
				</div>
			</div>

			<br><hr><br>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p><i class="fa fa-address-card" aria-hidden="true"></i><i class="orange"> Adresy powiązane z numerem: </i></p>
						<div style="max-height: 400px; overflow-y: scroll;">
							<?php  getAddressInfo(); ?>
						</div>
							<div class="row">
								<div class="neworderleft col-md-6">
									<div id="address" class="row">
										<div class="col-md-4"><p class="addressLabel">Ulica: <span class="requir">*</span></p><input type="text" required name="street" id="street"></div>
										<div class="col-md-4"><p class="addressLabel">Nr Domu: <span class="requir">*</span></p><input type="text" required name="house" id="house"></div>
										<div class="col-md-4"><p class="addressLabel">Nr Mieszkania: </p><input type="text" name="flat" id="flat"></div>
									</div>

									<div class="row">
										<?php getName(); ?>
									</div>
								</div>
								<div class="neworderright col-md-6">
									<div id="telephone" class="row">
										<div class="col-md-12"><p class="addressLabel">Data telefonu: <span class="requir">*</span></p>
											<input type="text" required name="teldate" id="teldate"> @ <input id="teltime" required type="text" name="teltime">
										</div>
									</div>

									<div class="row">
										<div class="col-md-12"><p class="addressLabel">Data odbioru sprzętu:</p>
											<input type="text"  id="recdate" name="recdate"> @ <input type="text" id="rectime" name="rectime">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="neworderleft col-md-6">
									<div class="row">
										<div class="col-md-12"><p class="addressLabel">Opis usterki: <span class="requir">*</span></p><textarea name="description" required></textarea></div>
									</div>

								</div>

								<div class="neworderright col-md-6">
									<div class="row">
										<div class="col-md-12"><p class="addressLabel">Przypisany do: <span class="requir">*</span></p>
											<select name="worker" required>
												<?php getEmpl(); ?>
											</select>
										</div>
									</div>
								</div>

							</div>

							<div class="row">

								<div class="neworderleft col-md-6">
									<div class="row">
										<div class="col-md-12"><p class="addressLabel">Komentarz ukryty: </p><textarea name="hiddencomment"></textarea></div>
									</div>
								</div>

								<div class="neworderright col-md-6">
									<div class="row">
										<div class="col-md-12"><p class="addressLabel">Status: <span class="requir">*</span></p>
											<select name="status" required>
												<?php getStatus(); ?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<hr><br>

							<div class="row">
								<div class="buttonss col-md-12">
									<input type="submit" id="backButton" value="<< Powrót">
									<input type="submit" id="sendButton" value="Wyślij >>">
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>