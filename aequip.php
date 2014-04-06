<?php
include "conf.php";
// 在数据库查询装备,
// 有则显示更新,
// 没有新增
$eid=$_POST["eid"];
$key=$_POST["key"];
$equip_name=$_POST["equip_name"];
$query = "SELECT * FROM `equip` WHERE `equip`.`idequip`='" . $eid . "';";

$link = mysql_connect($mysql_host, $mysql_user,  $mysql_pwd) or die("Could not connect:[".$query."],err=".mysql_error());
mysql_select_db($mysql_db) or die("Could not select database,err=".mysql_error());
$result = mysql_query($query) or die("Query failed:[".$query."],err=".mysql_error());

//查找有没有这个装备
$r = mysql_fetch_assoc($result);
//空,没有
if (empty($r)){
	$query ="INSERT INTO `wtb`.`equip` (`idequip`, `ekey`, `equip_name`) VALUES ('".$eid."', '".$key."', '".$equip_name."');";
}else{
//找到了,更新它
	$query ="UPDATE `wtb`.`equip` SET `equip_name`='".$equip_name."' WHERE `idequip`='".$eid."';";
}
$result = mysql_query($query) or die("Query failed:[".$query."],err=".mysql_error());
$json=new stdClass();
$json->equip_name=$equip_name;
//$json->link=$equiplink;
$json->eid=$eid;
$json->key=$key;
$json->isInsert=empty($r);
//$json->result=$result;
$json->sql=$query;

echo json_encode($json);
//mysql_free_result($result);
mysql_close($link);
?>
