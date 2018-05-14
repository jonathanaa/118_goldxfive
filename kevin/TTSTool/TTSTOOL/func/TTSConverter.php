<?php
	include_once("../config/config.php");
	$string = (isset($_POST["string"])&&!empty($_POST["string"]))? $_POST["string"] : "";
	$speaker=(isset($_POST["speaker"])&&!empty($_POST["speaker"])) ? strip_tags(trim($_POST["speaker"])) : "MCHEN_Bruce";
	$Volume=(isset($_POST["Volume"])&&!empty($_POST["Volume"])) ? intval($_POST["Volume"]) : "100";
	$speed=(isset($_POST["speed"])&&!empty($_POST["speed"])) ? intval($_POST["speed"]) : "0";
	$outputType=(isset($_POST["outputType"])&&!empty($_POST["outputType"])) ? strip_tags(trim($_POST["outputType"])) : "wav";
	$pitchLevel = (isset($_POST["pitchLevel"])&&!empty($_POST["pitchLevel"])) ? intval($_POST["pitchLevel"]) : "0";
	$pitchSign = (isset($_POST["pitchSign"])&&!empty($_POST["pitchSign"])) ? intval($_POST["pitchSign"]) : "0";
	$pitchScale = (isset($_POST["pitchScale"])&&!empty($_POST["pitchScale"])) ? intval($_POST["pitchScale"]) : "5";
	$ConvertID=(isset($_GET["ConvertID"])&&!empty($_GET["ConvertID"])) ? intval($_GET["ConvertID"]) : "";
	$download=(isset($_GET["download"])&&!empty($_GET["download"])) ? intval($_GET["download"]) : "";
	$audiofilename=(isset($_GET["audiofilename"])&&!empty($_GET["audiofilename"])) ? strip_tags($_GET["audiofilename"]) : "";
	$resultCode="";
	$resultString="";
	$resultConvertID="";	
	$statusCode="";
	$status="";
	$resultUrl="";
	$imgsrc = "";
    $result="";
	if(!empty($string)){	   
		//Setup Web Service		
		$client = new SoapClient("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl");
		//$client = new SoapClient("http://127.0.0.1/Other_test/TTSService/Soap_1_3.php?wsdl");
		// Invoke Call to ConvertText
		$result=$client->ConvertAdvancedText($cname,$passwd,$string,$speaker,$Volume,$speed,$outputType,$pitchLevel,$pitchSign,$pitchScale);
		//$result=$client->ConvertAdvancedText("Account","Password","合成文字位置","Theresa",100,0, "flv",5,1,10) 
        // Iterate through the returned string array
		$resultArray=explode("&",$result);
		list($resultCode, $resultString, $resultConvertID) = $resultArray; 
        //error info   
        switch ($resultCode){
            case 0:
             $result =  $resultConvertID;
            break;
            
            case -1:
             $result =  "No matched speaker";
            break;
            
            case -2:
             $result =  "Voice setting fail";
            break;
            
            case -3:
             $result =  "Output file setting fail";
            break;
            
            case -4:
             $result =  " 您的帳號或密碼錯誤";
            break;
            
            case -5:
             $result =  "invalid TTS Font Format";
            break;
            
            case -6:
             $result =  "out of service space";
            break;
            
            case -7:
             $result =  "account incative";
            break;
            
            case -8:
             $result =  "possword incative";
            break;
            
            case -9:
             $result =  "incative TTSSpeaker";
            break;
            
            case -10:
             $result =  "incative Volume";
            break;
            
            case -11:
             $result =  "incative Speed";
            break;
            
            case -12:
             $result =  "invalid Text";
            break;
            
            case -13:
             $result =  "content size is too large";
            break;
            
            case -14:
             $result =  "inactive ConvertID";
            break;
            
            case -15:
             $result =  "inactive outputType";
            break;
            
            case -16:
             $result =  "inactive PitchModify";
            break;
        }
        

	}
	if(!empty($ConvertID)){
			//Setup Web Service
			$client = new SoapClient("http://tts.itri.org.tw/TTSService/Soap_1_3.php?wsdl");
			// Invoke Call to ConvertText
			$result=$client->GetConvertStatus($cname,$passwd,$ConvertID);
			// Iterate through the returned string array
			$resultArray=explode("&",$result);
			list($resultCode, $resultString, $statusCode, $status, $resultUrl) = $resultArray;
			if($download == 1){
				if(copy($resultUrl,$AudiofilesAddress.$audiofilename.".wav"))echo 1;
				else echo 0;
				//echo $audiofilename;
				//echo $_SERVER['HTTP_REFERER'];
				//echo $resultUrl;
			}else{
				echo $resultCode."|".$resultString."|".$statusCode."|".$status."|".$resultUrl;
			}
			exit();
	}
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<form id="TTSform" name="TTSform" method="post">
			<input type="text" id="string" name="string">
			<input type="text" id="speaker" name="speaker">
			<input type="text" id="Volume" name="Volume">
			<input type="text" id="speed" name="speed">
			<input type="text" id="outputType" name="outputType">
			<input type="text" id="pitchLevel" name="pitchLevel">
			<input type="text" id="pitchSign" name="pitchSign">
			<input type="text" id="pitchScale" name="pitchScale">
			<input type="text" id="ConvertID" name="ConvertID" value="<?php echo $result; ?>">
		</form>
	</body>
</html>