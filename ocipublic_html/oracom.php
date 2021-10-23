<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
class call_db {
	public function extract_connection()
	{
		$tcs = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		
		$source = $tcs->Get_Centra_Conn_Ora();
		
		$exp_source1 = explode("Data Source=",$source);
		
		$exp_source2 = explode(";Persist Security Info=True;User ID=",$exp_source1[1]);
		$dbname = $exp_source2[0]; // db name
		
		$exp_source3 = explode(";Password=",$exp_source2[1]);
		$usrname = $exp_source3[0]; // username
		
		$exp_source4 = explode(";Unicode=True",$exp_source3[1]);
		$psword = $exp_source4[0]; // password
		
		//$host = "172.16.50.3:1521/"; // test host name
		$host = "172.16.0.2:1521/"; // live host name
		
		$connection = $usrname.', '.$psword.', '.$host.$dbname;
		return $connection;
	}
}
var_dump(get_class_methods('call_db'));
$testObject = new call_db();
	$exp_tcs = explode(", ",$testObject->extract_connection());
	var_dump($exp_tcs);
	exit;
		$_SESSION['username1'] = $exp_tcs[0];
		$_SESSION['password1'] = $exp_tcs[1];
		$_SESSION['host_db1'] = $exp_tcs[2];
	$_SESSION['connect_db'] = $exp_tcs[0].", ".$exp_tcs[1].", ".$exp_tcs[2];
	$connect_db = oci_connect($exp_tcs[0], $exp_tcs[1], $exp_tcs[2]);