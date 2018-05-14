
<?php
/*船需要轉換的語音的代碼*/
//Setup Web Service
$client = new
SoapClient("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl"); //去PHP.ini 刪掉extension=php_soap.dll 前面的分號
// Invoke Call to ConvertSimple
$result=$client->ConvertSimple("kevinyay945","ch26760640",$_GET[voice],"Theresa",100, "flv",5,1,10);
// Iterate through the returned string array
$resultArray=split("&",$result);
echo $result;
list($resultCode, $resultString, $resultConvertID) = $resultArray;
echo "<br>resultCode：".$resultCode."<br/>";
echo "resultString：".$resultString."<br/>";
echo "resultConvertID：".$resultConvertID."<br/>";
?>

<?php
/*將轉換的ID變成音黨並下載*/
//Setup Web Service
sleep(2);
$client = new
SoapClient("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl");
// Invoke Call to ConvertText
$result=$client->GetConvertStatus("kevinyay945","ch26760640",$resultConvertID);
// Iterate through the returned string array
$resultArray=split("&",$result);
list($resultCode, $resultString, $statusCode, $status, $resultUrl) = $resultArray;
echo "resultCode：".$resultCode."<br/>";
echo "resultString：".$resultString."<br/>";
echo "statusCode：".$statusCode."<br/>";
echo "status：".$status."<br/>";
echo "resultUrl：".$resultUrl."<br/>";

$resultUrlResult=split("/",$resultUrl);
echo $resultUrlResult[6];//此為所需下載之音檔



download_remote_file($resultUrl,'./');

//跳轉到播放網頁
header("Location: ./player.php?voiceID=".$resultUrlResult[6]); 
//確保重定向後，後續代碼不會被執行 
exit;

function download_remote_file($file_url, $save_path) //下載的FUNCTION
{
    $file_name = substr($file_url, strrpos($file_url, '/') + 1);
    if (strpos($file_name, '?') > 0)
        $file_name = substr($file_name, 0, strrpos($file_name, '?'));
    
    $save_to = $save_path.'/'.$file_name;
        
    $fp = fopen ($save_to, 'w+');
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $file_url );
    curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
    curl_setopt( $ch, CURLOPT_FILE, $fp );
    curl_exec( $ch );
    curl_close( $ch );
    fclose( $fp );
    
    return $save_to;
}

?>

				