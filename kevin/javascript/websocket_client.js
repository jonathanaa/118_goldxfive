if (window.WebSocket){
			    console.log("This browser supports WebSocket!");
			} else {
			    console.log("This browser does not support WebSocket.");
			}
			var ws = new WebSocket("ws://127.0.0.1:8000");
			ws.onopen = function(){
				console.log('连接成功');
				var data="系统消息：建立连接成功";
				list(data);
				ws.send('11');
				//document.getElementById("frm1").style.height = (document.documentElement.clientHeight)+"px";
				//document.getElementById("frm1").style.display = "inline";
				//document.getElementById("frm2").style.display = "none";
			}
			ws.onmessage = function(e){
				var obj=eval("("+e.data+")");
				var data=obj.name+"消息:" + obj.mess;
			
				//document.getElementById("frm2").style.height = (document.documentElement.clientHeight)+"px";
				//document.getElementById("frm1").style.display = "none";
				//document.getElementById("frm2").style.display = "inline";
				if(obj.mess=='13'){
					detect_people();
				}
				list(data);
			}
			ws.onerror = function(){
				var data="出错了，请退出重试";
				list(data);
			}
			function send()
			{
				var msg=document.getElementById("msg").value;
				ws.send(msg);
				// var data="客户端消息："+msg;
				// list(data);
				// document.getElementById("msg").value='';
			}
			function list(data)
			{
				var p=document.createElement("p");
				p.innerHTML=data;
				var box=document.getElementById("list");
				box.appendChild(p);
				
			}