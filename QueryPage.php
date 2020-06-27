<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html>
<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>查詢場地租用詳情</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
        <h1><a href="QueryPage.html">查詢場地租用詳情</a></h1>
  </div>


<div id="contents">
<?php

//表單編號用
global $O_Id;

function toText($type){
    if($type=='Show'){return '演出時段';}
    elseif($type=='Rehearsal'){return '裝台排練時段';}
}

function YN($type){
    if($type=='Y'){return '自行安排';}
    elseif($type=='N'){return '沒有安排';}
}

if(!isset($_POST['applicant'])||!isset($_POST['contact'])||!isset($_POST['phone'])||!isset($_POST['applyDate'])){
    echo "<h2>資料變數錯誤</h2>";
    exit();
}
else{
    if(empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['phone'])||empty($_POST['applicant'])){
        echo "<h2>資料輸入不完整</h2>";
        exit();
    }
    else{
        $serverName = "DESKTOP-PGTDFJ7";
        $connectionInfo = array( "Database"=>"FinalProject", "UID"=>"andywang", "PWD"=>"andy0212", "CharacterSet" => "UTF-8");
        $conn=sqlsrv_connect($serverName,$connectionInfo);
        
        $applyDate=(string)$_POST['applyDate'];
        $applicant=(string)$_POST['applicant'];
        $contact=(string)$_POST['contact'];
        $phone=(string)$_POST['phone'];

        $sql="SELECT * FROM dbo.Applicant WHERE applicant='$applicant'";
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
        
        while($row=sqlsrv_fetch_array($quer)){
            echo '<ul>';
            echo '<li>'.'申請單位：'.$row['applicant'].'</li>';
            echo '<li>'.'申請聯絡人：'.$row['contact'].'</li>';
            echo '<li>'.'申請主管：'.$row['aplySupv'].'</li>';
            echo '<li>'.'地址：'.$row['address'].'</li>';
            echo '<li>'.'電話：'.$row['phone'].'</li>';
            echo '<li>'.'e-mail：'.$row['email'].'</li>';
        }

        $sql="SELECT * FROM dbo.Ordering WHERE applicant='$applicant' AND aplyDate='$applyDate'";
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
        
        while($row=sqlsrv_fetch_array($quer)){
            $O_Id=$row['O_Id'];

            echo '<li>'.'申請日期：'.$row['aplyDate'].'</li>';
            echo '<li>'.'申請場地：'.$row['facility'].'</li>';
            echo '<li>'.'申請項目：'.$row['aplyfor'].'</li>';
            echo '<li>'.'參與人數：'.$row['participant'].'</li>';
            echo '<li>'.'錄音錄影：'.YN($row['record']).'</li>';
            echo '<li>'.'拆台時間：'.$row['stageTear'].'</li>';
            echo '<li>'.'活動內容：'.$row['actContent'].'</li>';
            echo '<li>'.'附件：'.$row['attachment'].'</li>';
            echo '<li>'.'發票抬頭：'.$row['receipt'].'</li>';
            echo '<li>'.'統一編號：'.$row['taxId'].'</li>';
            echo '<li>'.'退款銀行：'.$row['returnBank'].'</li>';
            echo '<li>'.'分行名稱：'.$row['returnBranch'].'</li>';
            echo '<li>'.'退款帳號：'.$row['returnAcc'].'</li>';
            echo '<li>'.'戶名：'.$row['accName'].'</li>';
            echo '</ul>';
        }  

        $sql="SELECT * FROM dbo.Rentaltime WHERE O_Id='$O_Id'";
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
        
        while($row=sqlsrv_fetch_array($quer)){
            echo '</br>';
            echo '<li>'.'租借日期：'.$row['rentDate'].'</li>';
            echo '<li>'.'裝台排練/演出：'.toText($row['rehearsalShow']).'</li>';
            echo '<li>'.'租借時間：'.$row['rentTime'].'</li>';
            echo '</br>';
        }  
    }
}
sqlsrv_free_stmt($quer);  
sqlsrv_close($conn);
?> 
</div>
<footer id="footer">
    <p>112 台北市北投區學園路一號 國立台北藝術大學 展演藝術中心</p>
    <p>Tel:(02)2893-8163</p>
</footer>
</body></html>
