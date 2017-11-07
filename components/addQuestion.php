<?php 
    if($_POST['checkUser'] == "isUser"){
        addExUser();
    }else{
        addNewUser();
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

                    $sql = "INSERT INTO orders (orderKNumber, orderTelDate, orderTelephone, orderCustomer, orderAddress, orderDescription, orderType, orderStatus, hiddenComment, orderVersion) VALUES (:knumber, :oteldate, :telephone, :customer, :address, :desription, :type, :status, :hidden, :version)";

                    $code = intval(getid()) + 1;
                    

                    if($_POST['orderType'] == "O"){
                        $typeO = "Naprawa";
                    }else{
                        $typeO = "Zapytanie";
                    }

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                        ":knumber" => "KEX#".date("Y")."#".$code."#".$_POST['orderType'],
                        ":oteldate" => $_POST['teldate']."@".$_POST['teltime'],
                        ":telephone" => $_POST['phoneNumber'],
                        ":customer" => getCustomerID(),
                        ":address" => "-",
                        ":desription" => $_POST['description'],
                        ":type" => $typeO,
                        ":status" => "-",
                        ":hidden" => $_POST['hiddencomment'],
                        ":version" => "1"
                    ));

                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);

            }catch(PDOException $e){
                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);
            }
    }

    function addExUser(){

		include('connect.php');

            try{

                	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                	$version = 1;

                    $sql = "INSERT INTO orders (orderKNumber, orderTelDate, orderTelephone, orderCustomer, orderAddress, orderDescription, orderType, orderStatus, hiddenComment, orderVersion) VALUES (:knumber, :oteldate, :telephone, :customer, :address, :desription, :type, :status, :hidden, :version)";

                    $code = intval(getid()) + 1;
                    

                   	if($_POST['orderType'] == "O"){
                    	$typeO = "Naprawa";
                    }else{
                    	$typeO = "Zapytanie";
                    }

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                    	":knumber" => "KEX#".date("Y")."#".$code."#".$_POST['orderType'],
	                    ":oteldate" => $_POST['teldate']."@".$_POST['teltime'],
	                    ":telephone" => $_POST['phoneNumber'],
                        ":customer" => $_POST['customerID'],
                        ":address" => "-",
	                    ":desription" => $_POST['description'],
	                    ":type" => $typeO,
                        ":status" => "-",
	                    ":hidden" => $_POST['hiddencomment'],
                        ":version" => "1"
	                ));

                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);

            }catch(PDOException $e){
                    header('Location: ../sites/add_order/index.php?tel=O'.$_POST['phoneNumber']);
            }
    }
 ?>