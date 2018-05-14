<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="target-densitydpi=320,width=640,user-scalable=no">
	<title>竹好機器人</title>
	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./css/voiceDetect.css">
	<link rel="stylesheet" type="text/css" href="./css/picture_count.css">
	

	<style>
		#advertisement_1{
				position: absolute;
	    		top:70px;
	    		left:0px;
	    		bottom: 0px;
	    		right: 0px;
	   			background-color: #ffffff;
				padding:0;
				margin:0;
				z-index: 5;
				overflow-y: scroll;/*显示y轴滚动条*/
    			overflow-x: hidden;
			}
		#advertisement_2{
			padding:0;
			margin:0;
			z-index: 2;
		}
		#Stickers{
			position: absolute;
			padding:0;
			margin:0;
			z-index: 1;
			display: none;
		}
		#hikashop {
	    	top:0px;
	    	left:0px;
	    	bottom: 0px;
	    	right: 0px;
	   		background-color: #ffffff;
			padding:0;
			margin:0;
			z-index: 3;
		}
		#shopView{
	    	top:0px;
	    		left:0px;
	    		bottom: 0px;
	    		right: 0px;
	   			background-color: #ffffff;
				padding:0;
				margin:0;

			height: 921px;


			
		}
	</style>

	<!-- javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	
	<script>
		document.oncontextmenu = function(){
			window.event.returnValue=false; //將滑鼠右鍵事件取消
		}

		function nopeople(){
			console.log("leave");

			$.get(advertisement_1, function(data) {
	  			//optional stuff to do after success
	  			$('#advertisement_1').html(data);
	  			$('#advertisement_1').css('display','block');
	  			$('#advertisement_2').html('');
			});
		    $('#Stickers').css('display','none');
			var tempWeb = '<iframe id="shopView" src="'+hikashop_website+'"  width="100%" frameborder="0" name="frm2" id="frm2"></iframe></div>';
			$('#hikashop').html(tempWeb);
			var data = '{"type":"leave","name":'+'"web"'+'}';
            ws.send(data);
		}
		var interval_time = 90;//間隔時間(單位為秒)
		var myVar= setTimeout(nopeople, interval_time*1000);
    	$('html').on("mousemove touchstart touchmove touchend", function(e){
    		clearTimeout(myVar);
    		console.log("move");
    		myVar = setTimeout(nopeople, interval_time*1000);
	       	e.preventDefault();
    	});
</script>

</head>
<body>
	<div id = "advertisement_1" ></div>
	<div id = "advertisement_2"></div>
	<div id = "Stickers"></div>
	<div id = "hikashop"></div>
</body>
	<script type="text/javascript">
		var test="index";
		var ws = new WebSocket("ws://127.0.0.1:9999");
		ws.onopen = function() {
            alert("連結成功");
            var data = '{"type":"login","name":'+'"web"'+'}';
            ws.send(data);
            ws.onmessage = onmessage;
            console.log(data);
        };
	</script>
	<script src="js/iframe.js"></script>
	<script src="js/google_api.js"></script>
	<script src="js/web_socket_client_workerman.js"></script>
	<script src="js/story.js"></script>
	<script src="js/language.js"></script>
	<script src="js/canvas2image.js"></script>
</html>