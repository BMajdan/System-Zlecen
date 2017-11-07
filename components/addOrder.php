<?php

    session_start();
    if($_POST['checkUser'] == "isUser"){
        addExUser();
    }else{
        addNewUser();
    } 

	function addNewUser(){
        include('connect.php');

            try{

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $version = 1;

                    $sql = "INSERT INTO customers (customerFname, customerLname, customerNumber) VALUES (:fname, :lname, :telnumber)";

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                        ":fname" => $_POST['name'],
                        ":lname" => $_POST['Lname'],
                        ":telnumber" => $_POST['phoneNumber']
                    ));

                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);

            }catch(PDOException $e){
               header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);
            }

            try{

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $version = 1;

                    $sql = "INSERT INTO orders (orderKNumber, orderDate, orderTelDate, orderTelephone, orderCustomer, orderAddress, orderDescription, orderType, orderStatus, orderWorker, orderVersion, hiddenComment, versionUser) VALUES (:knumber, :data, :oteldate, :telephone, :customer, :address, :desription, :type, :status, :worker, :version, :hidden, :versionUser)";

                    $code = intval(getid()) + 1;
                    

                    if($_POST['orderType'] == "O"){
                        $typeO = "Naprawa";
                    }else{
                        $typeO = "Zapytanie";
                    }

                    if(!isset($_POST['flat']) || $_POST['flat'] == ""){
                        $adr = $_POST['street'].'@'.$_POST['house'];
                    }else{
                        $adr = $_POST['street'].'@'.$_POST['house'].'/'.$_POST['flat'];
                    }

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                        ":knumber" => "KEX#".date("Y")."#".$code."#".$_POST['orderType'],
                        ":data" => $_POST['recdate']."@".$_POST['rectime'],
                        ":oteldate" => $_POST['teldate']."@".$_POST['teltime'],
                        ":telephone" => $_POST['phoneNumber'],
                        ":customer" => getCustomerID(),
                        ":address" => $adr,
                        ":desription" => $_POST['description'],
                        ":type" => $typeO,
                        ":status" => $_POST['status'],
                        ":worker" => $_POST['worker'],
                        ":version" => $version,
                        ":hidden" => $_POST['hiddencomment'],
                        ":versionUser" => $_SESSION['userName']
                    ));
                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);

                }catch(PDOException $e){
                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);
                }
    }

	function getid(){

        try{
            include('connect.php');

        	$stmt = $pdo->prepare('SELECT orderID FROM orders ORDER BY orderID DESC LIMIT 0,1');
        	$stmt->execute();
        	while($row = $stmt->fetch()){
            	return  $row['orderID'];
        	}
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
	}

    function getCustomerID(){

        try{
            include('connect.php');

            $stmt = $pdo->prepare('SELECT customerID FROM customers ORDER BY customerID DESC LIMIT 0,1');
            $stmt->execute();
            while($row = $stmt->fetch()){
                return  $row['customerID'];
            }
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function addExUser(){

		include('connect.php');

            try{

                	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                	$version = 1;

                    $sql = "INSERT INTO orders (orderKNumber, orderDate, orderTelDate, orderTelephone, orderCustomer, orderAddress, orderDescription, orderType, orderStatus, orderWorker, orderVersion, hiddenComment, versionUser) VALUES (:knumber, :data, :oteldate, :telephone, :customer, :address, :desription, :type, :status, :worker, :version, :hidden, :versionUser)";

                    $code = intval(getid()) + 1;
                    

                   	if($_POST['orderType'] == "O"){
                    	$typeO = "Naprawa";
                    }else{
                    	$typeO = "Zapytanie";
                    }

                    if(!isset($_POST['flat']) || $_POST['flat'] == ""){
                    	$adr = $_POST['street'].'@'.$_POST['house'];
                    }else{
                    	$adr = $_POST['street'].'@'.$_POST['house'].'/'.$_POST['flat'];
                    }

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                    	":knumber" => "KEX#".date("Y")."#".$code."#".$_POST['orderType'],
	                    ":data" => $_POST['recdate']."@".$_POST['rectime'],
	                    ":oteldate" => $_POST['teldate']."@".$_POST['teltime'],
	                    ":telephone" => $_POST['phoneNumber'],
	                    ":customer" => $_POST['customerID'],
	                    ":address" => $adr,
	                    ":desription" => $_POST['description'],
	                    ":type" => $typeO,
	                    ":status" => $_POST['status'],
	                    ":worker" => $_POST['worker'],
	                    ":version" => $version,
	                    ":hidden" => $_POST['hiddencomment'],
                        ":versionUser" => $_SESSION['userName']
	                ));

                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);

                }catch(PDOException $e){
                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);
                }
    }
 ?>