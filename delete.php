<?php
$wtbid = $_POST["wtbid"];
$query="DELETE FROM `wtb`.`wtb` WHERE `idwtb`='".$wtbid."';";
//echo "var jstext='$query'";
//echo "var jstext=" . "'$query'";
$link = mysql_connect("127.0.0.1", "root", "123456") or die("Could not connect");
mysql_select_db("wtb") or die("Could not select database");
$result = mysql_query($query) or die("Query failed");
//echo "query=".$query ." ; reset=" . $result;
echo $result;
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
