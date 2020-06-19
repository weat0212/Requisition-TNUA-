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
        //表格輸入錯誤情況
        if(!isset($_POST['applyDate'])||!isset($_POST['applicant'])||!isset($_POST['contact'])||!isset($_POST['DeptSupv'])){

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
            
		}
        //ToDo:應先檢查所有資料已輸入
		else{
            if(empty($_POST['applyDate'])||empty($_POST['applicant'])||empty($_POST['contact'])||empty($_POST['DeptSupv'])){
                echo "資料未輸入尚未齊全，請重新登錄資料!";
                exit();
		    }
		    else{
                if(isset($_POST['contact'])){
                    echo '<h2>'.$_POST['contact'].'，您已成功上傳申請表單!<br/></h2>';
                    echo '<br/>';
                }else{
                    echo "申請聯絡人輸入錯誤";
            }
?>

<!-- ToDo:排演日及演出日AB僅能出現一次 -->
<?php
    // 檢查是否重複輸入
    function chk_timetable($dat){
        $A = 0;
        $B = 0;
        if(isset($_POST[$dat])){
            //check if A/B only input once
            for($i=1 ; $i<9 ; $i++) {
                if($_POST[$dat.'assist'.(string)$i] == 'A' || $_POST[$dat.'assist'.(string)$i] == 'a'){
                    $A += 1;
                }
                if($_POST[$dat.'assist'.(string)$i] == 'B' || $_POST[$dat.'assist'.(string)$i] == 'b'){
                    $B += 1;
                }
            }
            
            if($A==1 and $B==1){
                // ToDo:顯示預約時段
                echo"您的租用裝台排練時段:"."租用演出時段:</br>";
            }else{
                //缺值
                echo"<font size=3 color=red>租借表單填寫缺值或多輸入值</br>";
            }
        }else{
            if($dat=='dat1'){
                echo"<font size=3 color=red>必須至少輸入一筆租用裝台排練時段、租用演出時段</br>";
            }
        }
    }

    for($i=0;$i<3;$i++){
        chk_timetable('dat'.(string)$i);
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
