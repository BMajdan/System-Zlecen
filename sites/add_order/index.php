<?php 

    session_start();

    function getInfoNumber(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));
        try{
            include('../../components/connect.php');
            $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderTelephone="'.$tel.'" GROUP BY orderKNumber ORDER BY orderTelDate DESC');
            $stmt->execute();
            $orderCount = 0;
            $customerID = 0;
            echo '
                <table id="getInfoNumber">
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
                        echo '
                            <tr>
                                <td>'.($orderCount + 1).'</td>
                                <td>'.$row5["orderTelDate"].'</td>
                                <td>'.$row5["orderTelephone"].'</td>
                                <td>'.$name.'</td>
                                <td>'.str_replace("@", " ", $row5["orderAddress"]).'</td>
                                <td>'.$row5["orderDescription"].'</td>
                                <td>'.$row5["orderType"].'/'.$countComment.'/<i class="'.$color.'">'.$row5["orderStatus"].'</i></td>
                                <td><p><a href="../see_order/index.php?tel='.$row5["orderType"].'_'.$row5["orderID"].'_'.$row5["orderVersion"].'">Zobacz więcej</a></p></td>
                            </tr>';
                            $orderCount++;
                    }
                }
            }
            echo "</table>";
            echo '<input type="hidden" name="customerID" value="'.$customerID.'" />';
                if($orderCount == 0){
                    echo "<span id='badWorker'>Numer nie jest wpisany do bazy!</span>";
                    echo '<input type="hidden" name="checkUser" value="newUser" />';
                }else{
                    echo '<input type="hidden" name="checkUser" value="isUser" />';
                }

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getAddressInfo(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));
        try{
            include('../../components/connect.php');
            $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderType="Naprawa" AND orderTelephone="'.$tel.'" GROUP BY orderAddress');
            $stmt->execute();
            $orderCount = 0;
            echo '
                    <table id="getAddressInfo">
                        <tr>
                            <td><strong>LP: </strong></td>
                            <td><strong>Imię i nazwisko: </strong></td>
                            <td><strong>Adres klienta:</strong> </td>
                            <td><strong>Link: </strong></td>
                        </tr>';
            while($row = $stmt->fetch()){

                $stmt2 = $pdo->prepare('SELECT customerFname, customerLname, customerID FROM customers WHERE customerNumber="'.$row["orderTelephone"].'"');
                $stmt2->execute();
                while($row2 = $stmt2->fetch()){
                    $name = $row2["customerFname"]." ".$row2["customerLname"];
                    $id = $row2["customerID"];
                }

                echo '
                        <tr>
                            <td>'.($orderCount + 1).'</td>
                            <td>'.$name.'</td>
                            <td>'.str_replace("@", " ", $row["orderAddress"]).'<input type="hidden" id="address@'.$orderCount.'" value="'.$row["orderAddress"].'"/></td>
                            <td><p><a class="getAddress" id="butadr@'.$orderCount.'">Wybierz >></a></p></td>
                        </tr>';
                $orderCount++;
            }

            echo "</table>";
            if($orderCount == 0){
                echo "<span id='badWorker'>Adres nie jest wpisany do bazy!</span>";
            }

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getInput(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));
        if($type == "O"){
            echo '<input type="text" id="phoneNumber" name="phoneNumber" value="'.$tel.'"><input type="hidden" id="identType" value="O">';
        }else if($type == "Q"){
            echo '<input type="text" id="phoneNumber" name="phoneNumber" value="'.$tel.'"><input type="hidden" id="identType" value="Q">';
        }
        
    }

    function getRadio(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));
        if($type == "O"){
            echo '                          
                <input type="radio" checked name="orderType" value="O"> Zlecenie naprawy<br>
                <input type="radio" name="orderType" value="Q"> Zapytanie<br>';
        }else if($type == "Q"){
            echo '                          
                <input type="radio" name="orderType" value="O"> Zlecenie naprawy<br>
                <input type="radio" checked name="orderType" value="Q"> Zapytanie<br>';
        }
    }

    function getWebsite(){

        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));
        include('header.php');
        if($type == "O"){
            include('bodyO.php');
        }else if($type == "Q"){
            include('bodyQ.php');
        }
        include('footer.php');
    }
    
    if (!isset($_SESSION['userLogged'])){
        header('Location: ../login_panel/index.php');
        exit();
    }

    function getName(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));

        include('../../components/connect.php');

        try{
            $stmt2 = $pdo->prepare('SELECT customerFname, customerLname, customerID FROM customers WHERE customerNumber="'.$tel.'"');
            $stmt2->execute();
            $cont = 0;
            while($row2 = $stmt2->fetch()){

                echo '<div class="col-md-6"><p class="addressLabel">Imię: <span class="requir">*</span></p><input style="width: 100%;" type="text" required name="name" value="'.$row2["customerFname"].'" disabled></div>
                    <div class="col-md-6"><p class="addressLabel">Nazwisko: <span class="requir">*</span></p><input style="width: 100%;" type="text" required name="Lname" value="'.$row2["customerLname"].'" disabled></div>';

                    $cont++;
            }

            if($cont == 0){
                echo '<div class="col-md-6"><p class="addressLabel">Imię: <span class="requir">*</span></p><input style="width: 100%;" type="text" required name="name"></div>
                    <div class="col-md-6"><p class="addressLabel">Nazwisko: <span class="requir">*</span></p><input style="width: 100%;" type="text" required name="Lname"></div>';
            }
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }

    }

    function getStatus(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));

        include('../../components/connect.php');

        try{
            $stmt2 = $pdo->prepare('SELECT * FROM orderstatus');
            $stmt2->execute();
            while($row2 = $stmt2->fetch()){

                if($row2['statusName'] == "Open"){
                    echo '<option selected>'.$row2['statusName'].'</option>';
                }else{
                    echo '<option>'.$row2['statusName'].'</option>';
                }
                
            }
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getEmpl(){
        $data = $_GET["tel"];
        $type = substr($data, 0, 1);
        $tel = substr($data, 1, strlen ($data));

        include('../../components/connect.php');

        try{
            $stmt2 = $pdo->prepare('SELECT * FROM employee');
            $stmt2->execute();
            while($row2 = $stmt2->fetch()){

                if($row2['emplName'] == "Kierowca"){
                    echo '<option selected>'.$row2['emplName'].'</option>';
                }else{
                    echo '<option>'.$row2['emplName'].'</option>';
                }
                
            }
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    getWebsite();

?>