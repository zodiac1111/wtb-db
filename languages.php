<?php
//session_start();

// 解析出 $lang 变量
parse_str($_SERVER['QUERY_STRING']);


if (isset($lang)) {
	$locale = $lang;
} else if (isset($_SESSION["locale"])) {
	$locale  = $_SESSION["locale"];
} else {
	//$locale = "zh_CN";
	$locale = "en_US";
} 
$domain="messages"; //绑定名字域??
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale.".UTF-8");
bindtextdomain($domain, "./locale");
bind_textdomain_codeset($domain ,  'UTF-8' );  //设置mo文件的编码为UTF-8   
textdomain($domain);
header('Content-Type: text/html; charset=utf-8');
/*
function _($argument) {
    return echo \_($argument); // this would be the non-overloaded _()
}*/
?>
