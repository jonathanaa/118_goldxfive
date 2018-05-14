<?php 
//現在自定義詞庫在keydict.txt 如果有增加詞 keydict和dict都要加
//error_reporting(0);
ini_set('memory_limit', '1024M');
require_once "./vendor/multi-array/MultiArray.php";
require_once "./vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "./class/Jieba.php";
require_once "./class/Finalseg.php";
require_once "./class/Posseg.php";
include ('db_conn.php'); // 匯入連線檔案
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Posseg;
//Jieba::init(array('mode'=>'default','dict'=>'big'));
Jieba::init();
Finalseg::init();
Posseg::init();
//Jieba::loadUserDict("D:/AppServ/www/118/kevin/JIEBA/dict/user_dict.txt");
Jieba::loadUserDict("./dict/keydict.txt");
//Posseg::loadUserDict("./dict/dict.txt");
//Posseg::loadUserDict('../dict/dict.txt');
$voice=$_GET[voiceText];
$seg_list = Posseg::cut($voice);
$nounlength=0;//名詞個數
$keywordnumber=0;//關鍵字個數
$productnum=0;//符合的產品數量
$score=1;
$n=1;
foreach($seg_list as $val1) {//找出有在關鍵詞庫的id
	echo "字:".$val1[word]." ";
	echo "詞性:".$val1[tag]."<br>";
	if(substr($val1[tag],0,1)=="n"){
		$nounarray[$nounlength]=$val1[word];//名詞陣列
		$nounlength++;
		echo "抓到的名詞:"."$val1[word]"."<br>";
		$sql1 = "SELECT category_id FROM chdg4_hikashop_category where category_name like '%$val1[word]%'"; //SQL 語法
		//echo "$sql1";
		$keyword=mysqli_query($conn, $sql1);
		if ($keyword->num_rows > 0) {
				$row = $keyword->fetch_assoc();
				$keywordid[$keywordnumber]=$row["category_id"];//關鍵字id陣列
				$keywordnumber++;
				//echo $row["category_id"];
		}
	}
}
for($i=0; $i<$keywordnumber; $i++){
	$temptkeyid=$keywordid[$i];
	$sql2 = "SELECT product_id FROM chdg4_hikashop_product_category where category_id = '$temptkeyid'"; //SQL 語法
	$product=mysqli_query($conn, $sql2);
	if ($product->num_rows > 0) {
		while($row1 = $product->fetch_assoc()) {
			$products[$productnum]=$row1[product_id];
			$productnum++;
		}
	}
}
sort($products);
if($productnum==1){
	$scores[0]=1;
}
else{
for($j=0; $j<$productnum-1; $j++) { 
	$first=$products[$j];
	$next=$products[$j+1];
	if($first==$next && $j==$productnum-2){
		$score++;
		$scores[$j]=0;
		$scores[$j+1]=$score;
	}
	else if($first==$next && $j!=$productnum-2){
		$score++;
		$scores[$j]=0;
	}
	else if($first!=$next && $j!=$productnum-2){
		$scores[$j]=$score;
		$score=1;
	}
	else if($first!=$next && $j==$productnum-2){
		$scores[$j]=$score;
		$score=1;
		$scores[$j+1]=$score;
	}
}
}
echo '<!DOCTYPE html>
<html>
  <head>
    <title>關鍵字搜尋</title>
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="language.js"></script>
    <link rel="stylesheet" href="style.css">
    ';
for($k=$productnum; $k>0; $k--) { 
	for($m=0; $m<$productnum; $m++) { 
		if($k==$scores[$m]){
			$temptid=$products[$m];
			$sql3 = "SELECT product_name,product_description,product_alias FROM chdg4_hikashop_product where product_id = '$temptid'"; //SQL 語法

			$product_detail=mysqli_query($conn, $sql3);
			if ($product_detail->num_rows > 0) {
				$row2 = $product_detail->fetch_assoc();
				$productname=$row2[product_name];
				$productdescription=$row2[product_description];
				$producthref=$row2[product_alias];
			}
			$newproducthref="$products[$m]"."-"."$producthref";
			echo "<div class=goods>";
			echo "第"."$n"."筆"."<br>";
			echo "產品編號:"."$products[$m]"."<br>";
			echo "<div class=goodsid>"."$newproducthref"."<br>"."</div>";
			echo "產品名稱:".$productname."<br>";
			echo "產品描述:"."<br>".$productdescription."<br>";
			echo "符合關鍵字個數:"."$k"."<br>";
			$n++;
			echo "<br>";
			echo "</div>";
		}
		else{
			continue;
		}
	}
}
echo '</body>
</html>';
mysqli_close($conn);
?>