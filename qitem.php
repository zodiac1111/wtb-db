<?php
include "conf.php";


$query = "SELECT * FROM item ;";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host, $mysql_user,  $mysql_pwd) or die("Could not connect");
mysql_select_db("wtb") or die("Could not select database");
$result = mysql_query($query) or die("Query failed");
//echo "var reset=" . $result;
$rows = array();

while ($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}

echo json_encode($rows);
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
