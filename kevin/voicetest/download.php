<?
	//$file = $_GET["file"];
	$file = 'http://tts.itri.org.tw/TTSservice/download/kevinyay945/15171228492523.wav';
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".basename($file));
	header("Content-Transfer-Encoding: binary");
	$fd = fopen($file, "rb");  //大檔案下載的解決方法～readfile($file)會出問題～
	if($fd)
	{
    	ob_end_clean();
   		fpassthru($fd);
	
	fclose($fd);
?>
