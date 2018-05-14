<?php//
include "../library/Smarty/Smarty.class.php";
define('APP_PATH', 'D:/AppServ/www/118/bamboo_robot');
$tpl = new Smarty();
$tpl->template_dir = APP_PATH . "/web/";
$tpl->compile_dir = APP_PATH . "/templates_c/";
$tpl->config_dir = APP_PATH . "/configs/";
$tpl->cache_dir = APP_PATH . "/cache/";
function select($seg_list){
echo "select";
$nounlength=0;//名詞個數
$keywordnumber=0;//關鍵字個數
$productnum=0;//符合的產品數量
$score=1;
$n=1;
$keyidindex=0;
$keyidinside=0;
foreach($seg_list as $val1) {//找出有在關鍵詞庫的id
	//echo "字:".$val1[word]."<br>";
	$keyid[$keyidindex]['word']=$val1[word];//字
	//echo "詞性:".$val1[tag]."<br>";
	$keyid[$keyidindex]['type']=$val1[tag];//詞性
	if(substr($val1[tag],0,1)=="n"){
		$nounarray[$nounlength]=$val1[word];//名詞陣列
		$nounlength++;
		//echo "抓到的名詞:"."$val1[word]"."<br>";
		$sql1 = "SELECT category_id FROM ".$prefix_word."_hikashop_category where category_name like '%$val1[word]%'"; //SQL 語法
		//echo "123"."$sql1";
		$keyword=mysqli_query($conn, $sql1);
		if ($keyword->num_rows > 0) {
				$row = $keyword->fetch_assoc();
				$keywordid[$keywordnumber]=$row["category_id"];//關鍵字id陣列
				$keywordnumber++;
				//echo $row["category_id"];
		}
	}
	$keyidindex++;
}
for($i=0; $i<$keywordnumber; $i++){
	$temptkeyid=$keywordid[$i];
	$sql2 = "SELECT product_id FROM ".$prefix_word."_hikashop_product_category where category_id = '$temptkeyid'"; //SQL 語法
	$product=mysqli_query($conn, $sql2);
	if ($product->num_rows > 0) {
		while($row1 = $product->fetch_assoc()) {
			$products[$productnum]=$row1[product_id];
			$productnum++;
			//echo "$row1[product_id]";
		}
	}
}
//echo"$products";
if($productnum==0){
	$keyid[0]['word']=$val1[word];//字
	//echo "詞性:".$val1[tag]."<br>";
	$keyid[0]['type']=$val1[tag];//詞性
}
else{
sort($products);

if($productnum==1){//如果產品只有一樣
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

$outputindex=0;
$outputinside=0;

for($k=$productnum; $k>0; $k--) { 
	//echo "k=$k";//目前最高分
	for($m=0; $m<$productnum; $m++) { 
		 //echo "m=$m";
		 //echo "score = $scores[0]";
		if($k==$scores[$m]){
			$temptid=$products[$m];
			$sql3 = "SELECT product_name,product_description,product_alias FROM ".$prefix_word."_hikashop_product where product_id = '$temptid'"; //SQL 語法

			$product_detail=mysqli_query($conn, $sql3);
			if ($product_detail->num_rows > 0) {
				$row2 = $product_detail->fetch_assoc();
				$productname=$row2[product_name];
				$productdescription=$row2[product_description];
				$producthref=$row2[product_alias];
			}
			$newproducthref="$products[$m]"."-"."$producthref";
			//echo "<div class=goods>";
			//echo "第"."$n"."筆"."<br>";

			$output[$outputindex]['number']=$n;//第幾筆

			//echo "產品編號:"."$products[$m]"."<br>";

			$output[$outputindex]['id']=$products[$m];//產品編號

			//echo "<div class=goodsid>"."$newproducthref"."<br>"."</div>";//編號名稱

			$output[$outputindex]['idname']=$newproducthref;//編號名稱

			//echo "產品名稱:".$productname."<br>";

			$output[$outputindex]['name']=$productname;//產品名稱

			//echo "產品描述:"."<br>".$productdescription."<br>";

			$output[$outputindex]['des']=$productdescription;//產品描述

			//echo "符合關鍵字個數:"."$k"."<br>";

			$output[$outputindex]['keynum']=$k;//符合關鍵字個數

			$outputindex++;
			$n++;
			//echo "<br>";
			//echo "</div>";
		}
		else{
			continue;
		}
	}
}
}
$tpl->assign("keyid", $keyid);
$tpl->assign("output", $output);
$tpl->display("keyword_search.html");
mysqli_close($conn);
}