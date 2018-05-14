TTS.ConverterIndex="./TTSPlugin/"; /*設定根目錄，預設為./TTSPlugin/*/
TTS.PlayerSet.width="100";/*設定播放器寬度*/
TTS.PlayerSet.height="100";/*設定播放器高度*/
TTS.PlayerSet.hidden="true";/*設定是否隱藏播放器 true:隱藏，false:顯示*/
TTS.serverType="php";/*設定伺服器應用程式語言類型php(預設)、asp*/
TTS. Audiofilename=new Date().getTime();/*設定下載音檔檔名，預設為時間戳記*/

TTS.ConverInit(“string” , ”media” , ”Bruce” , ”100” , ”0” , “0” , ”0”,”5”)
參數依序為：
StringOrObj.：希望轉換的標籤id，會過濾此標籤中所有的標籤，並且轉換文字為語音，若有不希望轉換的文字，則在該文字前後加上任意標籤並且加上notts屬性，值為 true (notts=
“true”)。
mediaID：設定最後的播放器及點擊圖示位置。為任意標籤。且一定要在此函數之上。
Speaker：設定語者。可選擇語者有Bruce、Theresa與Angela。可設置空值(即使用預設值)，預設值為Bruce。
Volume：音量大小，可調整範圍為0~100。可設置空值(即使用預設值)，預設值為100。
Speed：語音速度，可調整範圍為-10~10。可設置空值(即使用預設值)預設值為0。
PitchLevel：韻律調整：值越大則音高越高；反之則音高越低，可調整範圍-10~10，可設置空值(即使用預設值)，預設值為0。
PitchSign：韻律調整：0=正常、1=像機器人、2=像外國人說中文，可設置空值(即使用預設值)，預設值為0。
PitchScale：韻律調整：值越大則抑揚頓挫越明顯；反之則越趨平版，可調整範圍0~20，可設置空值(即使用預設值)，預設值為0。