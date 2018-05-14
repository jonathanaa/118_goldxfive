<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" src="./TTSTOOL/TTSscript.js"></script>
</head>
<body>
	<div id="content">
        <a href="#">你好，</a><br> <!-- 轉換語音時，tag會被濾掉，裡面的文字會保留 -->
        <div noTTS="true">不想聽的內容</div><!-- 如果有不想聽的文字，則在將不想聽到的內容用任一tag包起來，請加上 noTTS="true" -->
        感字轉語音WEB服務
	</div>
	<!--<div id="x">初步確認</div>-->
	<div id="media"></div>
	<script>
		TTS.ConverterIndex="./TTSTOOL/";
		//TTS.Audiofilename="tt"; //可自己設定音檔名稱
		TTS.ConvertInit("content","media","","","","","",""); //Speaker、Volume、Speed、PitchLevel、PitchSign、PitchScale可空白(即使用預設值)
	</script>
</body>
</html>