<?php
include "conf.php";
// 在数据库查询装备,
// 有则显示,
// 没有则从网页抓取添加到数据库,再显示
$eid=$_POST["eid"];
$key=$_POST["key"];
$query = "SELECT * FROM `equip` WHERE `equip`.`idequip`='" . $eid . "';";

$link = mysql_connect($mysql_host, $mysql_user,  $mysql_pwd) or die("Could not connect:[".$query."],err=".mysql_error());
mysql_select_db($mysql_db) or die("Could not select database,err=".mysql_error());
$result = mysql_query($query) or die("Query failed:[".$query."],err=".mysql_error());

//查找有没有这个装备
$r = mysql_fetch_assoc($result);
$json=new stdClass();
//空,没有
if (empty($r)){
	$json->equip_name="";
}else{
//找到了
	$json->equip_name=$r["equip_name"];
}


//$json->link=$equiplink;
$json->eid=$eid;
$json->key=$key;
$json->adata=$r;
//$json->result=$result;
$json->sql=$query;

echo json_encode($json);
//mysql_free_result($result);
//mysql_close($link);
?>
