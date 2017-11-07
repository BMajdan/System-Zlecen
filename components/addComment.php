<?php 
    session_start();
    addComment();

    function addComment(){
        include('connect.php');

            try{

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO orderscomments (commentUser, commentKNumber, commentDate, commentText) VALUES (:user, :knumber, :data, :texts)";

                    $statement = $pdo->prepare($sql);
                    $statement->execute(array(
                        ":user" => $_SESSION['userName'],
                        ":knumber" => $_POST['orderNumber'],
                        ":data" => date('d/m/Y@H:i'),
                        ":texts" => $_POST['sendComment']
                    ));

                    header('Location: ../sites/see_order/index.php?tel='.$_POST['typeEdit']);

            }catch(PDOException $e){
                   header('Location: ../sites/see_order/index.php?tel='.$_POST['typeEdit']);
            }
    }
 ?>