<?php
//PHP手册中的PHP连接Mysql的实例
// 连接选择数据库
$link = mysql_connect("127.0.0.1", "root", "123456") or die("Could not connect");

mysql_select_db("wtb") or die("Could not select database");
// 执行 SQL 查询

// pasre the query string ,get sort etc.
parse_str($_SERVER['QUERY_STRING']);
//echo $_SERVER['QUERY_STRING'];
//echo $my_arg;
$order = "";
if ($iSortCol_0 == "0") {
	$order .= " ORDER BY wtb.idwtb ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "1") {
	$order .= " ORDER BY item.item_name ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "2") {
	$order .= " ORDER BY play.play_name ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "3") {
	$order .= " ORDER BY wtb.c ";
	$order .= $sSortDir_0;
} elseif ($iSortCol_0 == "4") {
	$order .= " ORDER BY wtb.hath ";
	$order .= $sSortDir_0;
} else {;
}

$search="";
if ($sSearch<>"") {
	//$search .= "and item.item_name LIKE \"%" . $sSearch . "%\"";
	$search .= "and (item_name LIKE \"%" . $sSearch . "%\" or play_name LIKE \"%" . $sSearch . "%\")";
}

if($iDisplayLength ==""){
	$iDisplayLength ="10";
}
if($iDisplayStart ==""){
	$iDisplayStart="0";
}
$query = "select 
    wtb.idwtb,
    item.item_name,
    play.play_name,
    wtb.play.idplay,
    wtb.c,
    wtb.hath,
    wtb.num_want,
    wtb.src,
	wtb.note
    FROM
    wtb.item,
    wtb.play,
    wtb.wtb
    WHERE
    wtb.wtb.iditem = wtb.item.iditem
        and wtb.wtb.idplayer = wtb.play.idplay"
. " " . $search
. " " . $order
. " LIMIT " . $iDisplayStart . "," . $iDisplayLength 
. " ;";

// debugprint
// echo "\"" . $query . "\"";
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
// show json
echo "{\"aaData\":";
echo json_encode($rows);
echo "}";

// json api end
// 释放资源
mysql_free_result($result);
// 断开连接
mysql_close($link);
?>
