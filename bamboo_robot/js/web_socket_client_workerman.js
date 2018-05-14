        /*var ws = new WebSocket("ws://127.0.0.1:9999");在index宣告
        ws.onopen = function() {
            alert("連結成功");
            var data = '{"type":"login","name":'+'"web"'+'}';
            ws.send(data);
            ws.onmessage = onmessage;
            console.log(data);
        };
*/
    function onmessage(e){
        ws.onmessage = function(e) {
            var data_new =JSON.parse(e.data);
            if(data_new['type'] == 'pong'){
                console.log("pong");
            }
            if(data_new['type'] == 'nlp_done'){
                console.log("nlp_done");
                alert(data_new['data']);
            }
            if(data_new['type'] == 'login'){
                alert(data_new['dialogue']);
                var data = '{"type":"leave","name":'+'"web"'+'}';
                ws.send(data);
            }
            if(data_new['type'] == 'come'){
            //偵測到有人來了
                //alert(data_new['dialogue']);
                var sound = new Audio("./voice/welcome.wav");
                sound.play();
                setTimeout(startButton,3000);
                //startButton(event);
                $.get(guide_frame, function(data) {//聽"請問"   //guide_frame="./web/guide.html"
                    //optional stuff to do after success
                    $('#advertisement_1').html('');
                    $('#advertisement_1').css('display','none');
                    $('#advertisement_2').html(data);
                });
                $.get(Stickers, function(data) {   //Stickers="./web/take_picture.html"
                    //optional stuff to do after success
                    //Stickers
                    $('#Stickers').html(data);
                });

                if("-1"==hikashop_website.search("http://")){
                    $.get(hikashop_website,function(data){
                    $('#hikashop').html(data);
                });
                }else{
                    var tempWeb = '<iframe id="shopView" src="'+hikashop_website+'"  width="100%" frameborder="0" name="frm2" id="frm2"></iframe></div>';
                    $('#hikashop').html(tempWeb);
                }
                console.log("leave");
            }
            if(data_new['type'] == 'upload_picture'){
            //照片上船完畢
                console.log("upload success!!");
            }

        };
    }



