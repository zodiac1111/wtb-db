<?php
include "conf.php";
// 在数据库查询装备,
// 有则显示,
// 没有则从网页抓取添加到数据库,再显示
$eid=$_POST["eid"];
$key=$_POST["key"];
$query = "SELECT * FROM `equip` WHERE `equip`.`idequip`='" . $eid . "';";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host, $mysql_user,  $mysql_pwd) or die("Could not connect:".$link);
mysql_select_db($mysql_db) or die("Could not select database");
$result = mysql_query($query) or die("Query failed".$query);
//echo "var reset=" . $result;
$rows = array();
//查找有没有这个装备
$r = mysql_fetch_assoc($result)
//空,没有
if (empty($r)){
	$json->equip_name="没找到...";
}else{
//找到了
	$json->equip_name=$rows["equip_name"];
}
$json->link=$equiplink;
$json->eid=$eid;
$json->key=$key;
$json->adata=$rows;
$json->sql=$query;

echo json_encode($json);
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
