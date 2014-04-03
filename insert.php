<?php
include "conf.php";

$query = "INSERT 
INTO
   `wtb`.`wtb` (
      `enable`,`iditem`, `idplayer`, `num_now`,`num_want`, `c`, `hath`,`src`
   ) 
VALUES
   ('1', '11399', '', '1','1', '','','http://forums.e-hentai.org/');";
$query = $_POST["query"];
//echo "var jstext='$query'"; //输出一句JS语句,生成一个JS变量,并赋颠值为PHP变量 $query 的值
//echo "var jstext='aa'";
//echo "var jstext=" . "'$query'";
$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database");
$result = mysql_query($query) or die("Query failed");
//echo "var reset=" . $result;
echo $result;
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
