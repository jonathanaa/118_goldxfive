<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.6.4
 * @author	hikashop.com
 * @copyright	(C) 2010-2016 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><div id="hikashop_checkout_page" class="hikashop_checkout_page hikashop_checkout_page_step<?php echo $this->step; ?>">
	<?php
	if(hikashop_level(1)){
		$open_hour = $this->config->get('store_open_hour',0);
		$close_hour = $this->config->get('store_close_hour',0);
		$open_minute = $this->config->get('store_open_minute',0);
		$close_minute = $this->config->get('store_close_minute',0);
		if($open_hour!=$close_hour || $open_minute!=$close_minute){
			function getCurrentDate($format = '%H'){
				if(version_compare(JVERSION,'1.6.0','>=')) $format = str_replace(array('%H','%M'),array('H','i'),$format);
				return (int)JHTML::_('date',time()- date('Z'),$format,null);
			}
			$current_hour = hikashop_getDate(time(),'%H');
			$current_minute = hikashop_getDate(time(),'%M');
			$closed=false;
			if($open_hour<$close_hour || ($open_hour==$close_hour && $open_minute<$close_minute)){
				if($current_hour<$open_hour || ($current_hour==$open_hour && $current_minute<$open_minute)){
					$closed=true;
				}
				if($close_hour<$current_hour || ($current_hour==$close_hour && $close_minute<$current_minute)){
					$closed=true;

				}
			}else{
				$closed=true;

				if($current_hour<$close_hour || ($current_hour==$close_hour && $current_minute<$close_minute)){
					$closed=false;
				}
				if($open_hour<$current_hour || ($current_hour==$open_hour && $open_minute<$current_minute)){
					$closed=false;

				}
			}
			if($closed){
				$app=& JFactory::getApplication();
				$app->enqueueMessage(JText::sprintf('THE_STORE_IS_ONLY_OPEN_FROM_X_TO_X',$open_hour.':'.sprintf('%02d', $open_minute),$close_hour.':'.sprintf('%02d', $close_minute)));
				echo '</div>';
				return;
			}
		}
	}

	global $Itemid;
	$checkout_itemid = $this->config->get('checkout_itemid');
	if(!empty($checkout_itemid )){
		$Itemid = $checkout_itemid ;
	}
	$url_itemid='';
	if(!empty($Itemid)){
		$url_itemid='&Itemid='.$Itemid;
	}

	if($this->display_checkout_bar){
		if(HIKASHOP_RESPONSIVE) {
?>
			<div class="hikashop_wizardbar">
				<ul>
<?php
		} else {
?>
			<div id="hikashop_cart_bar" class="hikashop_cart_bar">
<?php
		}

		$already=true;
		if (count($this->steps) > $this->step+1) $link=true;
		foreach($this->steps as $k => $step){
			$step=explode('_',trim($step));
			$step_name = reset($step);
			if($this->display_checkout_bar==2 && $step_name=='end'){
				continue;
			}
			$class = '';
			$badgeClass = '';
			if($k == $this->step){
				$already = false;
				$class .= ' hikashop_cart_step_current';
				$badgeClass = 'info';
			}
			if($already){
				$class .= ' hikashop_cart_step_finished';
				$badgeClass = 'success';
			}

			if(HIKASHOP_RESPONSIVE) {
?>
				<li class="<?php echo trim($class); ?>">
					<span class="badge badge-<?php echo $badgeClass; ?>"><?php echo ($k + 1); ?></span>
<?php
						if($k == $this->step || empty($link)) {
							echo JText::_('HIKASHOP_CHECKOUT_'.strtoupper($step_name));
						} else {
?>
						<a href="<?php echo hikashop_completeLink('checkout&task=step&step='.$k.$url_itemid);?>">
							<?php echo JText::_('HIKASHOP_CHECKOUT_'.strtoupper($step_name));?>
						</a>
<?php
						}
?>
					<span class="hikashop_chevron"></span>
				</li>

<?php
			} else {
?>
				<div class="hikashop_cart_step<?php echo $class;?>">
					<span><?php
						if($k == $this->step || empty($link)){
							echo JText::_('HIKASHOP_CHECKOUT_'.strtoupper($step_name));
						}else{ ?>
						<a href="<?php echo hikashop_completeLink('checkout&task=step&step='.$k.$url_itemid);?>">
							<?php echo JText::_('HIKASHOP_CHECKOUT_'.strtoupper($step_name));?>
						</a>
					<?php }
					?></span>
				</div><?php
			}
		}

		if(HIKASHOP_RESPONSIVE) {
?>
				</ul>
<?php
		}
?>
			</div>
<?php
	}
	if(empty($this->noform)){
		?>
		<form action="<?php echo hikashop_completeLink('checkout&task=step&step='.($this->step+1).$url_itemid); ?>" method="post" name="hikashop_checkout_form" enctype="multipart/form-data" onsubmit="if('function' == typeof(hikashopSubmitForm)) { hikashopSubmitForm('hikashop_checkout_form'); return false; } else { return true; }">
		<?php
	}
	$dispatcher = JDispatcher::getInstance();
	$this->nextButton = true;
	foreach($this->layouts as $layout) {
		$layout = trim($layout);
		if($layout == 'end') {
			$this->continueShopping = '';
		}
		if(substr($layout, 0, 4) != 'plg.') {
			$this->setLayout($layout);
			echo $this->loadTemplate();
		} else {
			$html = '';
			$dispatcher->trigger('onCheckoutStepDisplay', array($layout, &$html, &$this));
			if(!empty($html)) {
				echo $html;
			}
		}
	}
	if(empty($this->noform)){
		?>
		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
		<input type="hidden" name="option" value="com_hikashop"/>
		<input type="hidden" name="ctrl" value="checkout"/>
		<input type="hidden" name="task" value="step"/>
		<input type="hidden" name="previous" value="<?php echo $this->step; ?>"/>
		<input type="hidden" name="step" value="<?php echo $this->step+1; ?>"/>
		<input type="hidden" id="hikashop_validate" name="validate" value="0"/>
		<?php echo JHTML::_( 'form.token' ); ?>
		<input type="hidden" name="unique_id" value="[<?php echo md5(uniqid())?>]"/>
		<br style="clear:both"/>
		<?php

		if($this->nextButton)
		{
			if($this->step == (count($this->steps) - 2)) {
				$checkout_next_button = JText::_('CHECKOUT_BUTTON_FINISH');
				if($checkout_next_button == 'CHECKOUT_BUTTON_FINISH')
					$checkout_next_button = JText::_('NEXT');
			} else
				$checkout_next_button = JText::_('NEXT');
			echo $this->cart->displayButton($checkout_next_button,'next',$this->params, hikashop_completeLink('checkout&task=step&step='.$this->step+1),'if(hikashopCheckChangeForm(\'order\',\'hikashop_checkout_form\')){ if(hikashopCheckMethods()){ document.getElementById(\'hikashop_validate\').value=1; this.disabled = true; document.forms[\'hikashop_checkout_form\'].submit();}} return false;','id="hikashop_checkout_next_button"');
			$button = $this->config->get('button_style','normal');
			 	if ($button=='css')
					echo '<input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;"/></input>';
		}
		?>
		</form>
		<?php
		if($this->continueShopping){
			if(strpos($this->continueShopping,'Itemid')===false){
				if(strpos($this->continueShopping,'index.php?')!==false){
					$this->continueShopping.=$url_itemid;
				}
			}
			if(!preg_match('#^https?://#',$this->continueShopping)) $this->continueShopping = JURI::base().ltrim($this->continueShopping,'/');
			echo $this->cart->displayButton(JText::_('CONTINUE_SHOPPING'),'continue_shopping',$this->params,JRoute::_($this->continueShopping),'window.location=\''.JRoute::_($this->continueShopping).'\';return false;','id="hikashop_checkout_shopping_button"');
		}
	}
	?>
</div>
<button onclick="ShowAnswer()" id = "my_checkout">結帳</button>
<div  id = "AnswerBox" ></div>


<script>
	function ShowAnswer(){
    document.getElementById("AnswerBox").innerHTML='<form action="" method="post"><input type="text" id = "txt1" name = "cardID"><input type="submit" style="display: none" value="print"></form>';
    document.getElementById('txt1').focus();
    document.getElementById('my_checkout').style.display="none";
}
</script>
<?php
if($_POST){
//-----------------------------------------------------------跳轉
$url = "http://127.0.0.1/lt_envico/index.php/project";
echo "<script type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";
//-----------------------------------------------------------發票生成//加資料夾tmp image
define("QRCODE_PATH", "C:/xampp/htdocs/lt_envico/");
include QRCODE_PATH."../118/kevin/lib/phpqrcode/qrlib.php";
function generate_qr($str,$txt,$bg_h){
    $font = QRCODE_PATH.'../118/bamboo_robot/print/font2.ttf';
    $num = str_pad($str, '6', '0', STR_PAD_LEFT);
    //$txt = '收   银   台   :   ' .trim(preg_replace('/(\d)/', '$1   ', $num));
    //$txt = '第一項商品:竹醋液'."\n".'123';
    //$url = 'https://example.com/' . $num; //二维码内容
    $url = 'https://line.me/R/ti/p/NC_SHvH1ce'; //二维码内容
    $qrcode = QRCODE_PATH."../118/bamboo_robot/print/tmp/{$num}_qr.png";
    $level = 'L';//容错级别
    $size = 1;//生成图片大小
    QRcode::png($url, $qrcode, $level, $size, 2);
    //二维码宽/高度
    $qrcode = imagecreatefrompng($qrcode);
    //$qrcode_w = imagesx($qrcode);
    $qrcode_w = 100;
    //$qrcode_h = imagesy($qrcode);
    $qrcode_h = 100;
    $bg_w = 500; // 背景图片宽度
    //$bg_h = 1233; // 背景图片高度
    $bg_img = imagecreatetruecolor($bg_w, $bg_h);
    $white = imagecolorallocate($bg_img, 255, 255, 255);
    imagefill($bg_img, 0, 0, $white);
    imagecopyresampled($bg_img, $qrcode, 30, 30,0,0, 500, 500, $qrcode_w, $qrcode_h);
    $black = imagecolorallocate($bg_img, 0, 0, 0);
    $fontsize = 20;
    $fontbox = imagettfbbox($fontsize, 0, $font, $txt);
    //imagettftext($bg_img, $fontsize, 0, ceil(($bg_w - $fontbox[2])/2), $bg_w + 5, $black, $font, $txt);
    imagettftext($bg_img, $fontsize, 0, 50, 300, $black, $font, $txt);
    $qr =  QRCODE_PATH."../118/bamboo_robot/print/tmp/qr_$num.png";
    imagepng($bg_img, $qr);
    imagedestroy($qrcode);
    imagedestroy($bg_img);
    $fp  = fopen($qr, 'rb', 0);
    /**
     * 修改图片分辨率
     */
    $base64= 'data:image/png;base64,'.base64_encode(fread($fp, filesize($qr)));
    $file = file_get_contents($base64);
    $filename = "$num.png";
    //数据块长度为9
    $len = pack("N", 9);
    //数据块类型标志为pHYs
    $sign = pack("A*", "pHYs");
    //X方向和Y方向的分辨率均为300DPI（1像素/英寸=39.37像素/米），单位为米（0为未知，1为米）
    $data = pack("NNC", 300 * 39.37, 300 * 39.37, 0x01);
    //CRC检验码由数据块符号和数据域计算得到
    $checksum = pack("N", crc32($sign . $data));
    $phys = $len . $sign . $data . $checksum;
    $pos = strpos($file, "pHYs");
    if ($pos > 0) {
        //修改pHYs数据块
        $file = substr_replace($file, $phys, $pos - 4, 21);
    } else {
        //IHDR结束位置（PNG头固定长度为8，IHDR固定长度为25）
        $pos = 33;
        //将pHYs数据块插入到IHDR之后
        $file = substr_replace($file, $phys, $pos, 0);
    }
    file_put_contents(QRCODE_PATH."../118/bamboo_robot/print/image/$filename", $file);
    //header("Content-type: image/png");
    //header('Content-Disposition: attachment; filename="' . $filename . '"');
    unlink(QRCODE_PATH."../118/bamboo_robot/print/tmp/{$num}_qr.png");
   //unlink(QRCODE_PATH."/tmp/qr_$num.png");
    //  echo $file;
}
//-----------------------------------------------------------資料庫搜尋
$servername = "localhost"; 
$username = "root"; //¨Ï¥ÎªÌ¦WºÙ(¥Îroot§Y¥i)
$password = ""; //±K½X(¦pªG¨S¦³§ó§ï¡A«h¥ÎªÅ¦r¦ê§Y¥i)
$dbname = "bamboo2"; //¸ê®Æ®w¦WºÙ
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {  //³s½u¥¢±Ñ¡A«hÅã¥Ü¿ù»~°T®§
	die("Connection failed: " . mysqli_connect_error());
}
mysqli_query($conn,"set names utf8"); 
$sql1 = "SELECT product_id,cart_product_quantity FROM chdg4_hikashop_cart_product"; //SQL »yªk
$product = mysqli_query($conn, $sql1);
$i=1;
$print="";
$total_price=0;
while($row = mysqli_fetch_array($product,MYSQLI_ASSOC)){
	//echo $row["cart_product_quantity"];//¥Ø«ecart¤ºªºproduct_id
	
	$now_product_id=$row["product_id"];
	$sql2 = "SELECT price_value FROM chdg4_hikashop_price WHERE price_product_id='$now_product_id'"; //SQL »yªk
	$price = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_array ($price);
	
	$sql3 = "SELECT product_name FROM chdg4_hikashop_product WHERE product_id='$now_product_id'"; //SQL »yªk
	$now_product_id = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_array ($now_product_id);
	$name=$row3[0];
	//$name=mb_convert_encoding($name, "big5", "auto"); //­ì©l½s½X¤£©ú¡A³q¹Lauto¦Û°ÊÀË´ú¡AÂà´«UTF-8
	$print=$print."\n"."產品$i:".$name."\n"."數量:".$row["cart_product_quantity"]."\n"."產品單價:".$row2[0]."\n";
	
	$total_price=$total_price+$row2[0]*$row['cart_product_quantity'];
	$i++;
}
//刪除資料表
$sql4 = "DELETE FROM chdg4_hikashop_cart_product"; //SQL »yªk
$now_product_id = mysqli_query($conn, $sql4);
//---------
$print=$print."\n"."總金額:"."$total_price"."\n";
$height=$i*170+83+300-170;//170每樣產品長度 83是總金額長度 300是qrcode長度
generate_qr('123456',$print,$height);
//------------------------------------------------------列印
$handle=printer_open("WP-T810 Ver.3.10");
printer_start_doc($handle, "My Document");
printer_start_page($handle);
printer_set_option($handle, PRINTER_MODE, "RAW");//printer mode¥²¶·³]©w¬°RAW
//printer_write($handle,$print); //列印文字
//------------------------------------------------------php製作圖片並下載
/*$text=$print;//显示的文字  
$size=20;//字体大小  
$font="font2.ttf";//字体类型，这里为黑体，具体请在windows/fonts文件夹中，找相应的font文件  
$img=imagecreate(500,1000);//创建一个长为500高为16的空白图片  
imagecolorallocate($img,0xff,0xff,0xff);//设置图片背景颜色，这里背景颜色为#ffffff，也就是白色  
$black=imagecolorallocate($img,0x00,0x00,0x00);//设置字体颜色，这里为#000000，也就是黑色  
imagettftext($img,$size,0,0,16,$black,$font,$text);//将ttf文字写到图片中  
header('Content-Type: image/png');//发送头信息  
//imagepng($img);//输出图片，输出png使用imagepng方法，输出gif使用imagegif方法  
$save ="output_content.png";
imagepng($img, $save);*/
//--------------------------------------------------------圖片轉檔
require_once(QRCODE_PATH.'../118/bamboo_robot/print/php_image_magician/php_image_magician.php');
/*$magicianObj = new imageLib('qrcode.png');
$magicianObj -> resizeImage(200, 200);
$magicianObj -> saveImage('qrcode.png', 100);

/*$magicianObj1 = new imageLib('output_content.png');
$magicianObj1 -> resizeImage(500, 500);
$magicianObj1 -> saveImage('output_content.bmp', 100);*/
//-------------------------------------------------------圖片合成
/*function watermark($filename,$water){

	//获取背景图片的宽度和高度
    list($b_w,$b_h) = getimagesize($filename);


	//获取水印图片的宽度和高度
    list($w_w,$w_h) = getimagesize($water);
	//echo $b_h;

	//创建背景图片的资源
	    $back = imagecreatefrompng($filename);
	//创建水印图片的资源
	    $water = imagecreatefrompng($water);
	//使用imagecopy()函数将水印图片复制到背景图片指定的位置中
	    imagecopy($back, $water, $posX=170, $posY=700, 0, 0, $w_w, $w_h);
	
	//保存带有水印图片的背景图片
    imagepng($back,"output_combine.png");
    imagedestroy($back);
    imagedestroy($water);
}
watermark("output_content.png", "qrcode.png");*/
//--------------------------------------------------------圖片轉檔
//require_once('php_image_magician/php_image_magician.php');
$magicianObj1 = new imageLib(QRCODE_PATH.'../118/bamboo_robot/print/image/123456.png');
//$magicianObj1 -> resizeImage(500, 1000);
$magicianObj1 -> saveImage(QRCODE_PATH.'../118/bamboo_robot/print/output_combine.bmp', 100);
//--------------------------------------------------------列印圖片
printer_draw_bmp($handle, QRCODE_PATH."../118/bamboo_robot/print/output_combine.bmp", 1, 1);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
}
?>
<div class="clear_both"></div>
<?php

if(JRequest::getWord('tmpl','')=='component'){
	exit;
}
