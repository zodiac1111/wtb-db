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
textdomain("messages");

?>
