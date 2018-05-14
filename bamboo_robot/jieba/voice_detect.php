<?php //author:蕭溥辰
//現在自定義詞庫在keydict.txt 如果有增加詞 keydict和dict都要加
error_reporting(0);//偵錯要關掉

ini_set('memory_limit', '1024M');
require_once "./vendor/multi-array/MultiArray.php";
require_once "./vendor/multi-array/Factory/MultiArrayFactory.php";
require_once "./class/Jieba.php";
require_once "./class/Finalseg.php";
require_once "./class/Posseg.php";
include ('./mysql_syntax.php');
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
use Fukuball\Jieba\Posseg;


//Jieba::init(array('mode'=>'default','dict'=>'big'));

//$voice="我想除臭鳥";
$story=$_GET[story];
$voice=$_GET[voiceText];
Jieba::init();
Finalseg::init();
Posseg::init();
//Jieba::loadUserDict("D:/AppServ/www/118/kevin/JIEBA/dict/user_dict.txt");
Jieba::loadUserDict("./dict/keydict.txt");
//Posseg::loadUserDict("./dict/dict.txt");
//Posseg::loadUserDict('../dict/dict.txt');
$seg_list_out = Posseg::cut($voice);
//print_r($seg_list);
trans($seg_list_out,$story);