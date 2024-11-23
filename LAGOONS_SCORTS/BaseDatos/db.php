<?php 
$servername = "localhost";
$username = "scortsdb";
$password = "scortsdb";
$dbname = "ScortsDB";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error){
	die("Conexion fallida: ".$conn->connect_error);
}
 ?>
