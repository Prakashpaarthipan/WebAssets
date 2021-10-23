<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL|E_STRICT);
// Create connection to Oracle
$conn = oci_connect("trandata", "centra123", "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.50.150)(PORT = 1521))) (CONNECT_DATA = (SID = TCSTEST) (SERVER = DEDICATED)))");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}

// Close the Oracle connection
oci_close($conn);

?>
