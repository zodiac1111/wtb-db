<?php
include "conf.php";
$name = $_POST["name"];
$id = $_POST["id"];
$query = "INSERT INTO `wtb`.`play` (`idplay`, `play_name`) VALUES ('".$id."', '".$name."');";
//echo "var jstext='$query'"; //输出一句JS语句,生成一个JS变量,并赋颠值为PHP变量 $query 的值
//echo "var jstext='aa'";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database");
$result = mysql_query($query) or die("Query failed");
//echo "var reset=" . $result;
// 断开连接
mysql_close($link);
?>
