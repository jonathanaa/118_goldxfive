<?php
/**
 * @desc: generate qrcode
 */
define("QRCODE_PATH", dirname(__FILE__));
include "../lib/phpqrcode/qrlib.php";
//download zip file
//download($zipName);
generate_qr('123456');
function generate_qr($str){
    $font = QRCODE_PATH.'/font2.ttf';
    $num = str_pad($str, '6', '0', STR_PAD_LEFT);
    //$txt = '收   银   台   :   ' .trim(preg_replace('/(\d)/', '$1   ', $num));
    $txt = '第一項商品:竹醋液'."\n".'123';
    //$url = 'https://example.com/' . $num; //二维码内容
    $url = 'https://www.youtube.com/watch?v=BvQINQaK1Sk'; //二维码内容
    $qrcode = QRCODE_PATH."/tmp/{$num}_qr.png";
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
    $bg_h = 500; // 背景图片高度
    $bg_img = imagecreatetruecolor($bg_w, $bg_h);
    $white = imagecolorallocate($bg_img, 255, 255, 255);
    imagefill($bg_img, 0, 0, $white);
    imagecopyresampled($bg_img, $qrcode, 30, 30,0,0, 500, 500, $qrcode_w, $qrcode_h);
    $black = imagecolorallocate($bg_img, 0, 0, 0);
    $fontsize = 20;
    $fontbox = imagettfbbox($fontsize, 0, $font, $txt);
    //imagettftext($bg_img, $fontsize, 0, ceil(($bg_w - $fontbox[2])/2), $bg_w + 5, $black, $font, $txt);
    imagettftext($bg_img, $fontsize, 0, 50, 300, $black, $font, $txt);
    $qr =  QRCODE_PATH."/tmp/qr_$num.png";
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
    file_put_contents(QRCODE_PATH."/image/$filename", $file);
    //header("Content-type: image/png");
    //header('Content-Disposition: attachment; filename="' . $filename . '"');
    unlink(QRCODE_PATH."/tmp/{$num}_qr.png");
   //unlink(QRCODE_PATH."/tmp/qr_$num.png");
    //  echo $file;
}