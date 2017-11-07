<?php 

    $mysql_host = 'localhost';
    $port = '3306';
    $username = '23387158_system';
    $password = 'zaq1@WSX';
    $database = '23387158_system';

    try{
        $pdo = new PDO('mysql:host='.$mysql_host.';dbname='.$database.';port='.$port, $username, $password );
        $pdo -> query ('SET NAMES utf8');
		$pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
    }catch(PDOException $e){}

 ?>