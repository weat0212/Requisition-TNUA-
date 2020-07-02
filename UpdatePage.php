<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html>
<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>國立臺北藝術大學 展演藝術中心-查詢場地租用詳情</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
<div id="header">
    <h1><a href="QueryPage.html">查詢場地租用詳情</a></h1>
</div>


<?php
//表單編號用
global $O_Id;

function toText($type){
    if($type=='Show'){return '演出時段';}
    elseif($type=='Rehearsal'){return '裝台排練時段';}
}


if(!isset($_POST['applicant'])||!isset($_POST['contact'])||!isset($_POST['phone'])||!isset($_POST['aplyDate'])){
    echo "<h2>資料變數錯誤</h2>";
    exit();
}
else{
    if(empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['phone'])||empty($_POST['applicant'])){
        echo "<h2>資料輸入不完整</h2>";
        exit();
    }
    else{

        include("connection.php");
        
        $aplyDate=(string)$_POST['aplyDate'];
        $applicant=(string)$_POST['applicant'];
        $contact=(string)$_POST['contact'];
        $phone=(string)$_POST['phone'];

        $sql="SELECT * FROM dbo.Applicant WHERE applicant='$applicant' AND contact='$contact' AND phone='$phone'";
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
        
print <<<EOT
    <div id="contents">
            <form name="form" action="http://127.0.0.1/comment/ModifiedPage.php" method="POST" accept-charset="UTF-8" align="center">
            <div class="detail_box clearfix">
                <div class="link_box">
EOT;
while($row=sqlsrv_fetch_array($quer)){
    $address=$row['address'];
    $aplySupv=$row['aplySupv'];
    $phone=$row['phone'];
    $email=$row['email'];
print <<<EOT
<ul>
    <li>
    <div>
        申請日期：<input type="hidden" name="aplyDate" value=$aplyDate>$aplyDate<br/><br/>
        申請單位：<input type="hidden" name="applicant" value=$applicant>$applicant<br/><br/>
        申請單位主管：<input type="text" name="aplySupv" size="30" value='$aplySupv'><br/><br/>
    </div>
    <div>
        申請聯絡人：<input type="text" name="contact" size="30" value=$contact><br/><br/>
        地址：&emsp;&emsp;&emsp;<input type="text" name="address" size="30" value=$address><br/><br/>
        電話：&emsp;&emsp;&emsp;<input type="text" name="phone" size="30" minlength="9" maxlength="10" value=$phone><br/><br/>
        E-mail：&nbsp;&nbsp;&emsp;<input type="email" name="email" size="30" value=$email><br/><br/>
    </div>
    </li>
    <p id=dot></p>
EOT;
}

$sql="SELECT * FROM dbo.Ordering WHERE applicant='$applicant' AND aplyDate='$aplyDate'";
$quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());

while($row=sqlsrv_fetch_array($quer)){
$O_Id=$row['O_Id'];
$participant=$row['participant'];
$aplyfor=$row['aplyfor'];
$record=$row['record'];
$stageTear=$row['stageTear'];
$actContent=$row['actContent'];
$attachment=$row['attachment'];
$taxId=$row['taxId'];
$receipt=$row['receipt'];
$bankname=$row['returnBank'];
$bankbranch=$row['returnBranch'];
$returnAcc=$row['returnAcc'];
$accName=$row['accName'];

print <<<EOT
        <li>
            （1）參與人數 <input type="hidden" name="participant" value='$participant'>$participant 人
        </li>        
        <li>
            （2）申請項目：<input type="hidden" name="aplyfor" value=$aplyfor>$aplyfor
        </li>
        
        <li>
            （4）藝文展演與非藝文展演活動，自行安排錄音綠影（需另收2000元）：<input type="text" name="record" value=$record>
        </li>
        <li>
            （5）拆台時間：<input type="hidden" name="stageTear" value=$stageTear>$stageTear
        </li>
        <li>
            （6）活動內容：<input type="hidden" name="actContent" value=$actContent><br/><br/>$actContent<br/><br/>
        </li>
        <li>
            （7）附件：<input type="hidden" name="attachment" value=$attachment>$attachment
            <br/><br/>
        </li>
        <li>
            發票抬頭：<input type="text" name="receipt" size="20"/ value=$receipt>&emsp;
            統一編號：<input type="text" name="taxId" size="20" value=$taxId><br/><br/>
        </li>
        <li>
            <font size="3">保證金退款：</font><br/><br/>
            <input type="text" name="returnBank" size="15" value=$bankname>銀行/郵局，<input type="text" name="returnBranch" size="15"/ value=$bankbranch>分行<br/><br/>
            帳號：<input type="text" name="returnAcc" size="30" value=$returnAcc>&emsp;
            戶名：<input type="text" name="accName" size="15"/ value=$accName><br/><br/>
        </li>
        <p id=dot></p>
EOT;
}

$sql="SELECT * FROM dbo.Rentaltime WHERE O_Id='$O_Id'";
$quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());

while($row=sqlsrv_fetch_array($quer)){
    $rentDate=$row['rentDate'];
    $rehearsalShow=$row['rehearsalShow'];
    $rentTime=$row['rentTime'];
    $facility=$row['facility'];
print <<<EOT
<li>
    申請場地：$facility
</li>
<li>
    租借日期：$rentDate
</li>
<li>
    裝台排練/演出：$rehearsalShow
</li>
<li>
    租借時間：$rentTime
</li>
<p id=dot></p>
EOT;
}
print <<<EOT
</br>
    <input type="submit" value="確認" >
    <input type='button' align='right' value="取消" onclick="location.href='UpdatePage.html'">
</div>
</div>          
EOT;

}
}
sqlsrv_free_stmt($quer);  
sqlsrv_close($conn);
?> 


<footer id="footer">
    <p>112 台北市北投區學園路一號 國立台北藝術大學 展演藝術中心</p>
    <p>Tel:(02)2893-8163</p>
</footer>
</body></html>
