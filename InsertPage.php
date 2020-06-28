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
// 檢查所有的表格 flag
global $flag;
$flag = true;

// Function
// 此部分為時段表的部分
function chk_A($dat){
    // 查看時間點
    $time = array();
    for($i=1;$i<9;$i++){
        $tmp = $_POST['dat'.(string)$dat.'t'.(string)$i];
        if($tmp=='A'||$tmp=='a'){
            $time[(string)$i] = timemapping($i);
            //此處利用str index
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
            $time[(string)$i] = timemapping($i);
        }else{
            echo"";
        }
    }
    return $time;
}

function timemapping($i){
    // 對照時間表
    switch($i){
        case '1':
            return '08:00~09:00';
            break;
        case '2':
            return '09:00~12:00';
            break;
        case '3':
            return '12:00~13:00';
            break;
        case '4':
            return '13:00~17:00';
            break;
        case '5':
            return '17:00~18:00';
            break;
        case '6':
            return '18:00~22:00';
            break;
        case '7':
            return '22:00~24:00';
            break;
        case '8':
            return '00:00~02:00';
            break;
    }
}

function time_compar($dat1, $dat2){
    if($dat1<$dat2){return true;}else{return false;}
}

function chk_rep_time(){
    // ToDo:SQL查詢是否有重複值
    // 未完成
}

function chk_priori($A, $B){
    static $count = false;
    // ToDo:檢查A早於B
    // 未完成
}

// #### Main ####
// 時段表部分
global $d1A;
global $d2A;
global $d3A;
global $d1B;
global $d2B;
global $d3B;
if(empty($_POST['dat1']) and empty($_POST['dat2']) and empty($_POST['dat3'])){
    echo "未輸入（3）租用裝台排練時段(請填A)、租用演出時段(請填B)";
    $flag=false;
}else{
    // 每一個收到的日期皆輸入至array中
    for($i=1;$i<4;$i++){
        if(!empty($_POST['dat'.(string)$i])){
            if($i==1){
                $d1A = chk_A($i);
                $d1B = chk_B($i);
                echo $_POST['dat'.(string)$i]."，您預約的排練時段：";
                foreach($d1A as $val){
                    echo $val.' ';
                }
                echo ' / '."演出時段：";
                foreach($d1B as $val){
                    echo $val.' ';
                }
                echo '</br>';
            }
            if($i==2){
                $d2A = chk_A($i);
                $d2B = chk_B($i);
                echo $_POST['dat'.(string)$i]."，您預約的排練時段：";
                foreach($d2A as $val){
                    echo $val.' ';
                }
                echo ' / '."演出時段：";
                foreach($d2B as $val){
                    echo $val.' ';
                }
                echo '</br>';
            }
            if($i==3){
                $d3A = chk_A($i);
                $d3B = chk_B($i);
                echo $_POST['dat'.(string)$i]."，您預約的排練時段：";
                foreach($d3A as $val){
                    echo $val.' ';
                }
                echo '</br>'."演出時段：";
                foreach($d3B as $val){
                    echo $val.' ';
                }
                echo '</br>';
            }
        }
    }
}


// 檢查變數存在
if(!isset($_POST['applyDate'])||!isset($_POST['applicant'])||!isset($_POST['contact'])||!isset($_POST['DeptSupv'])||
!isset($_POST['address'])||!isset($_POST['phone'])||!isset($_POST['mail'])){

    if(!isset($_POST['applyDate'])){
    echo "申請日期變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['applicant'])){
    echo "申請單位變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['contact'])){
    echo "申請聯絡人變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['DeptSupv'])){
    echo "申請單位主管變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['address'])){
    echo "地址變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['phone'])){
    echo "電話變數錯誤<br/>";
    }else{echo"";}
    if(!isset($_POST['mail'])){
    echo "信箱變數錯誤<br/>";
    }else{echo"";}
}

// 申請人表格有無輸入之情形
else{
    if(empty($_POST['applyDate'])||empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['DeptSupv'])||
    empty($_POST['address'])||empty($_POST['phone'])||empty($_POST['mail'])){
        echo "<h2>基本資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }
    if(empty($_POST['facility'])||empty($_POST['participant'])||empty($_POST['aplyfor'])){
        echo "<h2>申請場地資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }

    // 拆台時間次序檢查
    if(!empty($_POST['clstmeStart'] and !empty($_POST['clstmeEnd']))){
        if(!time_compar($_POST['clstmeStart'], $_POST['clstmeEnd'])){
            echo"（5）拆台時間順序錯誤!";
            $flag=false;
        }
    }else{$flag=false;}

    // // 附件資料判定
    // $attIsEmp=true;
    // for($i=1;$i<=6;$i++){
    //     if(!empty($_POST['a'.(string)$i])){
    //         $attIsEmp=false;
    //     }
    // }
    
    if(empty($_POST['record'])||empty($_POST['clstmeStart'])||empty($_POST['clstmeEnd'])||empty($_POST['actContent'])){
        echo "<h2>申請內容資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }

    if(empty($_POST['receipt'])||empty($_POST['taxId'])||empty($_POST['bankname'])||empty($_POST['bankbranch'])||empty($_POST['returnAcc'])||empty($_POST['accName'])){
        echo "<h2>發票/退款資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }
    
    // 完成表單之宣告
    if($flag == true){
        if(isset($_POST['contact'])){
            echo '<h2>'.$_POST['contact'].'，您已成功上傳申請表單!<br/></h2>';
            echo '<br/>';
        }else{
            echo "<h2>申請聯絡人輸入錯誤</h2>";
        }
    }else{
        echo "<h2>申請失敗!!!</h2>";
        exit();
    }

    // ToDo:Download Files
    // if($_FILES){
        
    // }

?>


<!-- ToDo:檢查正則式 -->

        <!-- 表格輸入皆正確的情況 -->
        <!-- 顯示輸入成功使用者基本資料 -->
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
    <input type='button' value="回首頁" onclick="location.href='HomePage.html'">
</div>


<!-- 下一步：SQL存取 -->
<!-- 連線認證以及SQL INSERT -->
<?php
//Stop Constraint
// $constraintSrt='USE FinalProject 
// GO 
// EXEC sp_MSforeachtable @command1="ALTER TABLE ? NOCHECK CONSTRAINT ALL" 
// GO';
// $constraintEnd='USE FinalProject
// GO 
// EXEC sp_MSforeachtable @command1="ALTER TABLE ? WITH NOCHECK CHECK CONSTRAINT ALL" 
// GO';
// $quer=sqlsrv_query($conn, $constraintSrt) or die("sql error".sqlsrv_errors());


$serverName = "DESKTOP-PGTDFJ7";
$connectionInfo = array( "Database"=>"FinalProject", "UID"=>"andywang", "PWD"=>"andy0212", "CharacterSet" => "UTF-8");
$conn=sqlsrv_connect($serverName,$connectionInfo);
    
// --------------------
// 申請單位資料 Applicant
// --------------------
$applicant=$_POST['applicant'];
$contact=$_POST['contact'];
$aplySupv=$_POST['DeptSupv'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$email=$_POST['mail'];
$sql="INSERT INTO dbo.Applicant(applicant,contact,aplySupv,address,phone,email) VALUES('$applicant','$contact','$aplySupv','$address','$phone','$email')";
$quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
// OK

// -------------------
// 預約資訊 Ordering
//--------------------
$aplyDate=(string)$_POST['applyDate'];
$facility=(string)$_POST['facility'];
$aplyfor=(string)$_POST['aplyfor'];
$participant=(string)$_POST['participant'];
$record=(string)$_POST['record'];
$stageTear=(string)$_POST['clstmeStart'].'-'.(string)$_POST['clstmeEnd'];
// $stageTear=(string)$_POST['clstmeStart'];
$actContent=(string)$_POST['actContent'];
$attachment=(string)$_POST['checkbox'];
$receipt=(string)$_POST['receipt'];
$taxId=(string)$_POST['taxId'];
$returnBank=(string)$_POST['bankname'];
$returnBranch=(string)$_POST['bankbranch'];
$returnAcc=(string)$_POST['returnAcc'];
$accName=(string)$_POST['accName'];

// $sql="INSERT INTO dbo.Ordering(aplyDate,applicant,facility,aplyfor,participant,record,stageTear,actContent,attachment,receipt,taxId) VALUES('aplyDate','appl','facility','aplyfor','participant','record','stageTear','actContent','attachment','receipt','taxId')";
$sql="INSERT INTO dbo.Ordering(aplyDate,applicant,facility,aplyfor,participant,record,stageTear,actContent,attachment,receipt,taxId,returnBank,returnBranch,returnAcc,accName) 
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);SELECT IDENT_CURRENT('dbo.Ordering')";
$params=array($aplyDate,$applicant,$facility,$aplyfor,$participant,$record,$stageTear,$actContent,$attachment,$receipt,$taxId,$returnBank,$returnBranch,$returnAcc,$accName);
$quer=sqlsrv_query($conn, $sql,$params) or die("sql error".sqlsrv_errors());
// OK
// --------------------
// 租用時段 Rentaltime
// --------------------
// 日期變數:dat1  時段Array:D1A/B
// ERROR:$quer
// function schedule_insert($rentDate, $rehearsalShow, $rentTime){
    //     $sql="INSERT INTO dbo.Rentaltime(rentDate,rehearsalShow,rentTime) VALUES('$rentDate','$rehearsalShow','$rentTime')";
    //     $quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
    // }
    
function lastId($queryID) {
    sqlsrv_next_result($queryID);
    sqlsrv_fetch($queryID);
    return sqlsrv_get_field($queryID, 0);
} 

$lastID=(string)lastId($quer);
echo $lastID;
    

for($i=1;$i<=3;$i++){
    $d='dat'.(string)$i;
    if(!empty($_POST[$d])){
        $rentTimeA=$GLOBALS['d'.(string)$i.'A'];
        $rentTimeB=$GLOBALS['d'.(string)$i.'B'];
        $tmp=(string)$_POST[$d];

        foreach($rentTimeA as $val){
            $val=(string)$val;
            $sql="INSERT INTO dbo.Rentaltime(rentDate,rehearsalShow,rentTime,O_Id) VALUES(?,?,?,?);";
            $params=array($tmp,'Rehearsal',$val,$lastID);
            $quer=sqlsrv_query($conn, $sql,$params) or die("sql error".sqlsrv_errors());
        }
        foreach($rentTimeB as $val){
            $val=(string)$val;
            $sql="INSERT INTO dbo.Rentaltime(rentDate,rehearsalShow,rentTime,O_Id) VALUES(?,?,?,?);";
            $params=array($tmp,'Show',$val,$lastID);
            $quer=sqlsrv_query($conn, $sql,$params) or die("sql error".sqlsrv_errors());
        }
    }
}


// --------------------
// 保證金退款 Margin
// --------------------
// $returnBank=(string)$_POST['bankname'];
// $returnBranch=(string)$_POST['bankbranch'];
// $returnAcc=(string)$_POST['returnAcc'];
// $accName=(string)$_POST['accName'];
// $sql="INSERT INTO dbo.Margin(returnBank,returnBranch,returnAcc,accName) VALUES(?,?,?,?); SELECT IDENT_CURRENT('Ordering')";
// $params=array($returnBank,$returnBranch,$returnAcc,$accName);
// // $sql="INSERT INTO dbo.Margin(returnBank,returnBranch,returnAcc,accName) VALUES('$returnBank','$returnBranch','$returnAcc','$accName'))";
// // var_dump($sql);
// $quer=sqlsrv_query($conn, $sql, $params) or die("sql error".sqlsrv_errors());
// echo lastId($quer);

/* Free connection resources. */  
sqlsrv_free_stmt( $quer);   
sqlsrv_close($conn);  

?> 

</body></html>
