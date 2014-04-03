<?php
include "conf.php";
$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database");

$type 	= $_POST["type"];
$iditem	= $_POST["iditem"];
$idplayer = $_POST["idplayer"];
$qty 	= $_POST["qty"];
$c	 	= $_POST["c"];
$hath 	= $_POST["hath"];
$note 	= $_POST["note"];
$src	= $_POST["src"];


$select = "select * from wtb where `type`='".$type
		."' and `iditem`='" .$iditem ."' and `idplayer`='".$idplayer."';";

// 先查询一下有没有同一玩家,同一类型(买卖),同一物品 的记录. 有则更新.没有则插入
$result = mysql_query($select) or die("Query failed");
$rows = array();
while ($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}

// 没有则插入
if (empty($row)){
	$query = "INSERT 
	INTO
	   `wtb` (
		  `type`,`iditem`, `idplayer`, `num_want`, `c`, `hath`,`note`,`src`
	   ) 
	VALUES
	   ('".$type."', '".$iditem."', '".$idplayer."', '".$qty."','".$c."', '".$hath."','".$note."','".$src."');";
// 有则更新
}else{
	$e=array_shift($rows);
	$idwtb=$e->idwtb;
	$query = "UPDATE 
	   `wtb`  SET 
		  `type`='".$type."',`iditem`='".$iditem."', `idplayer`='".$idplayer."', `num_want`='".$qty."', `c`='".$c."', `hath`='".$hath."',`note`='".$note."',`src`='".$src."'
	WHERE `idwtb`='".$idwtb."';";
}
//echo "var jstext='$query'"; //输出一句JS语句,生成一个JS变量,并赋颠值为PHP变量 $query 的值
//echo "var jstext='aa'";
//echo "var jstext=" . "'$query'";

$result = mysql_query($query) or die("Query failed");
//echo "var reset=" . $result;
$json->array=implode(",", $row); 
$json->count=count($row);
$json->idwtb=$idwtb;
$json->ret="1";
$json->l=$rows.length;
$json->select=$select;
$json->adata="";
$json->sql=$query;

echo json_encode($json);

// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
