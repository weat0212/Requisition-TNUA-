<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html>
<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>國立臺北藝術大學 展演藝術中心-修改狀態</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
        <h1><a href="QueryPage.html">場地租用修改狀態</a></h1>
  </div>


<div id="contents">
<?php

if(!isset($_POST['phone'])||!isset($_POST['contact'])||!isset($_POST['aplySupv'])||!isset($_POST['address'])){
    echo "<h2>基本資料變數錯誤</h2>";
    exit();
}
elseif(!isset($_POST['participant'])||!isset($_POST['record'])||!isset($_POST['receipt'])||!isset($_POST['taxId'])
||!isset($_POST['returnBank'])||!isset($_POST['returnBranch'])||!isset($_POST['returnAcc'])||!isset($_POST['accName'])){
    if(!isset($_POST['participant'])){echo 'participant';}
    elseif(!isset($_POST['record'])){echo 'record';}
    elseif(!isset($_POST['receipt'])){echo 'receipt';}
    elseif(!isset($_POST['taxId'])){echo 'taxId';}
    elseif(!isset($_POST['returnBank'])){echo 'bankname';}
    elseif(!isset($_POST['returnBranch'])){echo 'bankbranch';}
    elseif(!isset($_POST['returnAcc'])){echo 'returnAcc';}
    elseif(!isset($_POST['accName'])){echo 'accName';}
    echo "<h2>預約表單資料變數錯誤</h2>";exit();
}
else{
    if(empty($_POST['phone'])||empty($_POST['contact'])||empty($_POST['aplySupv'])||empty($_POST['address'])
    ||empty($_POST['record'])||empty($_POST['receipt'])||empty($_POST['taxId'])||empty($_POST['returnBank'])
    ||empty($_POST['returnBranch'])||empty($_POST['returnAcc'])||empty($_POST['accName'])){
        echo "<h2>資料輸入不完整</h2>";
        exit();
    }
    else{
        include("connection.php");
        
        $aplyDate=(string)$_POST['aplyDate'];
        $applicant=(string)$_POST['applicant'];
        $address=(string)$_POST['address'];
        $aplySupv=(string)$_POST['aplySupv'];
        $contact=(string)$_POST['contact'];
        $phone=(string)$_POST['phone'];
        $email=(string)$_POST['email']; //
        $facility=(string)$_POST['facility'];
        $participant=(string)$_POST['participant']; //
        $aplyfor=(string)$_POST['aplyfor'];
        $record=(string)$_POST['record'];
        $stageTear=(string)$_POST['stageTear'];
        $actContent=(string)$_POST['actContent'];
        $attachment=(string)$_POST['attachment'];
        $taxId=(string)$_POST['taxId'];
        $receipt=(string)$_POST['receipt'];
        $returnBank=(string)$_POST['returnBank'];//
        $returnBranch=(string)$_POST['returnBranch'];//
        $returnAcc=(string)$_POST['returnAcc'];
        $accName=(string)$_POST['accName'];

        $sql="UPDATE dbo.Applicant SET aplySupv='$aplySupv', contact='$contact', address='$address', email='$email' WHERE applicant='$applicant'";
        //var_dump($sql);
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());

        $sql="UPDATE dbo.Ordering SET record='$record',receipt='$receipt',taxId='$taxId',returnBank='$returnBank',returnBranch='$returnBranch',returnAcc='$returnAcc',accName='$accName' WHERE applicant='$applicant' AND aplyDate='$aplyDate'";
        //var_dump($sql);
        $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
        
        echo "成功更改資料! 請重新查詢資料</br></br>";
        echo "<h2><a href='QueryPage.html'>點我到查詢頁面</a></h2>";
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
