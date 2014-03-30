<html>
<head>
<title>connect.php</title>
</head>
<body>
<?php
phpinfo();
//PHP手册中的PHP连接Mysql的实例
// 连接选择数据库  
/*print "<h1>mysql_connect</h1>\n"; 

$link = mysql_connect("localhost", "root", "123456") or die("Could not connect");  
print "Connected successfully";    
mysql_select_db("wtb") or die("Could not select database");
// 执行 SQL 查询     

$query = "select wtb.item.item_name,wtb.play.play_name,wtb.c,wtb.hath,wtb.num_want,wtb.src
	from wtb.item,wtb.play,wtb.wtb 
	where wtb.wtb.iditem = wtb.item.iditem 
	and wtb.wtb.idplayer = wtb.play.idplay;
";   
$result = mysql_query($query) or die("Query failed");

// 在 HTML 中打印结果
print "<h1>html result</h1>\n";
print "<table>\n";   
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {        
	print "\t<tr>\n";
	foreach ($line as $col_value) { 
		print "\t\t<td>$col_value</td>\n";  
	}  
	print "\t</tr>\n";    
} 
print "</table>\n";


// json api start 
print "<h1>json string </h1>\n";
$result = mysql_query($query) or die("Query failed");  
$rows = array();
while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}
print "<p><code>\n";
echo json_encode($rows);
print "</code></p>\n";
// json api end
// 释放资源 
mysql_free_result($result);    

// 断开连接   
mysql_close($link);
*/
?>
</body>
