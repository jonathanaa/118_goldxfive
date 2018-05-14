var infoBox=''; // 訊息 label
var textBox=''; // 最終的辨識訊息 text input
var tempBox=''; // 中間的辨識訊息 text input
var startStopButton=''; // 「辨識/停止」按鈕
var final_transcript = ''; // 最終的辨識訊息的變數
var recognizing = false; // 是否辨識中
var langCombo='cmn-Hant-TW';
var check_ask=false;
//----------------------------------------------------------------------------------------//
var infoBox_keyword=''; // 訊息 label
var textBox_keyword=''; // 最終的辨識訊息 text input
var tempBox_keyword=''; // 中間的辨識訊息 text input
var startStopButton_keyword=''; // 「辨識/停止」按鈕
var final_transcript_keyword = ''; // 最終的辨識訊息的變數
var recognizing_keyword = false; // 是否辨識中
var langCombo_keyword='cmn-Hant-TW';
var playsoundonce=0;
var recognition_keyword;
var story_chinese=0;
//----------------------------------------------------------------------------------------//
var infoBox_keyword_english=''; // 訊息 label
var textBox_keyword_english=''; // 最終的辨識訊息 text input
var tempBox_keyword_english=''; // 中間的辨識訊息 text input
var startStopButton_keyword_english=''; // 「辨識/停止」按鈕
var final_transcript_keyword_english = ''; // 最終的辨識訊息的變數
var recognizing_keyword_english = false; // 是否辨識中
var recognition_keyword_english;
//----------------------------------------------------------------------------------------//
function clock() {
var bar = "";
var now = new Date();
bar += now.getMinutes() + ":";
bar += now.getSeconds()+":";
bar+=now.getMilliseconds();
console.log(bar);
}

//----------------------------------------------------------------------------------------//

function startButton(event) {
  /*infoBox = document.getElementById("infoBox"); // 取得訊息控制項 infoBox
  textBox = document.getElementById("textBox"); // 取得最終的辨識訊息控制項 textBox
  tempBox = document.getElementById("tempBox"); // 取得中間的辨識訊息控制項 tempBox
  startStopButton = document.getElementById("startStopButton"); // 取得「辨識/停止」這個按鈕控制項
  langCombo = document.getElementById("langCombo"); // 取得「辨識語言」這個選擇控制項*/
  if (recognizing) { // 如果正在辨識，則停止。
    recognition.stop();
  } else { // 否則就開始辨識
    textBox = ''; // 清除最終的辨識訊息
    tempBox = ''; // 清除中間的辨識訊息
    final_transcript = ''; // 最終的辨識訊息變數
    recognition.lang = langCombo; // 設定辨識語言
    recognition.start(); // 開始辨識
  }
}

function playsound(language)
{
  if(language=="chinese"){
    var sound = new Audio("./voice/ask.mp3");
  console.log('請問偵測結束');
  clock();
  recognition.stop();
  sound.play();
  setTimeout(startButton_keyword,2000);//settimeout要等待的函式不能有括號
  }
  else if(language=="english"){
  var sound = new Audio("./voice/ask.mp3");
  console.log('detect finish');
  clock();
  recognition.stop();
  sound.play();
  setTimeout(startButton_keyword_english,2000);//settimeout要等待的函式不能有括號
  }
  //alert("波音樂");
      
}


if (!('webkitSpeechRecognition' in window)) {  // 如果找不到 window.webkitSpeechRecognition 這個屬性
  // 就是不支援語音辨識，要求使用者更新瀏覽器。 
  infoBox= "本瀏覽器不支援語音辨識，請更換瀏覽器！(Chrome 25 版以上才支援語音辨識)";
} else {
  var recognition = new webkitSpeechRecognition(); // 建立語音辨識物件 webkitSpeechRecognition
  recognition.continuous = true; // 設定連續辨識模式 **********
  recognition.interimResults = true; // 設定輸出中先結果。
  //---------------------------------------------------------------------------------------------------------//
  recognition_keyword = new webkitSpeechRecognition(); // 建立語音辨識物件 webkitSpeechRecognition
  recognition_keyword.continuous = false; // 設定連續辨識模式
  recognition_keyword.interimResults = true; // 設定輸出中先結果。
  //---------------------------------------------------------------------------------------------------------//
  recognition_keyword_english = new webkitSpeechRecognition(); // 建立語音辨識物件 webkitSpeechRecognition
  recognition_keyword_english.continuous = false; // 設定連續辨識模式
  recognition_keyword_english.interimResults = true; // 設定輸出中先結果。
  //---------------------------------------------------------------------------------------------------------//
  recognition.onstart = function() { // 開始辨識
    recognizing = true; // 設定為辨識中
    startStopButton = "按此停止"; // 辨識中...按鈕改為「按此停止」。  
    infoBox= "辨識中...";  // 顯示訊息為「辨識中」...
  };

  var string_ask="請問";
  var string_ask_english="excuse";

  recognition.onresult = function(event) { // 辨識有任何結果時
    console.log('收聽請問中');
    var interim_transcript = ''; // 中間結果
    for (var i = event.resultIndex; i < event.results.length; ++i) { // 對於每一個辨識結果
      if (event.results[i].isFinal) { // 如果是最終結果
        final_transcript += event.results[i][0].transcript; // 將其加入最終結果中
      } else { // 否則
        interim_transcript += event.results[i][0].transcript; // 將其加入中間結果中
      }
    }
    if (final_transcript.trim().length > 0){ // 如果有最終辨識文字
        textBox = final_transcript; // 顯示最終辨識文字
        //alert($('input[name="textBox"]').val());
        //string_ask.indexOf("Hello");
        //alert(final_transcript.trim());
      }
    if (interim_transcript.trim().length > 0){ // 如果有中間辨識文字
        tempBox = interim_transcript;// 顯示中間辨識文字
        console.log(tempBox);
        //alert(tempBox);
        if(tempBox.indexOf(string_ask)>=0){ //判斷有沒有請問
          check_ask=true;
          //alert(tempBox);
          if(playsoundonce==0){
            playsound("chinese");
            playsoundonce++;
            
          }

          //alert(check_ask);
          //recognition.onend();
        }else if(tempBox.indexOf(string_ask_english)>=0){//判斷有沒有excuse
          check_ask=true;
          //alert(tempBox);
          if(playsoundonce==0){
            playsound("english");
            playsoundonce++;
            
          }
        }
        //alert($('input[name="tempBox"]').val());
        //alert(tempBox.value);
        //alert(tempBox.value.indexOf(string_ask));
        //alert(interim_transcript.trim()); 
      }
  };

  recognition.onend = function() { // 辨識完成
    console.log('辨識已結束');
    recognizing = false; // 設定為「非辨識中」
    startStopButton = "開始辨識";  // 辨識完成...按鈕改為「開始辨識」。
    infoBox= ""; // 不顯示訊息
    if(check_ask==true){
      console.log('收音到了請問');
      clock();
      //alert("聽到請問");
      //playsoundonce=0;
      recognition.stop();
      //alert("請說停");
      check_ask=false;
      //startButton_keyword(event);
    }
    /*else{
      console.log('收音請問停住');
      //alert("停住");
      //recognition.start();
      startButton(event);
      //$('#startStopButton').trigger("click");
    }*/
  };

  
}
//------------------------------------------------------------------------------------------------------------------//
function startButton_keyword(event_keyword) {
  console.log('startButton_keyword');
  clock();
  /*infoBox_keyword = document.getElementById("infoBox_keyword"); // 取得訊息控制項 infoBox_keyword
  textBox_keyword = document.getElementById("textBox_keyword"); // 取得最終的辨識訊息控制項 textBox_keyword
  tempBox_keyword = document.getElementById("tempBox_keyword"); // 取得中間的辨識訊息控制項 tempBox_keyword
  startStopButton_keyword = document.getElementById("startStopButton_keyword"); // 取得「辨識/停止」這個按鈕控制項
  langCombo_keyword = document.getElementById("langCombo_keyword"); // 取得「辨識語言」這個選擇控制項*/
  //alert("新的收音");
  //setTimeout("timedMsg()",10000);
  if (recognizing_keyword) { // 如果正在辨識，則停止。
    
    recognition_keyword.stop();

  } else { // 否則就開始辨識
    //alert("新的收音1");
    textBox_keyword = ''; // 清除最終的辨識訊息
    tempBox_keyword = ''; // 清除中間的辨識訊息
    final_transcript_keyword = ''; // 最終的辨識訊息變數
    recognition_keyword.lang = langCombo_keyword; // 設定辨識語言
    recognition_keyword.start(); // 開始辨識
  }
}

  /*var recognition_keyword = new webkitSpeechRecognition(); // 建立語音辨識物件 webkitSpeechRecognition
  recognition_keyword.continuous = false; // 設定連續辨識模式
  recognition_keyword.interimResults = true; // 設定輸出中先結果。*/

  recognition_keyword.onstart = function() { // 開始辨識
    //document.getElementById("loader").className= "loader-21";
    //alert("開始辨識");
    
    //recognition.stop();
    console.log('中文版開始辨識');
    recognizing_keyword = true; // 設定為辨識中
    startStopButton_keyword = "按此停止"; // 辨識中...按鈕改為「按此停止」。  
    infoBox_keyword = "正在辨識中...";  // 顯示訊息為「辨識中」...

};

  recognition_keyword.onend = function() { // 辨識完成
    recognizing_keyword = false; // 設定為「非辨識中」
    startStopButton_keyword = "開始辨識";  // 辨識完成...按鈕改為「開始辨識」。
    infoBox_keyword= ""; // 不顯示訊息
    //alert(tempBox_keyword.value);//傳值
    console.log('我聽到'+tempBox_keyword);
    if(tempBox_keyword.indexOf("產品")!=-1 && story_chinese==0){
      console.log('你想聽什麼產品');
      var sound = new Audio("./voice/what_story.wav");
      sound.play();
      story_chinese=1;
      setTimeout(startButton_keyword,2000);
      return;
    }
    if(story_chinese==1){
      story_chinese=0;
      console.log('以下是我搜尋到的產品,你想聽什麼');
      var sound = new Audio("./voice/story.wav");
      sound.play();
      playsoundonce=0;
      $.get(advertisement_2+'?voiceText='+tempBox_keyword+'&story=1', function(data) {
          //optional stuff to do after success
          $('#advertisement_1').html(data);
          $('#advertisement_1').css('display','block');
          $('#advertisement_2').html("");
      });
      return;
    }
    clock();
    //alert(tempBox_keyword);
    //--------------------------輸出語音跳到結疤-------------------------//
    playsoundonce=0;
    $.get(advertisement_2+'?voiceText='+tempBox_keyword+'&story=0', function(data) {
          //optional stuff to do after success
          $('#advertisement_1').html(data);
          $('#advertisement_1').css('display','block');
          $('#advertisement_2').html("");
      });
    //-----------------------------------------------------------------//
  };

  recognition_keyword.onresult = function(event_keyword) { // 辨識有任何結果時
    var interim_transcript_keyword = ''; // 中間結果
    for (var ii = event_keyword.resultIndex; ii < event_keyword.results.length; ++ii) { // 對於每一個辨識結果
      if (event_keyword.results[ii].isFinal) { // 如果是最終結果
        final_transcript_keyword += event_keyword.results[ii][0].transcript; // 將其加入最終結果中
      } else { // 否則
        interim_transcript_keyword += event_keyword.results[ii][0].transcript; // 將其加入中間結果中
      }
    }
    if (final_transcript_keyword.trim().length > 0) // 如果有最終辨識文字
        textBox_keyword = final_transcript_keyword; // 顯示最終辨識文字
    if (interim_transcript_keyword.trim().length > 0){ // 如果有中間辨識文字
        tempBox_keyword = interim_transcript_keyword; // 顯示中間辨識文字
      }
  };

//--------------------------------------english natural language process-----------------------------------------------------//

function startButton_keyword_english(event_keyword_english) {
  console.log('startButton_keyword_english');
  clock();
  /*infoBox_keyword_english = document.getElementById("infoBox_keyword_english"); // 取得訊息控制項 infoBox_keyword_english
  textBox_keyword_english = document.getElementById("textBox_keyword_english"); // 取得最終的辨識訊息控制項 textBox_keyword_english
  tempBox_keyword_english = document.getElementById("tempBox_keyword_english"); // 取得中間的辨識訊息控制項 tempBox_keyword_english
  startStopButton_keyword_english = document.getElementById("startStopButton_keyword_english"); // 取得「辨識/停止」這個按鈕控制項
  langCombo_keyword_english = document.getElementById("langCombo_keyword_english"); // 取得「辨識語言」這個選擇控制項*/
  //alert("新的收音");
  //setTimeout("timedMsg()",10000);
  if (recognizing_keyword_english) { // 如果正在辨識，則停止。
    
    recognition_keyword_english.stop();

  } else { // 否則就開始辨識
    //alert("新的收音1");
    textBox_keyword_english = ''; // 清除最終的辨識訊息
    tempBox_keyword_english = ''; // 清除中間的辨識訊息
    final_transcript_keyword_english = ''; // 最終的辨識訊息變數
    recognition_keyword_english.lang = 'en-US'; // 設定辨識語言
    recognition_keyword_english.start(); // 開始辨識
  }
}

  /*var recognition_keyword_english = new webkitSpeechRecognition(); // 建立語音辨識物件 webkitSpeechRecognition
  recognition_keyword_english.continuous = false; // 設定連續辨識模式
  recognition_keyword_english.interimResults = true; // 設定輸出中先結果。*/

  recognition_keyword_english.onstart = function() { // 開始辨識
    //document.getElementById("loader").className= "loader-21";
    //alert("開始辨識");
    
    //recognition.stop();
    console.log('start dection');
    recognizing_keyword_english = true; // 設定為辨識中
    startStopButton_keyword_english = "按此停止"; // 辨識中...按鈕改為「按此停止」。  
    infoBox_keyword_english = "正在辨識中...";  // 顯示訊息為「辨識中」...

};

  recognition_keyword_english.onend = function() { // 辨識完成
    recognizing_keyword_english = false; // 設定為「非辨識中」
    startStopButton_keyword_english = "開始辨識";  // 辨識完成...按鈕改為「開始辨識」。
    infoBox_keyword_english= ""; // 不顯示訊息
    //alert(tempBox_keyword_english.value);//傳值
    console.log('I listen'+tempBox_keyword_english);
    clock();
    alert(tempBox_keyword_english);
    //--------------------------輸出語音跳到python-------------------------//
    playsoundonce=0;
    console.log(test);
    var data_english = '{"type":"nlp","dialogue":"'+tempBox_keyword_english+'"}';
    console.log(test+'send this :'+data_english);
    console.log(typeof(data_english));
    ws.send(data_english);
    console.log('send finish');
    //-----------------------------------------------------------------//
  };

  recognition_keyword_english.onresult = function(event_keyword_english) { // 辨識有任何結果時
    var interim_transcript_keyword_english = ''; // 中間結果
    for (var ii = event_keyword_english.resultIndex; ii < event_keyword_english.results.length; ++ii) { // 對於每一個辨識結果
      if (event_keyword_english.results[ii].isFinal) { // 如果是最終結果
        final_transcript_keyword_english += event_keyword_english.results[ii][0].transcript; // 將其加入最終結果中
      } else { // 否則
        interim_transcript_keyword_english += event_keyword_english.results[ii][0].transcript; // 將其加入中間結果中
      }
    }
    if (final_transcript_keyword_english.trim().length > 0) // 如果有最終辨識文字
        textBox_keyword_english = final_transcript_keyword_english; // 顯示最終辨識文字
    if (interim_transcript_keyword_english.trim().length > 0){ // 如果有中間辨識文字
        tempBox_keyword_english = interim_transcript_keyword_english; // 顯示中間辨識文字
      }
  };