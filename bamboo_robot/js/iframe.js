//var hikashop_website = "../../lt_envico_joomla_quickstart_package";
var hikashop_website = "http://127.0.0.1/lt_envico/index.php/project";

var advertisement_1 = "./web/advertisement_1.html";
var advertisement_1_1 = "../../118/bamboo_robot/web/advertisement_1.html";
var advertisement_2 = "./jieba/voice_detect.php";
var Stickers = "./web/take_picture.html";
var guide_frame = "./web/guide.html";
var line_guide_frame = "./web/line_guide.php";
$(document).ready(function() {

	//2018/02/26 插入IFRAME(相對路徑完成 絕對路徑未完成)

	/*var test = 'http://www.ec.ccu.edu.tw/usr/bamboo/index.php/project';
	var hikashop_website = test;*/


	$.get(advertisement_1, function(data) {
	  //optional stuff to do after success
	  $('#advertisement_1').html(data);
	});

	if("-1"==hikashop_website.search("http://")){
		$.get(hikashop_website,function(data){
			$('#hikashop').html(data);
		});
	}else{
		var tempWeb = '<iframe id="shopView" src="'+hikashop_website+'"  width="100%" frameborder="0" name="frm2" id="frm2"></iframe></div>';
		$('#hikashop').html(tempWeb);
	}




});