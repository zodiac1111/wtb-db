<?php
include "conf.php";

$db_file="/var/www/db.gz";
// 形如:
// /usr/bin/mysqldump -uroot -p123456 -h127.0.0.1 wtb | /bin/gzip > /var/www/db.gz
// 注意可能有文件(夹)权限问题.
$cmd="/usr/bin/mysqldump -u".$mysql_user." -p".$mysql_pwd." -h".$mysql_host." ".$mysql_db." | /bin/gzip > ".$db_file;

$retval=0;
system($cmd,$retval);

$json=new stdClass();
$json->ret=$retval;

echo json_encode($json);

?>
