<?php 

	session_start();

		include('connect.php');

            try{
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dane=$_POST['dane'];
                $customerCount = 0;
                if($dane["type"] == "address"){
                	echo '
                		<table id="searchAdvNumber">
	                       	<tr>
	                            <td><strong>Imię: </strong></td>
	                            <td><strong>Nazwisko:</strong> </td>
	                           	<td><strong>Telefon:</strong> </td>
	                           	<td><strong>Link:</strong></td>
	                        </tr>';
                	$stmt2 = $pdo->prepare('SELECT * FROM orders WHERE orderAddress="'.$dane["address"].'" GROUP BY orderKNumber');
                	$stmt2->execute();
                	while($row2 = $stmt2->fetch()){
                		$stmt3 = $pdo->prepare('SELECT * FROM customers WHERE customerID="'.$row2["orderCustomer"].'" GROUP BY customerID');
                		$stmt3->execute();
                		while($row3 = $stmt3->fetch()){
                			echo '
                        		<tr>
                            		<td>'.$row3["customerFname"].'</td>
                            		<td>'.$row3["customerLname"].'</td>
                            		<td>'.$row3["customerNumber"].'</td>
                            		<td><a href="sites/add_order/index.php?tel=O'.$row3["customerNumber"].'">Więcej >></i></a></td>
                        		</tr>';
                    		$customerCount++;
                		}
                	}

                	echo "</table>";
                	if($customerCount == 0){
                		echo "<p id='badNumber'>Brak danych w bazie. <br></p>";
            		}
                }else if($dane["type"] == "dev"){
		            $stmt = $pdo->prepare('SELECT * FROM orders GROUP BY orderKNumber ORDER BY orderTelDate DESC');
		            $stmt->execute();
		            $orderCount = 0;
		            $customerID = 0;
		            echo '
		                    <table id="getTwOrders">
		                        <tr>
		                            <td><strong>LP: </strong></td>
		                            <td><strong>Data telefonu:</strong> </td>
		                            <td><strong>Telefon:</strong> </td>
		                            <td><strong>Imię i nazwisko: </strong></td>
		                            <td><strong>Adres zlecenia:</strong> </td>
		                            <td><strong>Opis: </strong></td>
		                            <td><strong>Typ/Komentarze/Status: </strong></td>
		                            <td><strong>Link: </strong></td>
		                        </tr>';
		            while($row = $stmt->fetch()){

		                $stmt5 = $pdo->prepare('SELECT MAX(orderVersion) AS "orderVersion" FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'"');
		                $stmt5->execute();
		                while($row5 = $stmt5->fetch()){
		                    $stmt5 = $pdo->prepare('SELECT * FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'" AND orderVersion="'.$row5['orderVersion'].'"');
		                    $stmt5->execute();
		                    while($row5 = $stmt5->fetch()){

		                        if($row5["orderStatus"] == "Open"){
		                            $color = "green";
		                        }else if($row5["orderStatus"] == "Closed"){
		                            $color = "red";
		                        }else{
		                            $color = "yellow";
		                        }

		                        $stmt2 = $pdo->prepare('SELECT customerFname, customerLname, customerID FROM customers WHERE customerNumber="'.$row5["orderTelephone"].'"');
		                        $stmt2->execute();
		                        while($row2 = $stmt2->fetch()){
		                            $name = $row2["customerFname"]." ".$row2["customerLname"];
		                            global $customerID;
		                            $customerID = $row2["customerID"];
		                        }

		                        $stmt3 = $pdo->prepare('SELECT * FROM orderscomments WHERE commentKNumber="'.$row5["orderKNumber"].'"');
		                        $stmt3->execute();
		                        $countComment = 0;
		                        while($row3 = $stmt3->fetch()){
		                            $countComment++;
		                        }

		                        $stmt4 = $pdo->prepare('SELECT * FROM orders WHERE orderID = "'.$row5["orderID"].'" AND orderDate LIKE "'.$dane["deliveryDate"].'%"');
		                        $stmt4->execute();
		                        $countComment = 0;
		                        while($row4 = $stmt4->fetch()){
		                        echo '
		                            <tr>
		                                <td>'.($orderCount + 1).'</td>
		                                <td>'.$row4["orderTelDate"].'</td>
		                                <td>'.$row4["orderTelephone"].'</td>
		                                <td>'.$name.'</td>
		                                <td>'.str_replace("@", " ", $row4["orderAddress"]).'</td>
		                                <td>'.$row4["orderDescription"].'</td>
		                                <td>'.$row4["orderType"].'/'.$countComment.'/<i class="'.$color.'">'.$row4["orderStatus"].'</i></td>
		                                <td><p><a href="sites/see_order/index.php?tel='.$row4["orderType"].'_'.$row4["orderID"].'_'.$row4["orderVersion"].'">Zobacz więcej</a></p></td>
		                            </tr>';
		                            $orderCount++;
		                        }
		                    }
		                }
		            }

		            echo "</table>";
		            echo '<input type="hidden" name="customerID" value="'.$customerID.'" />';
		            if($orderCount == 0){
		                echo "<span id='badWorker'>Brak ostatnich zleceń!</span>";
		            }

            }else{
		            $stmt = $pdo->prepare('SELECT * FROM orders GROUP BY orderKNumber ORDER BY orderTelDate DESC');
		            $stmt->execute();
		            $orderCount = 0;
		            $customerID = 0;
		            echo '
		                    <table id="getTwOrders">
		                        <tr>
		                            <td><strong>LP: </strong></td>
		                            <td><strong>Data telefonu:</strong> </td>
		                            <td><strong>Telefon:</strong> </td>
		                            <td><strong>Imię i nazwisko: </strong></td>
		                            <td><strong>Adres zlecenia:</strong> </td>
		                            <td><strong>Opis: </strong></td>
		                            <td><strong>Typ/Komentarze/Status: </strong></td>
		                            <td><strong>Link: </strong></td>
		                        </tr>';
		            while($row = $stmt->fetch()){

		                $stmt5 = $pdo->prepare('SELECT MAX(orderVersion) AS "orderVersion" FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'"');
		                $stmt5->execute();
		                while($row5 = $stmt5->fetch()){
		                    $stmt5 = $pdo->prepare('SELECT * FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'" AND orderVersion="'.$row5['orderVersion'].'"');
		                    $stmt5->execute();
		                    while($row5 = $stmt5->fetch()){

		                        if($row5["orderStatus"] == "Open"){
		                            $color = "green";
		                        }else if($row5["orderStatus"] == "Closed"){
		                            $color = "red";
		                        }else{
		                            $color = "yellow";
		                        }

		                        $stmt2 = $pdo->prepare('SELECT customerFname, customerLname, customerID FROM customers WHERE customerNumber="'.$row5["orderTelephone"].'"');
		                        $stmt2->execute();
		                        while($row2 = $stmt2->fetch()){
		                            $name = $row2["customerFname"]." ".$row2["customerLname"];
		                            global $customerID;
		                            $customerID = $row2["customerID"];
		                        }

		                        $stmt3 = $pdo->prepare('SELECT * FROM orderscomments WHERE commentKNumber="'.$row5["orderKNumber"].'"');
		                        $stmt3->execute();
		                        $countComment = 0;
		                        while($row3 = $stmt3->fetch()){
		                            $countComment++;
		                        }

		                        $stmt4 = $pdo->prepare('SELECT * FROM orders WHERE orderID = "'.$row5["orderID"].'" AND orderTelDate LIKE "'.$dane["telephoneDate"].'%"');
		                        $stmt4->execute();
		                        $countComment = 0;
		                        while($row4 = $stmt4->fetch()){
		                        echo '
		                            <tr>
		                                <td>'.($orderCount + 1).'</td>
		                                <td>'.$row4["orderTelDate"].'</td>
		                                <td>'.$row4["orderTelephone"].'</td>
		                                <td>'.$name.'</td>
		                                <td>'.str_replace("@", " ", $row4["orderAddress"]).'</td>
		                                <td>'.$row4["orderDescription"].'</td>
		                                <td>'.$row4["orderType"].'/'.$countComment.'/<i class="'.$color.'">'.$row4["orderStatus"].'</i></td>
		                                <td><p><a href="sites/see_order/index.php?tel='.$row4["orderType"].'_'.$row4["orderID"].'_'.$row4["orderVersion"].'">Zobacz więcej</a></p></td>
		                            </tr>';
		                            $orderCount++;
		                        }
		                    }
		                }
		            }

		            echo "</table>";
		            echo '<input type="hidden" name="customerID" value="'.$customerID.'" />';
		            if($orderCount == 0){
		                echo "<span id='badWorker'>Brak ostatnich zleceń!</span>";
		            }
            }
        }catch(PDOException $e){
        }
 ?>