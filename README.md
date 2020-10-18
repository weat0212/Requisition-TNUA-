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
</br>

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

* 新增一個txt檔於apache24\htdocs中，並重新命名為info.php，文字編輯存入以下指令:

```
<?php 
phpinfo(); 
?>
```
* 打開 https://127.0.0.1/info.php 若出現php資訊頁面則成功安裝


<h2> MSSQL 設置 </h2>

* 根據php版本下載 Microsoft Drivers for PHP for SQL Server
https://docs.microsoft.com/zh-tw/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver15

* 執行後依版本選定資料夾中兩檔案(72為版本編號，ts為thread版；nts為non-thread版):
  * php_pdo_sqlsrv_72_ts_x64.dll
  * php_sqlsrv_72_ts_x64.dll
* 將兩檔案放到 php\ext 路徑位置中，並打開php.ini檔，最後新增指令:
  * extension=php_sqlsrv_72_ts_x64.dll
  * extension=php_pdo_sqlsrv_72_ts_x64.dll
* 重啟apache後，於網頁打開php資訊，若有 pdo_sqlsrv 欄則成功

<h2> MSSQL 權限驗證設置 </h2>

* 於SQL Server Management伺服器中，安全性→登入→新增登入
  * 點選SQL Server驗證，建立一組帳號密碼
  * 點選伺服器角色(全選)
  * 使用者對應→已對應到此登入的使用者(全選)，資料庫角色成員資格對象(db_owner選取)
* 伺服器(右鍵)→屬性→安全性→伺服器驗證→點選SQL Server 及 Windows 驗證模式
* 重新啟動SQL Server Management
  * 點選SQL Server驗證→輸入先前新增的帳號密碼→連線
  * 注意:若出現帳號密碼錯誤，利用windows驗證先登入，再行修改帳號密碼

![image](https://github.com/weat0212/Web-Requisition-TNUA-/blob/master/1.png)
