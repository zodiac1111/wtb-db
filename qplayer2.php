<?php
include "conf.php";

/// @note 查找字符串,根据玩家名称提供自动补全功能
parse_str($_SERVER['QUERY_STRING']);
/// term 为前端传入的玩家名字
$query = "SELECT * FROM play WHERE play.play_name LIKE  \"%" . $term . "%\" ;";

$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect");
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