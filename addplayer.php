<?php
$name = $_POST["name"];
$id = $_POST["id"];
$query = "INSERT INTO `wtb`.`play` (`idplay`, `play_name`) VALUES ('".id."', '".name."');";
//echo "var jstext='$query'"; //输出一句JS语句,生成一个JS变量,并赋颠值为PHP变量 $query 的值
//echo "var jstext='aa'";
echo "var jstext=" . "'$query'";
$link = mysql_connect("localhost", "root", "123456") or die("Could not connect");
mysql_select_db("wtb") or die("Could not select database");
$result = mysql_query($query) or die("Query failed");
echo "var reset=" . $result;
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
