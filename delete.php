<?php
include "conf.php";
$wtbid = $_POST["wtbid"];
$query="DELETE FROM `wtb`.`order` WHERE `idwtb`='".$wtbid."';";
//echo "var jstext='$query'";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host,$mysql_user, $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database");
$result = mysql_query($query) or die("Query failed".$query);
//echo "query=".$query ." ; reset=" . $result;
echo $result;
// 断开连接
mysql_close($link);
?>
