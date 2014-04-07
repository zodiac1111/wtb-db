<?php
// 更新订单库中某一条记录,只更新几个可选的字段.
include "conf.php";
$orderid = $_POST["orderid"];
$qty = $_POST["qty"];
$c = $_POST["c"];
$hath = $_POST["hath"];
$note = $_POST["note"];
//$src = $_POST["src"];

$timestamp=time();

$query = "UPDATE `order` SET "
	."`qty`='".$qty
	."',`c`='".$c."', `hath`='".$hath."',`note`='".$note
	//."',`src`='".$src
	."',`timestamp`='".$timestamp."' "
	." WHERE `idwtb`='".$orderid."';";

$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect".mysql_error());
mysql_select_db($mysql_db) or die("Could not select database".mysql_error());
$result = mysql_query($query) or die("Query failed".mysql_error());

$json=new stdClass();
$json->query=$query;
$json->ret=$result;
echo json_encode($json);
// 断开连接
mysql_close($link);
?>
