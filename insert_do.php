<?php
include "conf.php";
$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("Could not connect");
mysql_select_db($mysql_db) or die("Could not select database:".$link);

$type 	= $_POST["type"];
$idplayer = $_POST["idplayer"];
$obj	= $_POST["obj"]; /// 交易的对象:物品或者装备
$iditem	= $_POST["iditem"];
$idequip= $_POST["idequip"];
$qty 	= $_POST["qty"];
$c	 	= $_POST["c"];
$hath 	= $_POST["hath"];
$note 	= $_POST["note"];
$src	= $_POST["src"];
$timestamp=time();

/// 插入的是装备
if($obj=="1"){
	;
}else{
	;
}


// 先查询一下有没有同一玩家,同一类型(买卖),同一物品 的记录. 有则更新.没有则插入
$select = "select * from `order` where `type`='".$type
		."' and `iditem`='" .$iditem ."' and `idplayer`='".$idplayer."';";


$result = mysql_query($select) or die("Query failed:".$select);
//$json->result1=$result;
$rows = mysql_fetch_assoc($result);

// 没有则插入
if (empty($rows)){
	$query = "INSERT INTO `order` ( "
		  ." `type`,`obj`,`iditem`,`idequip`, `idplayer`, `qty`, `c`, `hath`,`note`,`src`,`timestamp`) " 
	." VALUES "
	." ('".$type."','".$obj."','".$iditem."','".$idequip."','".$idplayer."','"
	.$qty."','".$c."','".$hath."','".$note."','".$src."','".$timestamp."');";
// 有则更新
}else{
	//  索引关联数组
	$idwtb=$rows["idwtb"];
	$query = "UPDATE `order` SET "
		." `type`='".$type."',`obj`='".$obj
		."',`iditem`='".$iditem."',`idequip`='".$idequip
		."',`idplayer`='".$idplayer."', `qty`='".$qty
		."',`c`='".$c."', `hath`='".$hath."',`note`='".$note
		."',`src`='".$src."',`timestamp`='".$timestamp."' "
	." WHERE `idwtb`='".$idwtb."';";
}
//echo "var jstext='$query'"; //输出一句JS语句,生成一个JS变量,并赋颠值为PHP变量 $query 的值
//echo "var jstext='aa'";
//echo "var jstext=" . "'$query'";

$result = mysql_query($query) or die("Query failed:".$query);
//echo "var reset=" . $result;
//$json->array=var_dump($rows);
$json->obj=$obj; 
$json->count=count($rows);
$json->isempty=empty($rows);
$json->idwtb=$idwtb;
$json->result=$result;
$json->select=$select;
$json->query=$query;
$json->rows=$rows;


echo json_encode($json);

// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
