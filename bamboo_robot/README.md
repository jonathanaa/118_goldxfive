# 專題資料
::: info
* 要下載東西，並安裝
1. git(https://gitforwindows.org/)
2. anaconda(要下載python3.xx)(https://www.anaconda.com/download/#windows)
3. xampp(php要第5版)https://www.apachefriends.org/zh_tw/download.html)
:::
:::success
* 設定環境(php篇)
1. php下載(https://windows.php.net/downloads/releases/php-5.6.34-nts-Win32-VC11-x64.zip)，在C槽先創建php資料夾，解壓zip至此資料夾，將資料夾內的php.ini-production改名為php.ini
2. 開啟檔案總管，在左邊資料夾點選電腦右鍵，選內容，進階系統設定，進階，環境變數，下面系統變數尋找Path，點選編輯，在變數值最後面，加上;C:\php，點選確定，點選確定，點選確定
3. 在xampp內的htdocs資料夾內，按右鍵，點git bash here，在bash內按右鍵貼這段(git clone https://github.com/kevinyay945/118.git)
4. 開啟/118/bamboo_robot/JIEBA/db_conn.php，將內部資料庫帳密及資料庫名稱改為自己的帳密及joomla的資料庫名稱
5. 開啟xampp/php資料夾，尋找php.ini(如果找到php.ini，請上網尋找如何開起副檔名)，右鍵，編輯，ctrl+f(尋找soap)，看到";extension=php_soap.dll"，將前面分號拿掉，再找";extension=php_sockets.dll"，也是把前面分號拿掉，記得要存檔窩!!!
6. 開啟/118/bamboo_robot/web/voice_detect.php，將$prefix(資料庫前綴詞)改成joomla前綴詞
7. 118/bamboo_robot/js/iframe.js 內的var hikashop_website="你的HIKASHOP網址"(EX: var hikashop_website = "http://127.0.0.1/lt_envico/index.php/project";)

:::
:::warning
* 設定環境(python篇)
1. 點選開始，找Anaconda Prompt
2. python看這個(https://hackmd.io/qnBFmkChRpKULU6-KL9ANg) 
:::
:::danger
* hikashop安裝(檔案位址請詢問系統管理員)
1. 解壓縮到quickstart_package.zip至xampp/htdocs，點選確定
2. 開起xampp/htdocs，新增資料夾lt_envico，解壓縮至此資料夾
3. 開啟xampp內的apache，和MySql
4. 打開Chrome(只能給我開Chrome)，在網址列打127.0.0.1/lt_envico，按enter
5. 按kickstart.php，按Esc，滾至最下面直接開始，執行安裝程式
6. 進到joomla裡面，找尋/components/com_hikashop/views/checkout/tmpl/step.php到最下面找尋clear both 上面加入指定程式碼(設定結帳
:::
:::info
環境設定(瀏覽器篇)
1. 在INDEX裡面找尋 #shopView裡面的height要改成螢幕大小
:::
-------------------------------------------------------------------------------------------------------------------------------
:::info
* 使用說明篇
1. 打開資料夾，xampp/htdocs/118/bamboo_robot/websocket_workerman/Applications/Chat/server.bat開啟，若顯示pong，表示成功，不用關掉
2. 開啟檔案總管，進入htdocs，進去118/bamboo_robot/facedect，將上面連結複製起來
3. 開啟Chrome，打127.0.0.1/118/bamboo_robot，看到連接成功、connect success，代標成功，開啟anaconda prompt，打上(cd 右鍵貼上)
4. 再打上(activate venv_demo)
5. python fa，按enter
6. 回到Chrome
7. 切換輸入法至英文
:::
:::danger
* 列印注意事項
1. 印表機驅動(http://www.vsi.com.tw/ezfiles/vectronix/img/img/98589/WP-T810_USB_DRIVER_1030910.pdf)
2. 模擬com port(D:/AppServ/www/118/Dillon/WP-T810/USB VCP/Prolific Pl2303HX/Windows/PL2303_Prolific_DriverInstaller_v1417.exe)
3. 執行(D:\AppServ\www\118\Dillon\WP-T810\下的exe檔)
    - 要插著印表機
    - WINPOS_USBCDC_Drivers_170704.exe是模擬PORT
4. WP-T810 Ver.3.10印表機驅動類型
4. php列印(1.將php_printer.dll放到D:/AppServ/php5/ext 2.在php.ini加上這行或把分號拿掉extension = php_printer.dll)
5. 發票生成，增加資料夾tmp、image
6. 資料庫搜尋(資料庫帳密更改)
7. php圖片轉檔(php_image_magician，D:/AppServ/www/118/Dillon)
8. 所有路徑都要注意
9. 確定有產生圖片到image，是.png檔，再轉檔成output_combine.bmp，因為php印圖檔只接受.bmp

* 麥克風篇 
1. 要記得把麥克風打開，不然google api 聽不到

* NFC篇
1. 將NFC的自動輸入裝好
:::
:::info
C++篇
1. Settings->Compiler...
2. Global compiler settings -> Linker settings -> Add
3. C:\CodeBlocks\MinGW\lib\libwsock32.a
4. C:\CodeBlocks\MinGW\lib\libws2_32.a
5. OK
:::
:::success
1. 關鍵字增加，進joomla，product->categories，new->name打關鍵字->parent_category把他打叉叉便none
2. 改主要幣值，system->configuration，main->currency，把main_currency改台幣
3. 進入每項商品改成台幣
4. step.php要放進joomla內(D:\AppServ\www\lt_envico\components\com_hikashop\views\checkout\tmpl\step.php)
5. step.php要記得改資料庫密碼(291~294行)，絕對路徑要改(223行)
6. 用ctrl+shift+F(sublime快捷鍵)搜尋全部的118資料夾，把這個路徑改對

:::

