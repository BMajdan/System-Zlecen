<?php 

    function getNumber(){
        
        try{
            $customerNumber = intval($_GET['customerNumber']);
            include('connect.php');
            $stmt = $pdo->prepare('SELECT * FROM customers WHERE customerNumber="'.$customerNumber.'"');
            $stmt->execute();
            $customerCount = 0;

            while($row = $stmt->fetch()){


                $stmt2 = $pdo->prepare('SELECT * FROM orders WHERE orderCustomer='.$row["customerID"].' AND orderType="Naprawa" GROUP BY orderKNumber');
                $stmt2->execute();
                $orderCount = 0;
                while($row2 = $stmt2->fetch()){
                    $orderCount++;
                }

                $stmt3 = $pdo->prepare('SELECT * FROM orders WHERE orderCustomer='.$row["customerID"].' AND orderType="Zapytanie" GROUP BY orderKNumber');
                $stmt3->execute();
                $questionCount = 0;
                while($row3 = $stmt3->fetch()){
                    $questionCount++;
                }

                echo '
                    <table id="searchNumber">
                        <tr>
                            <td><strong>Imię: </strong></td>
                            <td><strong>Nazwisko:</strong> </td>
                            <td><strong>Telefon:</strong> </td>
                            <td><strong>Ilość zleceń/zapytań: </strong></td>
                        </tr>
                        <tr>
                            <td>'.$row["customerFname"].'</td>
                            <td>'.$row["customerLname"].'</td>
                            <td>'.$row["customerNumber"].'</td>
                            <td>'.$orderCount.'/'.$questionCount.'</td>
                        </tr>
                    </table>
                    <p id="goodNumber"><span class="orange"><a href="sites/add_order/index.php?tel=O'.$customerNumber.'">Dodaj zlecenie/zapytanie <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></span></p>';
                $customerCount++;
            }

            if($customerCount == 0){
                echo "<p id='badNumber'>Podany numer nie istnieje w bazie. <br><span class='orange'><a href='sites/add_order/index.php?tel=O".$customerNumber."'>Dodaj numer <i class='fa fa-angle-double-right' aria-hidden='true'></a></i></span></p>";
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

    getNumber();

?>