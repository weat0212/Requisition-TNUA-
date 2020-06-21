<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html>
<?php
    header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>場地租用申請表狀態</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
  <div id="header">
        <h1>申請單上傳狀態</h1>
  </div>

<div id="contents">
<?php
// 申請人表格少輸入情況
if(!isset($_POST['applyDate'])||!isset($_POST['applicant'])||!isset($_POST['contact'])||!isset($_POST['DeptSupv'])||
!isset($_POST['address'])||!isset($_POST['phone'])||!isset($_POST['mail'])){

    if(!isset($_POST['applyDate'])){
    echo "申請日期輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['applicant'])){
    echo "申請單位輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['contact'])){
    echo "申請聯絡人輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['DeptSupv'])){
    echo "申請單位主管輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['address'])){
    echo "地址輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['phone'])){
    echo "電話輸入錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['mail'])){
    echo "信箱輸入錯誤<br/>";
    }else{echo"";}
}
// ToDo:應先檢查所有資料已輸入
// 申請人表格有輸入之情形
else{
    if(empty($_POST['applyDate'])||empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['DeptSupv'])||
    empty($_POST['address'])||empty($_POST['phone'])||empty($_POST['mail'])){
        echo "資料未輸入尚未齊全，請重新登錄資料!";
        exit();
    }
    //完成表單之宣告
    else{
        if(isset($_POST['contact'])){
            echo '<h2>'.$_POST['contact'].'，您已成功上傳申請表單!<br/></h2>';
            echo '<br/>';
        }else{
            echo "申請聯絡人輸入錯誤";
        }
    }
?>


<?php

// 此部分為時段表的部分
function chk_A($dat){
    // 查看時間點
    $time = array();
    for($i=1;$i<9;$i++){
        $tmp = $_POST['dat'.(string)$dat.'t'.(string)$i];
        if($tmp=='A'||$tmp=='a'){
            $time[$i] = timemapping($i);
        }else{
            echo"";
        }
    }
    return $time;
}

function chk_B($dat){
    // 查看時間點
    $time = array();
    for($i=1;$i<9;$i++){
        $tmp = $_POST['dat'.(string)$dat.'t'.(string)$i];
        if($tmp=='B'||$tmp=='b'){
            $time[$i] = timemapping($i);
        }else{
            echo"";
        }
    }
    return $time;
}

function timemapping($i){
    // 對照時間表
    switch($i){
        case 1:
            return '08:00~09:00';
            break;
        case 2:
            return '09:00~12:00';
            break;
        case 3:
            return '12:00~13:00';
            break;
        case 4:
            return '13:00~17:00';
            break;
        case 5:
            return '17:00~18:00';
            break;
        case 6:
            return '18:00~22:00';
            break;
        case 7:
            return '22:00~24:00';
            break;
        case 8:
            return '00:00~02:00';
            break;
    }
}

function chk_rep_time(){
    // SQL查詢是否有重複值
}

global $d1A;
global $d2A;
global $d3A;
global $d1B;
global $d2B;
global $d3B;
if(!isset($_POST['dat1']) and !isset($_POST['dat2']) and !isset($_POST['dat3'])){
    echo "未輸入（3）租用裝台排練時段(請填A)、租用演出時段(請填B)";
}else{
    // 每一個收到的日期皆輸入至array中
    // BUG:Array can't show in page
    // Move to table down here
    for($i=1;$i<4;$i++){
        if($_POST['dat'.(string)$i]){
            if($i==1){
                $d1A = chk_A($i);
                $d1B = chk_B($i);
                echo "您預約排練的時段是：".$d1A."，演出時段是：".$d1B;
            }
            if($i==2){
                $d2A = chk_A($i);
                $d2B = chk_B($i);
                echo "您預約排練的時段是：".$d2A."，演出時段是：".$d2B;
            }
            if($i==3){
                $d3A = chk_A($i);
                $d3B = chk_B($i);
                echo "您預約排練的時段是：".$d2A."，演出時段是：".$d2B;
            }
        }
    }
}

// 下一步：SQL存取
?>


<!-- ToDo:檢查正則式 -->

        <!-- 表格輸入皆正確的情況 -->
    <div class="detail_box clearfix">
        <p class="photo">
            <img src="images/thanKU.webp" width="250" height="200" alt="謝謝你">
        </p>
        <p class="text">
        <?php
        
        if(isset($_POST['contact'])){
            echo '<font size=4>以下是您的基本資料，請確認是否有錯誤：</font><br/><br/><br/>';
            echo '<li>申請聯絡人：';
            echo '<font color=#66B3FF>'.$_POST['contact'].'</font></li>';
            echo '<br/>';
        }
        else{
            echo "申請聯絡人資料錯誤</br>";
        }

        if(isset($_POST['applyDate'])){
            echo '<li>申請日期：';
            echo '<font color=#66B3FF>'.$_POST['applyDate'].'</font></li>';
            echo '</br>';
        }
        else{
            echo "電話號碼錯誤";
        }
        if(isset($_POST['mail'])){
            echo '<li>e-mail：';
            echo '<font color=#66B3FF>'.$_POST['mail'].'</font></li>';
            echo '<br/>';
        }
        else{
            echo "信箱變數錯誤</br>";
        }

        if(isset($_POST['phone'])){
            echo '<li>電話：';
            echo '<font color=#66B3FF>'.$_POST['phone'].'</font></li>';
            echo '</br>';
        }
        else{
            echo "電話號碼錯誤";
        }
    }
        ?>
    </p>
    </div>
</div>

<!-- 連線認證以及SQL INSERT -->
<?php
	$serverName = "DESKTOP-PGTDFJ7";
	$connectionInfo = array( "Database"=>"FinalProject", "UID"=>"andywang", "PWD"=>"andy0212", "CharacterSet" => "UTF-8");
	$conn=sqlsrv_connect($serverName,$connectionInfo);
    $applyDate=$_POST['applyDate'];
	$name=$_POST['contact'];
    $phone=$_POST['phone'];
	$mail=$_POST['mail'];
	$sql="INSERT INTO dbo.comment(applyDate,name,phone,email) VALUES('$applyDate','$name','$phone','$mail')";
	$quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
?>
</body></html>
