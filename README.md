# Web-Requisition-TNUA-
基本介紹:架設網頁供使用者輸入基本資料以及預約資料，後端利用php進行資料轉換，儲存到MSSQL資料庫

<h2>建設Apache環境:</h2>
<h3>步驟一</h3>

* 下載Apache24，將資料夾放入C:槽，舉例 `C:\Program Files`
* 我的電腦(右鍵)→內容→進階系統設定→環境變數
* 新增系統變數中PATH的路徑，舉例`C:\Program Files\Apache24\bin`，使用者應給予相對應之路徑

<h3>步驟二</h3>

* 打開Apache24/conf中的httpd.conf檔
* 用ctrl+F找尋SRVROOT，將預設的SRVROOT改為你的Apache24的路徑，舉例`Define SRVROOT "C:\Program Files\Apache24" ServetRoot "${SRVROOT}"`
* 用ctrl+F找尋ServerName，將ServerName改為127.0.0.1
* 右鍵以系統管理員身分開啟cmd並輸入以下指令(請依先前設置路徑更改):</br>
**安裝**:`"C:\Program Files\Apache24\bin\httpd.exe" -k install -n apache`</br>
**解除安裝**:`"C:\Program Files\Apache24\bin\httpd.exe" -k uninstall -n apache`
注意:_解除安裝在後續安裝失敗或載卸時才使用_

<h3>步驟三</h3>
* 我的電腦(右鍵)→管理→服務→apache24(右鍵啟動)
* 到瀏覽器中打127.0.0.1若有出現Apach頁面則成功安裝!

<h2>建設php環境:</h2>
<h3>步驟一</h3>

* 下載php(7.2版VC15 x64 Thread Safe版本)
* 我的電腦(右鍵)→內容→進階系統設定→環境變數
* 新增系統變數中PATH的路徑，舉例`C:\php`，使用者應給予相對應之路徑

<h3>步驟二</h3>

* 進入php資料夾中找到php.ini-development重新命名改為php.ini </br>
_注意:副檔名有正確更改_
* 開啟php.ini找到 `extension_dir ="ext"` 括號內容更改成設定的路徑，舉例 `"C:\php\ext"`

<h3>步驟三</h3>

* 找到Apache資料夾中httpd.conf
* 開啟並在最後行新增 </br>

```
  <IfModule dir_module>
    DirectoryIndex index.php index.html
  </IfModule>
```
```
#LoadModule xml2enc_module module modules/mod_xm12enc.so
LoadModule php7_module "C:/php/php7apache2_4.dll"
<IfModule php7_module>
 PHPIniDir "C:/php"
 AddType application/x-httpd-php php
</IfModule>
```

