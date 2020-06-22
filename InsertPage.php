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
            $time[(string)$i] = timemapping($i);// IMPORTANT! index error
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
            $time[(string)$i] = timemapping($i);// IMPORTANT! index error
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

function time_compar($dat1, $dat2){
    if($dat1<$dat2){return true;}else{return false;}
}

function chk_rep_time(){
    // ToDo:SQL查詢是否有重複值
    // 有空再說
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

// 申請人表格有輸入之情形
else{
    if(empty($_POST['applyDate'])||empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['DeptSupv'])||
    empty($_POST['address'])||empty($_POST['phone'])||empty($_POST['mail'])){
        echo "<h3>基本資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }
    if(empty($_POST['aplyLoc'])||empty($_POST['numofParts'])||empty($_POST['aplyfor'])){
        echo "<h2>申請場地資料未輸入尚未齊全，請重新登錄資料!</h2></br>";
        $flag=false;
    }

    // 拆台時間次序檢查
    if(!time_compar($_POST['clstmeStart'], $_POST['clstmeEnd'])){
        echo"（5）拆台時間順序錯誤!";
        $flag=false;
    }

    // 附件資料判定
    $attIsEmp=true;
    for($i=1;$i<=6;$i++){
        if(!empty($_POST['a'.(string)$i])){
            $attIsEmp=false;
        }
    }
    
    if(empty($_POST['arrange'])||empty($_POST['clstmeStart'])||empty($_POST['clstmeEnd'])||empty($_POST['actComment'])||$attIsEmp==true){
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


<!-- 下一步：SQL存取 -->
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
