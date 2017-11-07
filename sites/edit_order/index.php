<?php 

    session_start();

    $orderKNumber = "";
    $orderWorker = "";
    $orderStatus = "";
    $orderHidden = "";

    function getWebsite(){

        if($_GET["tel"] == "Powrót"){
            header('Location: ../../index.php');
        }

        $getData = explode("_", $_GET["tel"]);
        include('header.php');
        include('body.php');
        echo '<input type="hidden" name="typeEdit" id="typeEdit" value="'.$_GET["tel"].'">';

        echo '<input type="hidden" id="identVersion" value="'.$getData[0]."_".$getData[1].'">';
        include('footer.php');
    }
    
    if (!isset($_SESSION['userLogged'])){
        header('Location: ../login_panel/index.php');
        exit();
    }

    function getOrderData(){
        $getData = explode("_", $_GET["tel"]);
        include('../../components/connect.php');
        try{
            $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderID="'.$getData[1].'"');
            $stmt->execute();
            $orderCount = 0;
            while($row = $stmt->fetch()){
                $orderCount++;
                global $orderKNumber;
                $orderKNumber = $row['orderKNumber'];

                if($getData[0] == "Naprawa"){
                    echo '<input type="hidden" id="telInfo" value="O'.$row["orderTelephone"].'">';
                    echo '<input type="hidden" id="orderType" name="orderType" value="O">';
                }else if($getData[0] == "Zapytanie"){
                    echo '<input type="hidden" id="telInfo" value="Q'.$row["orderTelephone"].'">';
                    echo '<input type="hidden" id="orderType" name="orderType" value="Z">';
                }

                $stmt2 = $pdo->prepare('SELECT * FROM orders WHERE orderKNumber="'.$orderKNumber.'" AND orderVersion="'.$getData[2].'"');
                $stmt2->execute();
                while($row2 = $stmt2->fetch()){

                    global $orderWorker, $orderStatus;
                    $orderWorker = $row2['orderWorker'];
                    $orderStatus = $row2['orderStatus'];

                    $teldate = explode("@", $row2['orderTelDate']);
                    $recdate = explode("@", $row2['orderDate']);
                    $adr = explode("@", $row2['orderAddress']);

                    if(isset(explode("/", $adr[1])[1])){
                        $flat = explode("/", $adr[1]);
                    }else{
                        $flat[0] = $adr[1];
                        $flat[1] = "";
                    }

                    $stmt3 = $pdo->prepare('SELECT * FROM customers WHERE customerID="'.$row["orderCustomer"].'"');
                    $stmt3->execute();
                    while($row3 = $stmt3->fetch()){
                        echo '<input type="hidden" id="customerID" value="'.$row["orderCustomer"].'">';
                        $name = $row3["customerFname"];
                        $lName = $row3["customerLname"];
                    }

                    echo '
                            <p><i class="fa fa-phone" aria-hidden="true"></i><i class="orange"> Telefon: '.$row2['orderTelephone'].'</i></p>
                                <input type="hidden" id="phoneNumber" value="'.$row2['orderTelephone'].'">
                                <div class="row">
                                    <div class="neworderleft col-md-6">
                                        <div id="address" class="row">
                                            <div class="col-md-4"><p class="addressLabel">Ulica: </p><input id="street" value="'.$adr[0].'"></div>
                                            <div class="col-md-4"><p class="addressLabel">Nr Domu: </p><input id="house" value="'.$flat[0].'"></div>
                                            <div class="col-md-4"><p class="addressLabel">Nr Mieszkania: </p><input id="flat" value="'.$flat[1].'"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6"><p class="addressLabel">Imię: </p><input value="'.$name.'"></div>
                                            <div class="col-md-6"><p class="addressLabel">Nazwisko: </p><input value="'.$lName.'"></div>
                                        </div>
                                    </div>
                                    <div class="neworderright col-md-6" style="text-align: center;">
                                        <div id="telephone" class="row">
                                            <div class="col-md-12"><p class="addressLabel">Data telefonu: </p>
                                                <input type="text" id="teldate" value="'.$teldate[0].'"> @ <input type="text" id="teltime" value="'.$teldate[1].'">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12"><p class="addressLabel">Data odbioru sprzętu:</p>
                                                <input type="text" id="recdate" value="'.$recdate[0].'"> @ <input type="text" id="rectime" value="'.$recdate[1].'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    ';
            }
        }

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getQuestionData(){
        $getData = explode("_", $_GET["tel"]);
        include('../../components/connect.php');
        try{
            $stmt = $pdo->prepare('SELECT * FROM orders WHERE orderID="'.$getData[1].'"');
            $stmt->execute();
            $orderCount = 0;
            while($row = $stmt->fetch()){
                $orderCount++;

                if($getData[0] == "Naprawa"){
                    echo '<input type="hidden" id="telInfo" value="O'.$row["orderTelephone"].'">';
                    echo '<input type="hidden" id="orderType" name="orderType" value="O">';
                }else if($getData[0] == "Zapytanie"){
                    echo '<input type="hidden" id="telInfo" value="Q'.$row["orderTelephone"].'">';
                    echo '<input type="hidden" id="orderType" name="orderType" value="Z">';
                }
                if(isset($adr[1])){
                    $flat = explode("/", $adr[1]);
                }

                global $orderKNumber, $orderWorker, $orderStatus, $orderHidden;
                $orderKNumber = $row['orderKNumber'];
                $orderWorker = $row['orderWorker'];
                $orderStatus = $row['orderStatus'];
                $orderHidden = $row['hiddenComment'];
                $teldate = explode("@", $row['orderTelDate']);
                $recdate = explode("@", $row['orderDate']);

                echo '
                        <p><i class="fa fa-phone" aria-hidden="true"></i><i class="orange"> Telefon: '.$row['orderTelephone'].'</i></p>
                            
                            <div class="row">
                                <div class="neworderright col-md-12">
                                    <div id="telephone" class="row">
                                        <div class="col-md-6"><p class="addressLabel">Data zapytania: </p>
                                            <input type="text" value="'.$teldate[0].'"> @ <input type="text" value="'.$teldate[1].'">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"><p class="addressLabel">Zapytanie: </p>
                                            <textarea>'.$row["orderDescription"].'</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12"><p class="addressLabel">Komentarz ukryty: </p>
                                            <textarea id="hiddenComment">'.$row["hiddenComment"].'</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                ';
            }


        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getHardwareData(){
        $getData = explode("_", $_GET["tel"]);
        include('../../components/connect.php');
        try{
            global $orderKNumber;
            echo '<input type="hidden" name="orderKNumber" id="orderKNumber" value="'.$orderKNumber.'">';
            $stmt = $pdo->prepare('SELECT * FROM hardware WHERE hardKNumber="'.$orderKNumber.'" AND hardOrderVersion="'.$getData[2].'"');

            $stmt->execute();
            $hardCount = 0;
            while($row = $stmt->fetch()){
                $hardCount++;
                echo '
                    <div class="row">
                            <div class="neworderleft col-md-12">
                                <div id="address" class="row">
                                    <div class="col-md-4"><p class="addressLabel">Marka: </p><input autocomplete="on" id="hardBrand" value="'.$row["hardBrand"].'"></div>
                                    <div class="col-md-4"><p class="addressLabel">Model: </p><input autocomplete="on" id="hardModel" value="'.$row["hardModel"].'"></div>
                                    <div class="col-md-4"><p class="addressLabel">SIN: </p><input id="hardSN" value="'.$row["hardSN"].'"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><p class="addressLabel">Uwagi: </p>
                                        <textarea id="hardWarning">'.$row["hardWarning"].'</textarea>
                                    </div>
                                    <div class="col-md-6"><p class="addressLabel">Pobrano: </p>
                                        <textarea autocomplete="on" id="hardDown">'.$row["hardDown"].'</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                ';
            }

            if($hardCount == 0){
                echo '
                    <div class="row">
                            <div class="neworderleft col-md-12">
                                <div id="address" class="row">
                                    <div class="col-md-4"><p class="addressLabel">Marka: </p><input autocomplete="on" id="hardBrand"></div>
                                    <div class="col-md-4"><p class="addressLabel">Model: </p><input autocomplete="on" id="hardModel"></div>
                                    <div class="col-md-4"><p class="addressLabel">SIN: </p><input id="hardSN"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><p class="addressLabel">Uwagi: </p>
                                        <textarea id="hardWarning"></textarea>
                                    </div>
                                    <div class="col-md-6"><p class="addressLabel">Pobrano: </p>
                                        <textarea autocomplete="on" id="hardDown"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                ';
            }


        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getDesc(){
        try{
            include('../../components/connect.php');
            global $orderKNumber;

            $orderCount = 0;
            $stmt5 = $pdo->prepare('SELECT MAX(orderVersion) AS "orderVersion" FROM orders WHERE orderKNumber="'.$orderKNumber.'"');
            $stmt5->execute();

            while($row5 = $stmt5->fetch()){
                $stmt6 = $pdo->prepare('SELECT * FROM orders WHERE orderKNumber="'.$orderKNumber.'" AND orderVersion="'.$row5['orderVersion'].'"');
                $stmt6->execute();
                while($row6 = $stmt6->fetch()){
                    echo '
                        <div class="col-md-12"><p class="addressLabel">Opis usterki:</p>
                            <textarea id="description">'.$row6["orderDescription"].'</textarea>
                        </div>
                    ';
                     $orderCount++;
                }
            }

            if($orderCount == 0){
                echo '
                    <div class="col-md-12"><p class="addressLabel">Opis usterki:</p>
                        <textarea></textarea>
                    </div>
                ';
            }

        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getComm(){
        $getData = explode("_", $_GET["tel"]);
        include('../../components/connect.php');
        try{
            global $orderKNumber, $orderHidden;

            if($getData[0] == "Naprawa"){
                echo '
                    <div class="row">
                        <div class="neworderleft col-md-12" style="margin-top: 10px;">
                            <p class="addressLabel">Komentarz ukryty:</p>
                            <textarea id="hiddencomment">'.$orderHidden.'</textarea>
                        </div>
                    </div>
                    <hr><br>
                    <input type="hidden" name="orderNumber" value="'.$orderKNumber.'">
                ';
            }else{
                echo '<input type="hidden" name="orderNumber" value="'.$orderKNumber.'">';
            }

            $stmt = $pdo->prepare('SELECT * FROM orderscomments WHERE commentKNumber="'.$orderKNumber.'"');
            $stmt->execute();
            $commCount = 0;
            while($row = $stmt->fetch()){
                $commCount++;
                echo '
                    <div class="row">
                        <div class="neworderleft col-md-12" style="margin-top: 10px;">
                            <p class="addressLabel">Autor: <i style="font-weight: normal;">'.$row['commentUser'].'</i>, Data: <i style="font-weight: normal;">'.$row['commentDate'].'</i></p>
                            <textarea>'.$row['commentText'].'</textarea>
                        </div>
                    </div>
                ';
            }

            if($commCount == 0){
                echo '
                    <h4 style="margin-left:20px; margin-top: 20px;">Brak komentarzy</h4>
                ';
            }


        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getVersion(){
        $getData = explode("_", $_GET["tel"]);
        include('../../components/connect.php');
        try{
            $stmt = $pdo->prepare('SELECT orderKNumber FROM orders WHERE orderID="'.$getData[1].'"');
            $stmt->execute();
            while($row = $stmt->fetch()){

                $stmt2 = $pdo->prepare('SELECT orderVersion FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'" ORDER BY orderVersion DESC');
                $stmt2->execute();
                $count = 0;
                while($row2 = $stmt2->fetch()){
                    $count++;
                }
                $stmt2 = $pdo->prepare('SELECT orderVersion FROM orders WHERE orderKNumber="'.$row['orderKNumber'].'" ORDER BY orderVersion DESC');
                $stmt2->execute();
                while($row2 = $stmt2->fetch()){

                    if(intval($row2['orderVersion']) == $count){
                        global $lastVersion;
                        $lastVersion = $count;
                    }

                    if(intval($getData[2]) === $count){
                        echo '<option selected>'.$row2['orderVersion']."</option>";
                    }else{
                        echo "<option>".$row2['orderVersion']."</option>";
                    }
                    $count--;
                }

            }
        }catch(PDOException $e){
            die('Unable to connect: ' . $e->getMessage());
        }
    }

    function getStatus(){
        include('../../components/connect.php');
        try{
            $stmt2 = $pdo->prepare('SELECT * FROM orderstatus');
            $stmt2->execute();
            while($row2 = $stmt2->fetch()){
                global $orderStatus;
                if($row2['statusName'] === $orderStatus){
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
        include('../../components/connect.php');
        try{
            $stmt2 = $pdo->prepare('SELECT * FROM employee');
            $stmt2->execute();
            while($row2 = $stmt2->fetch()){
                global $orderWorker;
                if($row2['emplName'] == $orderWorker){
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