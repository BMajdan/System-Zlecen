<?php

	session_start();
	
	session_unset();
	
	header('Location: ../sites/login_panel/index.php');

?>