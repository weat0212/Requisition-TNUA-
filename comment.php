<?php
	$serverName = "DESKTOP-PGTDFJ7";
	$connectionInfo = array( "Database"=>"TEST", "UID"=>"andywang", "PWD"=>"andy0212", "CharacterSet" => "UTF-8");
	$conn=sqlsrv_connect($serverName,$connectionInfo);

	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$mail=$_POST['mail'];
	$comment=$_POST['comment'];

	$sql="INSERT INTO dbo.comment(name,phone,mail,comment) VALUES('$name','$phone','$mail','$comment')";
	$quer=sqlsrv_query($conn, $sql) or die("sql error".sqlsrv_errors());
?>


<?php
	header("Content-Type:text/html; charset=utf-8");
?>

<html>
<?php
	header("Content-Type:text/html; charset=utf-8");
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>國立臺北藝術大學 展演藝術中心-場地租用申請表</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body id="wrapper-02">
	<div id="header">
		<h1>表單上傳狀況</h1>
	</div>
    
<div id="contents">
<?php   
	if(!isset($_POST['applicant'])||!isset($_POST['phone'])||!isset($_POST['mail'])||!isset($_POST['comment'])){
		
		if(!isset($_POST['applicant'])){
		echo "申請單位變數錯誤，請依照變數名稱命名(applicant)<br/>";
		}else{echo"";}

		if(!isset($_POST['phone'])){
		echo "電話變數錯誤，請依照變數名稱命名(phone)<br/>";
		}else{echo"";}

		if(!isset($_POST['mail'])){
		echo "信箱變數錯誤，請依照變數名稱命名(mail)<br/>";
		}else{echo"";}
		
		if(!isset($_POST['comment'])){
		echo "留言變數錯誤，請依照上數名稱命名(comment)<br/>";
		}else{echo"";}
	}else{

		if(empty($_POST['applicant'])||empty($_POST['phone'])||empty($_POST['mail'])||empty($_POST['comment'])){
			echo "你有資料未輸入";
			exit();
		}else{

			if(isset($_POST['applicant'])){
				echo '<h2>'.$_POST['applicant'].'您好!您已傳送一則訊息給客服，我們將會盡快幫你服務<br/></h2>';
				echo '<br/>';
			}
	
		else{
			echo "姓名變數錯誤，請依照變數名稱命名(applicant)";
		}
	
?>
 
       	<div class="detail_box clearfix">
			<p class="photo">
                <img src="thanku.png" width="250" height="200" alt="謝謝你">
            </p>
            <p class="text">
			<?php
				if(isset($_POST['phone'])){
					echo '<font size=3>以下是您輸入的資料:<br/><br/>';
					echo '電話:';
					echo '<font color=#66B3FF>'.$_POST['phone'].'</font>';
					echo '<br/>';
				}
				else{
					echo "電話變數錯誤，請依照上課變數名稱命名(phone)</br>";
				}
				
				if(isset($_POST['mail'])){
					echo 'e-mail:';
					echo '<font color=#66B3FF>'.$_POST['mail'].'</font>';
					echo '<br/>';
				}
				else{
					echo "信箱變數錯誤，請依照上課變數名稱命名(mail)</br>";
				}
				
				if(isset($_POST['comment'])){
					echo '你的留言內容:';
					echo '</br>';
					echo '<font color=#66B3FF>'.$_POST['comment'].'</font>';
				}
				else{
					echo "留言變數錯誤，請依照上課變數名稱命名(comment)";
				}
		}
	}
			?>
			</p>
       	</div>
</div>
</body></html>


