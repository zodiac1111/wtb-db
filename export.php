<?php
include "conf.php";

$db_file="/var/www/db.gz";
$cmd="/usr/bin/mysqldump -u".$mysql_user." -p".$mysql_pwd." -h".$mysql_host." ".$mysql_db." | /bin/gzip > ".$db_file;

$retval=0;
system($cmd,$retval);

$json=new stdClass();
$json->ret=$retval;

echo json_encode($json);

?>
