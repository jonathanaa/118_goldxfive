//alert("TTSscript");
var intervalImg="";
function createRequest(){
  try{
    request= new XMLHttpRequest();
  } catch (tryMS){
    try{
      request = new ActiveXObject("Msxm12.XMLHTTP");
    } catch (otherMS){
      try{
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch(failed){
        request = null;
      }
    }
  }
  return request;
}

function removeAllChild(obj){
	if ( obj.hasChildNodes() )
	{
		while ( obj.childNodes.length >= 1 )
		{
			obj.removeChild( obj.firstChild );       
		} 
	}
	
	return 1;
}

function getElementsByClassName(Name){
	var nodes=[];
	var allTags = document.getElementsByTagName("*");
	for(var key in allTags){
		if(allTags[key].nodeType==1&&allTags[key].className==Name){
			nodes.push(allTags[key]);
		}
	}
	return nodes;
} 
function getElementsByDefined(Name){
	var nodes=[];
	var allTags = document.getElementsByTagName("*");
	for(var key in allTags){
		if(allTags[key].nodeType==1&&allTags[key].getAttribute(Name)=="true"){
			nodes.push(allTags[key]);
		}
	}
	return nodes;
} 
String.prototype.strip_tags = function(){
	tags = this;
	stripped = tags.replace(/<[\/\!\?]?([\w_-]*)[^>]*>/igm, "");
	return stripped;
}

var Sys = {};
var ua = navigator.userAgent.toLowerCase();
var s;  
(s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :  
(s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :  
(s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :  
(s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :  
(s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0; 
a=navigator.userAgent||navigator.vendor||window.opera;
Sys.mobile = (/ipad|android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) ? 1 : 0;

/*ie上使用mediaplayer時的播放控制*/
function control(){
    var phx = document.getElementById("MIDIPlayer");
        //phx.controls.pause();
        //alert(phx.playState);
        if(phx.playState == 1 || phx.playState ==2){
            phx.controls.play();
            document.getElementById("stopimg").src=TTS.ConverterIndex+"images/Pause.png";
        }else if(phx.playState == 3){
            phx.controls.pause();
            document.getElementById("stopimg").src=TTS.ConverterIndex+"images/Play.png";
        }
}


var TTS={
	inDomId:"",
	ConverterIndex:"./TTSTool/",
	serverType:"php",
	Audiofilename:new Date().getTime(),
	PlayerSet:{
		width:200,
		height:300,
		hidden:true,
		outtype:"wav"
	},
	ConvertInit:function(stringID,mediaID,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale){
		TTS.inDomId=mediaID;
		var string="";
		if(document.getElementById(stringID)){
			var stringIDtag = document.getElementById(stringID);
			var stringIDtagname = document.getElementById(stringID).tagName;
			if(stringIDtagname == "DIV" || stringIDtagname == "A" || stringIDtagname == "LI" || stringIDtagname == "SPAN"){			
				string = stringIDtag.innerHTML;
			
				/*var noTTSaryClass = getElementsByClassName("noTTS");
				for(var i=0;i<noTTSaryClass.length;i++){
					string = string.replace(noTTSaryClass[i].innerHTML,"");
				}
				var noTTSaryName = document.getElementsByName("noTTS");
				for(var i=0;i<noTTSaryName.length;i++){
					string = string.replace(noTTSaryName[i].innerHTML,"");
				}*/
				var noTTSaryClass = getElementsByDefined("noTTS");
				for(var i=0;i<noTTSaryClass.length;i++){
					string = string.replace(noTTSaryClass[i].innerHTML,"");
				}
				
				
			}else if(stringIDtagname == "INPUT" || stringIDtagname == "TEXTAREA" ){
				string = stringIDtag.value;
			}
		}else{
			string=stringID;
		}
		string = string.strip_tags();
        //alert(string.length);
		//alert(string);
        if(string.length>1500){
            alert("字數超過1500字！");
            return;
        }
		
		document.getElementById(mediaID).style.overflow="hidden";
		//document.getElementById(mediaID).style.height=TTS.PlayerSet.height+"px";
		//document.getElementById(mediaID).style.width=TTS.PlayerSet.width+42+"px";
		document.getElementById(mediaID).style.height="45px";
		document.getElementById(mediaID).style.width="130px";
		var Status = document.createElement("div");
		Status.style.styleFloat="left";
		Status.style.cssFloat="left";
		Status.id="status";
		document.getElementById(mediaID).appendChild(Status);
		var newImg = document.createElement("img");
		newImg.src=TTS.ConverterIndex+"images/playing.png";
		newImg.id="loading";
		newImg.width = "41";
		newImg.height = "41";
		Status.appendChild(newImg);
		document.getElementById("loading").onclick = function(){
					TTS.ConvertText(string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale);
		};
		var newIframeDiv = document.createElement("div");
		document.getElementById(TTS.inDomId).appendChild(newIframeDiv);
		newIframeDiv.id="newIframeDiv";
        newIframeDiv.style.width="0px";
        newIframeDiv.style.height="0px";
	},
	ConvertText:function(string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale){
				document.getElementById("loading").onclick="";
				document.getElementById("loading").src=TTS.ConverterIndex+"images/loading.gif";
				removeAllChild(document.getElementById("newIframeDiv"));
				if(document.getElementById("newMediaPanel"))document.getElementById("newMediaPanel").parentNode.removeChild(document.getElementById("newMediaPanel"));
				if(document.getElementById("newImg2"))document.getElementById(TTS.inDomId).removeChild(document.getElementById("newImg2"));
				//removeAllChild(document.getElementById("status"));
				
				var newIframe = document.createElement("iframe");
				newIframe.src = TTS.ConverterIndex+"func/TTSConverter."+TTS.serverType;
				newIframe.id = "iframe";
				newIframe.width=0;
				newIframe.height=0;
				newIframe.setAttribute('frameborder','0');
				newIframe.setAttribute('scrolling','no');
				document.getElementById("newIframeDiv").appendChild(newIframe);
				
                
                
				var iobj = newIframe.contentWindow;			
				if (newIframe.attachEvent){
					var newfunc = function(){
						iobj.document.getElementById("string").value=string;
						iobj.document.getElementById("speaker").value=speaker;
						iobj.document.getElementById("Volume").value=Volume;
						iobj.document.getElementById("speed").value=speed;
						iobj.document.getElementById("outputType").value=TTS.PlayerSet.outtype;
						iobj.document.getElementById("pitchLevel").value=pitchLevel;
						iobj.document.getElementById("pitchSign").value=pitchSign;
						iobj.document.getElementById("pitchScale").value=pitchScale;
						iobj.document.getElementById("TTSform").submit();
						newIframe.detachEvent("onload",newfunc);
					}
					newIframe.attachEvent("onload", newfunc);
                    //alert("x");
				} else {
				        //alert(string);
					newIframe.onload = function(){
						iobj.document.getElementById("string").value=string;
						iobj.document.getElementById("speaker").value=speaker;
						iobj.document.getElementById("Volume").value=Volume;
						iobj.document.getElementById("speed").value=speed;
						iobj.document.getElementById("outputType").value=TTS.PlayerSet.outtype;
						iobj.document.getElementById("pitchLevel").value=pitchLevel;
						iobj.document.getElementById("pitchSign").value=pitchSign;
						iobj.document.getElementById("pitchScale").value=pitchScale;
						iobj.document.getElementById("TTSform").submit();
						newIframe.onload="";
                        //alert("u");
					};
				}
				
				interval = setInterval(
					function(){
						//alert(iobj.document.getElementById("ConvertID").value);
						if(iobj.document.getElementById("ConvertID")){
							if(iobj.document.getElementById("ConvertID").value != ""){
								clearInterval(interval);
								var convertID = iobj.document.getElementById("ConvertID").value;
                                //alert(convertID);
                                if(isNaN(convertID)){
                                    alert(convertID);
                                }else{
								    convertRequest(convertID,string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale);
                                }

							}
						}
					},	
					100
				);
	}
	
}
function convertRequest(convertID,string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale){
		var newrequest = createRequest();
		var url=TTS.ConverterIndex+"func/TTSConverter."+TTS.serverType+"?ConvertID=" + convertID + "&cache=" +new Date().getTime();
		newrequest.onreadystatechange = function(){
			if (newrequest.readyState == 4 && newrequest.status == 200){
				//alert(newrequest.responseText);
				var resultArray = newrequest.responseText.split("|");
				var resultUrl = resultArray[4];
				//alert(resultUrl);
				if(resultUrl!=""){
					//alert(resultUrl);
					//removeAllChild(document.getElementById(TTS.inDomId));
					document.getElementById("loading").src=TTS.ConverterIndex+"images/playing.png";
					
					var mediaplayerwidth = 0;
					var mediaplayerheight = 0;
					if(!TTS.PlayerSet.hidden){
						removeAllChild(document.getElementById(TTS.inDomId));
						mediaplayerwidth = TTS.PlayerSet.width;
						mediaplayerheight = TTS.PlayerSet.height;
					}
					
					var newMediaPanel = document.createElement("div");
					newMediaPanel.id="newMediaPanel";
					newMediaPanel.style.styleFloat="left";
					newMediaPanel.style.cssFloat="left";
					document.getElementById(TTS.inDomId).appendChild(newMediaPanel);
					
					if(!Sys.ie){
						var newaudio = document.createElement("audio");	
						if(!TTS.PlayerSet.hidden)newaudio.setAttribute('controls','controls');
                        else{
                            var stopimg = document.createElement("img");
                            stopimg.src=TTS.ConverterIndex+"images/Pause.png";
                            stopimg.id="stopimg";
                        }	
						newaudio.id="ttsplayer";
						newaudio.setAttribute('autoplay','autoplay');						
						newaudio.style.width=mediaplayerwidth+"px";						
						newaudio.style.height=mediaplayerheight+"px";
						newMediaPanel.appendChild(newaudio);
						newaudio.src=resultUrl;
						newaudio.play();
                        if(!document.getElementById("stopimg")){
                            newMediaPanel.appendChild(stopimg);  
                            stopimg.onclick=function(){
                                //alert(newaudio.paused);
                                if(newaudio.paused==false){
                                    newaudio.pause();
                                    stopimg.src=TTS.ConverterIndex+"images/Play.png";
                                    //alert("x");
                                }else{
                                    newaudio.play();
                                    stopimg.src=TTS.ConverterIndex+"images/Pause.png";
                                }
                            }
                        }
					}else{
						//alert("x");
						//alert(document.getElementById("newMediaPanel").id);
						
						//var inner = function(){
							/*newMediaPanel.innerHTML='<object id="MIDIPlayer" name="MIDIPlayer"  data="'+resultUrl+'" type="video/x-ms-wmv" width="'+mediaplayerwidth+'" height="'+mediaplayerheight+'">'+
																	'<PARAM name="fileName" value="'+resultUrl+'">'+
																	'<param name="AutoStart" value="1">'+
																	'<param name="AutoRewind" value="-1">'+
																	'<param name="AnimationAtStart" value="false">'+
																	'<param name="ShowControls" value="true">'+
																	'<param name="ClickToPlay" value="false">'+
																	'<param name="EnableContextMenu" value="true">'+
																	'<param name="EnablePositionControls" value="false">'+
																	'<param name="Balance" value="0">'+
																	'<param name="ShowStatusBar" value="false">'+
																	'<param name="AutoSize" value="0">'+
																	'</object>'+
                                                                    '<img src="'+TTS.ConverterIndex+'images/Pause.png" onclick="control()">';*/
                          newMediaPanel.innerHTML='<object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" id="MIDIPlayer" width="'+mediaplayerwidth+'" height="'+mediaplayerheight+'">'+
                                                        '<param name="URL" value="'+resultUrl+'">'+
                                                        '<param name="rate" value="1">'+
                                                        '<param name="balance" value="0">'+
                                                        '<param name="currentPosition" value="0">'+
                                                        '<param name="defaultFrame" value>'+
                                                        '<param name="playCount" value="1">'+
                                                        '<param name="autoStart" value="1">'+
                                                        '<param name="currentMarker" value="0">'+
                                                        '<param name="invokeURLs" value="-1">'+
                                                        '<param name="baseURL" value>'+
                                                        '<param name="volume" value="50">'+
                                                        '<param name="mute" value="0">'+
                                                        '<param name="uiMode" value="full">'+
                                                        '<param name="stretchToFit" value="0">'+
                                                        '<param name="windowlessVideo" value="0">'+
                                                        '<param name="enabled" value="-1">'+
                                                        '<param name="enableContextMenu" value="-1">'+
                                                        '<param name="fullScreen" value="0">'+
                                                        '<param name="SAMIStyle" value>'+
                                                        '<param name="SAMILang" value>'+
                                                        '<param name="SAMIFilename" value>'+
                                                        '<param name="captioningID" value>'+
                                                        '<param name="enableErrorDialogs" value="0">'+
                                                        '<param name="_cx" value="6482">'+
                                                        '<param name="_cy" value="6350">'+
                                                        '</object>'+
                                                        '<img id="stopimg" src="'+TTS.ConverterIndex+'images/Pause.png" onclick="control()">';
                           /* if(TTS.PlayerSet.hidden){
                                var stopimg = document.createElement("img");
                                stopimg.src=TTS.ConverterIndex+"images/Pause.png";
                                stopimg.id="stopimg";
                                newMediaPanel.appendChild(stopimg); 
                                stopimg.onclick = function(){
                                   // document.getElementById("MIDIPlayer").controls.pause();
                                   alert(document.getElementById("MIDIPlayer").currentMedia);
                                }
                            }*/
                            //alert("x");
                            
						//}
						//setTimeout(inner,1000);
						
					}
					
					var downloadRequest = createRequest();
					var url=TTS.ConverterIndex+"func/TTSConverter."+TTS.serverType+"?ConvertID=" + convertID + "&download=1"+"&audiofilename="+TTS.Audiofilename+"&cache=" +new Date().getTime();
					//alert(url);
					
					downloadRequest.onreadystatechange = function(){
						
						if(downloadRequest.readyState == 1) {
								if(!document.getElementById("newImg2")){
									var newImg2 = document.createElement("img");
									newImg2.src=TTS.ConverterIndex+"images/download.png";
									newImg2.width="41";
									newImg2.height="41";
									newImg2.style.cssFloat="left";
									newImg2.style.styleFloat="left";
									newImg2.id="newImg2";
									document.getElementById(TTS.inDomId).insertBefore(newImg2,document.getElementById("newMediaPanel"));
								}
								var n=0;
									if(intervalImg==""){
										intervalImg = setInterval(
											function(){
												if(document.getElementById("newImg2")){
													n++;
													if(n%2==1)document.getElementById("newImg2").style.visibility="hidden";	
													else document.getElementById("newImg2").style.visibility="visible";
												}
											},	
										500
										); 
									}
									
						}
						if (downloadRequest.readyState == 4 && downloadRequest.status == 200){
								//alert(downloadRequest.responseText);
								clearInterval(intervalImg);
								//clearInterval(intervalImg);
								if(document.getElementById("newImg2").style.visibility=="hidden")document.getElementById("newImg2").style.visibility="visible";
								if(downloadRequest.responseText==1){
									document.getElementById("newImg2").src=TTS.ConverterIndex+"images/accept.png";
								}else{
									alert("下載失敗，請檢查目錄路徑及目錄的寫入權限是否正確！")
								}
								if(document.getElementById("loading")){
									document.getElementById("loading").onclick=function(){
										TTS.ConvertText(string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale);
									}
								}
						}
					}
					downloadRequest.open("GET",url,true);
					downloadRequest.send(null);	
					
					
					
				}else{
					convertRequest(convertID,string,speaker,Volume,speed,pitchLevel,pitchSign,pitchScale);
				}
				
			}
		};
		newrequest.open("GET",url,true);
		newrequest.send(null);	
}