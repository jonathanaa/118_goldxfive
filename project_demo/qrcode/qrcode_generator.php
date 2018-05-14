<!DOCTYPE html>
<html>
<body>
<input type="text" id="id" > </input>
      <!--  <iframe src="http://140.123.175.103:8888/project_demo/qrcode/qrcode.php?ID=4" width="800px" height="600px" frameborder="0" scrolling="no"></iframe>
      -->
<p>輸入ID</p>

<button onclick="myFunction()">產生程式碼</button>

<script>
function myFunction() {

    var ID = document.getElementById("id").value;
    alert("<div><iframe src=\u0022http:\u005C\u005C140.123.175.103:8888\u005Cproject_demo\u005Cqrcode\u005Ciframe_qrcode.php?ID="+ID+"\u0022  frameborder=\u00220\u0022 scrolling=\u0022no\u0022>很抱歉，您的瀏覽器不支援浮動框架，所以無法顯示此框架的內容！</iframe></div>");
}
</script>

</body>
</html>





