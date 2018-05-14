<?php
$ver_code = $_GET[ver_code];
?>
<div>
	<div id = "stick_name">
	第一步加LINE
	<br>
	第二步輸入驗證碼<?php echo $ver_code; ?>
	<br>
	第三步恭喜拿到照片
	<br>
	<button id = "close_sticks">回到瀏覽畫面</button>
	</div>
	<script>
		$(document).ready(function() {
 			$('#Stickers').on('click','#close_sticks', function() {
 				$('#stick_name').html("");
		    	//$("#Stickers_off").css('display','block');
				//$("#Stickers_on").css('display','none');
				$("#Stickers").css('top','');
				$("#Stickers").css('left','');
				$("#Stickers").css('bottom','');
				$("#Stickers").css('right','');
				$("#Stickers").css('background-color','');
				$.get(Stickers, function(data) {   //Stickers="./web/take_picture.html"
                    //optional stuff to do after success
                    //Stickers
                    $('#Stickers').html(data);
                });
  			});
		});
	</script>
</div>