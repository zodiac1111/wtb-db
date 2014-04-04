<?php
session_start();
 
if (isset($_POST["locale"])) {
  $locale = $_POST["locale"];
} else if (isset($_SESSION["locale"])) {
  $locale  = $_SESSION["locale"];
} else {
  $locale = "zh_CN";
  //$locale = "en_US";
} 
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("messages", "./locale");
bind_textdomain_codeset($domain ,  'UTF-8' );  //设置mo文件的编码为UTF-8   
textdomain("messages");
/*
function _($argument) {
    return echo \_($argument); // this would be the non-overloaded _()
}*/
?>
