<?php
function login($uid, $pwd){
    return array( "Database"=>"FinalProject", "UID"=>$uid, "PWD"=>$pwd, "CharacterSet" => "UTF-8");
}

$serverName = "DESKTOP-PGTDFJ7";
$connectionInfo = login("andywang", "andy0212");
$conn=sqlsrv_connect($serverName,$connectionInfo);
?>