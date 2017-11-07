<?php 

    session_start();
    changeOrderData();
    changeHardData();

    function changeOrderData(){

		include('connect.php');

            try{

                	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                	$dane=$_POST['dane'];

                	$version = intval($dane['lastVersion']) + 1;

                    $sql = "INSERT INTO orders (orderKNumber, orderDate, orderTelDate, orderTelephone, orderCustomer, orderAddress, orderDescription, orderType, orderStatus, orderWorker, orderVersion, hiddenComment, versionUser) VALUES (:knumber, :data, :oteldate, :telephone, :customer, :address, :desription, :type, :status, :worker, :version, :hidden, :versionUser)";

                   	if($dane['orderType'] == "O"){
                    	$typeO = "Naprawa";
                    }else{
                    	$typeO = "Zapytanie";
                    }

                    if(!isset($dane['flat']) || $dane['flat'] == ""){
                    	$adr = $dane['street'].'@'.$dane['house'];
                    }else{
                    	$adr = $dane['street'].'@'.$dane['house'].'/'.$dane['flat'];
                    }

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                    	":knumber" => $dane['orderKNumber'],
	                    ":data" => $dane['recdate']."@".$dane['rectime'],
	                    ":oteldate" => $dane['teldate']."@".$dane['teltime'],
	                    ":telephone" => $dane['phoneNumber'],
	                    ":customer" => $dane['customerID'],
	                    ":address" => $adr,
	                    ":desription" => $dane['description'],
	                    ":type" => $typeO,
	                    ":status" => $dane['status'],
	                    ":worker" => $dane['worker'],
	                    ":version" => $version,
	                    ":hidden" => $dane['hiddencomment'],
	                    ":versionUser" => $_SESSION['userName']
	                ));
                    //header('Location: ../sites/see_order/index.php?tel='.$daneT['typeEdit']);

                }catch(PDOException $e){
                    //header('Location: ../sites/see_order/index.php?tel='.$dane['typeEdit']);
                }
        }

        function changeHardData(){
        include('connect.php');

            try{

                    $dane=$_POST['dane'];
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $version = intval($dane['lastVersion']) + 1;

                    $sql = "INSERT INTO hardware (hardBrand, hardModel, hardSN, hardWarning, hardDown, hardKNumber, hardOrderVersion, versionUser) VALUES (:hardBrand, :hardModel, :hardSN, :hardWarning, :hardDown, :hardKNumber, :hardOrderVersion, :versionUser)";

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                        ":hardBrand" => $dane['hardBrand'],
                        ":hardModel" => $dane['hardModel'],
                        ":hardSN" => $dane['hardSN'],
                        ":hardWarning" => $dane['hardWarning'],
                        ":hardDown" => $dane['hardDown'],
                        ":hardKNumber" => $dane['orderKNumber'],
                        ":hardOrderVersion" => $version,
                        ":versionUser" => $_SESSION['userName']
                    ));
                    //header('Location: ../sites/see_order/index.php?tel='.$daneT['typeEdit']);

                }catch(PDOException $e){
                    //header('Location: ../sites/see_order/index.php?tel='.$dane['typeEdit']);
                }
        }
 ?>