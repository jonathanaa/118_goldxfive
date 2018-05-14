<?php
$servername="127.0.0.1";
$username="root";
$password="123456789";
$dbname="carbonfoot";

// Create connection
/*$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} */

// Create database
/*$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}*/
$conn = mysqli_connect($servername, $username, $password, $dbname);

	// 確認連練
	if (!$conn) {  //連線失敗，則顯示錯誤訊息
    	die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully"; //連線成功，則印出此行

	//設置mysql執行編碼為utf-8
	mysqli_query($conn,"set names utf8"); 

$conn->close();

?>