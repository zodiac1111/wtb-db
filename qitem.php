<?php
include "conf.php";

parse_str($_SERVER['QUERY_STRING']);
$query = "SELECT * FROM item WHERE item.item_name LIKE  \"%" . $term . "%\" ;";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host, $mysql_user,  $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database");
$result = mysql_query($query) or die("Query failed".$query);
//echo "var reset=" . $result;
$rows = array();

while ($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}

$json->adata=$rows;
$json->q=$_SERVER['QUERY_STRING'];

echo json_encode($json);
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
