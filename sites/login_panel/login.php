<?php

	session_start();
	
	if ((!isset($_POST['userLogin'])) || (!isset($_POST['userPassword'])))
	{
		header('Location: index.php');
		exit();
	}

    function loginToPanel(){

        try{
            
            $userLogin=$_POST['userLogin'];
            $userPassword=$_POST['userPassword'];

            include('../../components/connect.php');

            $stmt = $pdo->prepare('SELECT userLogin, userPassword, userLastLogin, userPermission FROM users WHERE userLogin="'.$userLogin.'"');
            $stmt->execute();

            while($row = $stmt->fetch()){

              if( $row['userLogin'] == $userLogin && password_verify($userPassword, $row['userPassword'])){
                $stmt->closeCursor();
                $_SESSION['userName'] = $userLogin;
                $_SESSION['userPermission'] = $row['userPermission'];
                $_SESSION['userLastLogin'] = $row['userLastLogin'];

                $sql = "UPDATE `users` SET `userLastLogin` = :lastlogin WHERE userLogin = :login";
                $statement = $pdo->prepare($sql);
                $statement->bindValue(":lastlogin", date('d-m-y')."@".date('H:i:s'));
                $statement->bindValue(":login", $_SESSION['userName']);
                $pdo = $statement->execute();
                $pdo = null;

                return true;
              }else{
                $stmt->closeCursor();
                return false;
              }
            }

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }

    }

    if(loginToPanel() == true){

        $_SESSION['userLogged'] = true;
		unset($_SESSION['userBadLogin']);
		header('Location: ../../index.php');

    }else{
        $_SESSION['userBadLogin'] = '<a class="bad">Błędny login lub hasło.</a>';
		header('Location: index.php');
    }
	
?>