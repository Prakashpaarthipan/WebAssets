<?php

$c = $conn = oci_connect("trandata", "centra123", "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.50.150)(PORT = 1521))) (CONNECT_DATA = (SID = TCSTEST) (SERVER = DEDICATED)))");
oci_set_module_name($c, 'Home Page');
oci_set_action($c, 'Friend Lookup');

$s = oci_parse($c, "select * from dual");
oci_execute($s);

$r = oci_fetch_array($s);
echo "Value returned is ", $r[0];

?>
