<?php
$httphost = 'local.kmplzt.de'; //($_SERVER['HTTP_HOST']);
mysql_connect('db', 'root', '123') or die ('mysql error');
mysql_select_db('magento');
mysql_query('update core_config_data set value="http://'.$httphost.'/" where path like "%secure/base_url"') or die ("error query");

echo "host set to: " . $httphost . "\n";

system("rm -Rf var/cache/mage*");
