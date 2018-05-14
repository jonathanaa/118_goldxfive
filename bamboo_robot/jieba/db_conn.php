<?php 
	$servername = "localhost"; //伺服器名稱
	$username = "root"; //使用者名稱(用root即可)
	$password = ""; //密碼(如果沒有更改，則用空字串即可)
	$dbname = "bamboo2"; //資料庫名稱

	// 建立連線
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	//echo "123";
	// 確認連練
	if (!$conn) {  //連線失敗，則顯示錯誤訊息
    	die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully"; //連線成功，則印出此行

	//設置mysql執行編碼為utf-8
	mysqli_query($conn,"set names utf8"); 

?>	