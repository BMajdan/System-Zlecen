	<div id="site" class="container-fluid">
		<form method="post" action="../../components/addQuestion.php">
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
						<span id="numberInfo" class="green"> Numer telefonu: <br></span> <?php getInput(); ?><span id="changeNumber">Zmień <i class="fa fa-retweet" aria-hidden="true"></i></span>
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
							<div class="row" >
								<div id="select" class="neworderright col-md-12">
									<div id="telephone" class="row" style="margin-top: -15px; padding-top: 0">

										<div class="row">
											<div class="col-md-6">
												<?php getName(); ?>
											</div>
											<div class="col-md-6"><p class="addressLabel">Data telefonu: <span class="requir">*</span></p>
												<input type="text" name="teldate" required id="teldate"> @ <input type="text" name="teltime" required id="teltime">
											</div>
										</div>

										
									</div>
								</div>
							</div>

							<div class="row" >
								<div class="neworderleft col-md-12" style="margin: 0; padding: 0">
									<div class="col-md-12">
										<p class="addressLabel">Opis Zapytania: <span class="requir">*</span></p><textarea name="description" required></textarea>
									</div>
								</div>
								<div class="neworderleft col-md-12" style="margin: 0; padding: 0">
									<div class="col-md-12">
										<p class="addressLabel">Komentarz ukryty:</p><textarea name="hiddencomment"></textarea>
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
