<?php
//PHP手册中的PHP连接Mysql的实例
// 连接选择数据库
$link = mysql_connect("localhost", "root", "123456") or die("Could not connect");

mysql_select_db("wtb") or die("Could not select database");
// 执行 SQL 查询

$query = "select 
    wtb.item.item_name,
    wtb.play.play_name,
    wtb.play.idplay,
    wtb.c,
    wtb.hath,
    wtb.num_want,
    wtb.src
from
    wtb.item,
    wtb.play,
    wtb.wtb
where
    wtb.wtb.iditem = wtb.item.iditem
        and wtb.wtb.idplayer = wtb.play.idplay
LIMIT 5;
";
parse_str($_SERVER['QUERY_STRING']);
echo $_SERVER['QUERY_STRING'];
echo $name;
$result = mysql_query($query) or die("Query failed");
// json api start
$rows = array();

while ($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}
/*
 while($r = mysqli_fetch_array($result)) {
 $rows[] = $r;
 }
 */
// show json
echo "{\"aaData\":";
echo json_encode($rows);
echo "}";

// json api end
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>