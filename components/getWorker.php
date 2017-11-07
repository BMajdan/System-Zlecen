<?php 

    function getWorker(){
        try{
            $workerOrder = $_GET['workerOrder'];
            include('connect.php');
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

                        $stmt4 = $pdo->prepare('SELECT * FROM orders WHERE orderID = "'.$row5["orderID"].'" AND orderWorker="'.$workerOrder.'"');
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

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    session_start();
    if (!isset($_SESSION['userLogged'])){
        header('Location: sites/login_panel/index.php');
        exit();
    }

    getWorker();

?>