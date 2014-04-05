<?php
include "conf.php";
/// 解析前端传递过来的参数

parse_str($_SERVER['QUERY_STRING']);
//echo $_SERVER['QUERY_STRING'];
//echo $my_arg;

// 排序部分
// $iSortCol_0 第一个排序字段 (暂时就排序一个字段) 
// $sSortDir_0 升序还是降序 asc /dsc
// 
// $iSortCol_1 是第二个排序字段(暂时没做)
// $sSortDir_1 升序还是降序 asc /dsc (依次类推)
$order = "";
if ($iSortCol_0 == "0") {
	$order .= " ORDER BY `order`.`idwtb` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "1") {
	$order .= " ORDER BY `order`.`type` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "2") {
	$order .= " ORDER BY `item`.`item_name` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "3") {
	$order .= " ORDER BY `play`.`play_name` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "4") {
	$order .= " ORDER BY `order`.`c` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "5") {
	$order .= " ORDER BY `order`.`hath` ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "8") {
	$order .= " ORDER BY `order`.`timestamp` ";
	$order .= $sSortDir_0;
} else {;
}


// 子功能:过滤交易类别 ,wtb=1 wts=2 wtt=3
$typeA=($wtb=="1")? " `order`.`type`=0 ":"0";
$typeB=($wts=="1")? " `order`.`type`=1 ":"0";
$typeC=($wtt=="1")? " `order`.`type`=2 ":"0";
// 如果没有选择任何类别,则选择所有类别.
if($wtb=="0" && $wts=="0" && $wtt=="0"){
	$typeA= " `order`.`type`=0 ";
	$typeB= " `order`.`type`=1 ";
	$typeC= " `order`.`type`=2 ";
}
$type .= " and ";
$type .= " ( ";
$type .= $typeA . " or " . $typeB . " or ".$typeC;
$type .= " ) ";

// 搜索子功能
$search_all="1"; //物品和玩家一起搜索
if ($sSearch<>"") {
	//$search .= "and item.item_name LIKE \"%" . $sSearch . "%\"";
	$search_all = " ( `item_name` LIKE \"%" . $sSearch . "%\" or `play_name` LIKE \"%" . $sSearch . "%\" ) ";
}

$search_item="1"; //分类搜索 --物品
if($sSearch_2<>""){
	$search_item=" `item_name` LIKE \"%" . $sSearch_2 . "%\" ";
}
$search_player="1"; //分类搜索 --玩家
if($sSearch_3<>""){
	$search_player=" `play_name` LIKE \"%" . $sSearch_3 . "%\" ";
}
// 组合所有搜索条件
$search= " and ( ". $search_all ." and " . $search_item . " and " .  $search_player .")";

// 限制条目数量
if($iDisplayLength ==""){
	$iDisplayLength ="10";
}
if($iDisplayStart ==""){
	$iDisplayStart="0";
}
$query = "select "
    ."`order`.`idwtb`,"
	."`order`.`type`, "
    ."`item`.`item_name`, "
    ."`play`.`play_name`, "
    ."`play`.`idplay`, "
    ."`order`.`c`, "
    ."`order`.`hath`, "
    ."`order`.`qty`, "
    ."`order`.`src`, "
	."`order`.`note`, "
	."`order`.`timestamp` "
    ."FROM "
    ."`item`, "
    ."`play`, "
    ."`order` "
    ."WHERE "
    ."`order`.`iditem` = `item`.`iditem` "
    ."    and `order`.`idplayer` = `play`.`idplay` "
. " " . $type
. " " . $search
. " " . $order
. " LIMIT " . $iDisplayStart . "," . $iDisplayLength 
. " ;";

// 得到符合的条目总数量,用于显示出"总共X条,第X到X条"
$counter= "SELECT COUNT(*)  FROM
    `item`,
    `play`,
    `order` WHERE
    	`order`.`iditem` = `item`.`iditem`
        	and `order`.`idplayer` = `play`.`idplay` "
	. " " . $type
	. $search . " ;";

//PHP手册中的PHP连接Mysql的实例
// 连接选择数据库
$link = mysql_connect($mysql_host,$mysql_user, $mysql_pwd) or die("Could not connect:".$link);

mysql_select_db($mysql_db) or die("Could not select database");
// 执行 SQL 查询
$result = mysql_query($query) or die("Query failed:".$query);

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
// 执行 SQL 查询(2) 得到总数量
$result = mysql_query($counter) or die("Query failed:".$query);
list($iTotalRecords) = mysql_fetch_row($result);
//$iTotalRecords=@mysql_num_rows($result);

// make json
// 返回json,得到一些调试信息,不是必须的
$json->sqlstring=$query;
$json->search=$search;
$json->arg="wtb:" . $wtb . " wts:" . $wts . " wtt:" . $wtt;
$json->sEcho=$sEcho;
$json->iTotalRecords=$iTotalRecords;// 总的记录条数
$json->iTotalDisplayRecords=$iTotalRecords ;//count($rows); // 显示的记录条数
$json->aaData=$rows;

// show json
echo json_encode($json);

// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
