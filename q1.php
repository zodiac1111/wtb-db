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
	$order .= " ORDER BY wtb.idwtb ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "1") {
	$order .= " ORDER BY wtb.type ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "2") {
	$order .= " ORDER BY item.item_name ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "3") {
	$order .= " ORDER BY play.play_name ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "4") {
	$order .= " ORDER BY wtb.c ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "5") {
	$order .= " ORDER BY wtb.hath ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "8") {
	$order .= " ORDER BY wtb.time ";
	$order .= $sSortDir_0;
} else {;
}


// 子功能:过滤交易类别 ,wtb=1 wts=2 wtt=3
$typeA=($wtb=="1")? " wtb.type=0 ":"0";
$typeB=($wts=="1")? " wtb.type=1 ":"0";
$typeC=($wtt=="1")? " wtb.type=2 ":"0";
// 如果没有选择任何类别,则选择所有类别.
if($wtb=="0" && $wts=="0" && $wtt=="0"){
	$typeA= " wtb.type=0 ";
	$typeB= " wtb.type=1 ";
	$typeC= " wtb.type=2 ";
}
$type .= " and ";
$type .= " ( ";
$type .= $typeA . " or " . $typeB . " or ".$typeC;
$type .= " ) ";

// 搜索子功能
$search_all="1"; //物品和玩家一起搜索
if ($sSearch<>"") {
	//$search .= "and item.item_name LIKE \"%" . $sSearch . "%\"";
	$search_all = " ( item_name LIKE \"%" . $sSearch . "%\" or play_name LIKE \"%" . $sSearch . "%\" ) ";
}

$search_item="1"; //分类搜索 --物品
if($sSearch_2<>""){
	$search_item=" item_name LIKE \"%" . $sSearch_2 . "%\" ";
}
$search_player="1"; //分类搜索 --玩家
if($sSearch_3<>""){
	$search_player=" play_name LIKE \"%" . $sSearch_3 . "%\" ";
}
// 组合所有搜索条件
$search= " and ( ". $search_all ." and " . $search_item . " and " .  $search_player .")";

if($iDisplayLength ==""){
	$iDisplayLength ="10";
}
if($iDisplayStart ==""){
	$iDisplayStart="0";
}
$query = "select "
    ."wtb.idwtb,"
	."wtb.type, "
    ."item.item_name, "
    ."play.play_name, "
    ."wtb.play.idplay, "
    ."wtb.c, "
    ."wtb.hath, "
    ."wtb.num_want, "
    ."wtb.src, "
	."wtb.note, "
	."wtb.timestamp "
    ."FROM "
    ."wtb.item, "
    ."wtb.play, "
    ."wtb.wtb "
    ."WHERE "
    ."wtb.iditem = item.iditem "
    ."    and wtb.idplayer = play.idplay "
. " " . $type
. " " . $search
. " " . $order
. " LIMIT " . $iDisplayStart . "," . $iDisplayLength 
. " ;";

$counter= "SELECT COUNT(*)  FROM
    wtb.item,
    wtb.play,
    wtb.wtb WHERE
    	wtb.iditem = item.iditem
        	and wtb.idplayer = play.idplay "
	. " " . $type
	. $search . " ;";

//PHP手册中的PHP连接Mysql的实例
// 连接选择数据库
$link = mysql_connect($mysql_host,$mysql_user, $mysql_pwd) or die("Could not connect");

mysql_select_db("wtb") or die("Could not select database");
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
// show json
$json->sqlstring=$query;
$json->search=$search;
$json->arg="wtb:" . $wtb . " wts:" . $wts . " wtt:" . $wtt;
$json->sEcho=$sEcho;
$json->iTotalRecords=$iTotalRecords;// 总的记录条数
$json->iTotalDisplayRecords=$iTotalRecords ;//count($rows); // 显示的记录条数
$json->aaData=$rows;

echo json_encode($json);

// json api end
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
