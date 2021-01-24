<?php
/* // Connect to TranData DB
$connect_db = oci_connect("trandata","centra123","172.16.50.3:1521/tcstest");
// Connect to TranData DB

// Connect to CRMData DB
$connect_crmdb = oci_connect("crmuser","crm123","172.16.0.49:1521/crmtest");
// Connect to CRMData DB */
?>

<?
//session_start();
//error_reporting(0);

	//setcookie('dbassign', 1, time() + (86400000 * 30)); /* 86400000 = 1000 days */
	$_SESSION['dbassign'] = 1;
	
	$testObject = new call_db();
	$exp_tcs = explode(", ",$testObject->extract_connection());
		$_SESSION['username1'] = $exp_tcs[0];
		$_SESSION['password1'] = $exp_tcs[1];
		$_SESSION['host_db1'] = $exp_tcs[2];
	$_SESSION['connect_db'] = $exp_tcs[0].", ".$exp_tcs[1].", ".$exp_tcs[2];
	$connect_db = oci_connect($exp_tcs[0], $exp_tcs[1], $exp_tcs[2]);


	$exp_ktm = explode(", ",$testObject->extract_connection_ktm());
		$_SESSION['ktm_username1'] = $exp_ktm[0];
		$_SESSION['ktm_password1'] = $exp_ktm[1];
		$_SESSION['ktm_host_db1'] = $exp_ktm[2];
	$_SESSION['ktm_connect_db'] = $exp_ktm[0].", ".$exp_ktm[1].", ".$exp_ktm[2];
	$ktm_connect_db = oci_connect($exp_ktm[0], $exp_ktm[1], $exp_ktm[2]);
	
	$exp_ktmtest = explode(", ",$testObject->extract_connection_ktmtest());
		$_SESSION['ktmtest_username1'] = $exp_ktmtest[0];
		$_SESSION['ktmtest_password1'] = $exp_ktmtest[1];
		$_SESSION['ktmtest_host_db1'] = $exp_ktmtest[2];
	$_SESSION['ktmtest_connect_db'] = $exp_ktmtest[0].", ".$exp_ktmtest[1].", ".$exp_ktmtest[2];
	$ktmtest_connect_db = oci_connect($exp_ktmtest[0], $exp_ktmtest[1], $exp_ktmtest[2]);
	
	
	//$crm = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
	//$source_crm = $crm->Get_CRM_Test_Conn();
	$exp_tcs_crm = explode(", ",$testObject->extract_connection_crm());
		$_SESSION['username2'] = $exp_tcs_crm[0];
		$_SESSION['password2'] = $exp_tcs_crm[1];
		$_SESSION['host_db2'] = $exp_tcs_crm[2];
	$_SESSION['connect_crmdb'] = $exp_tcs_crm[0].", ".$exp_tcs_crm[1].", ".$exp_tcs_crm[2];
	$_SESSION['connect_crmdbs'] = oci_connect($exp_tcs_crm[0], $exp_tcs_crm[1], $exp_tcs_crm[2]);
	$connect_crmdb = oci_connect($exp_tcs_crm[0], $exp_tcs_crm[1], $exp_tcs_crm[2]);


	$exp_tcstest = explode(", ",$testObject->extract_connection_tcstest());
		$_SESSION['tcstest_username'] = $exp_tcstest[0];
		$_SESSION['tcstest_password'] = $exp_tcstest[1];
		$_SESSION['tcstest_host_db'] = $exp_tcstest[2];
	$_SESSION['tcstest_connect_db'] = $exp_tcstest[0].", ".$exp_tcstest[1].", ".$exp_tcstest[2];
	$tcstest_connect_db = oci_connect($exp_tcstest[0], $exp_tcstest[1], $exp_tcstest[2]);
	
	
	$exp_tcs_crmtest = explode(", ",$testObject->extract_connection_crmtest());
		$_SESSION['crmtestusername2'] = $exp_tcs_crmtest[0];
		$_SESSION['crmtestpassword2'] = $exp_tcs_crmtest[1];
		$_SESSION['crmtesthost_db2'] = $exp_tcs_crmtest[2];
	$_SESSION['crmtestconnect_crmdb'] = $exp_tcs_crmtest[0].", ".$exp_tcs_crmtest[1].", ".$exp_tcs_crmtest[2];
	$_SESSION['crmtestconnect_crmdbs'] = oci_connect($exp_tcs_crmtest[0], $exp_tcs_crmtest[1], $exp_tcs_crmtest[2]);
	$connect_crmtestdb = oci_connect($exp_tcs_crmtest[0], $exp_tcs_crmtest[1], $exp_tcs_crmtest[2]);

	$exp_tcs_ksreq = explode(", ",$testObject->extract_connection_ksreq());
		$_SESSION['ksrequsername2'] = $exp_tcs_ksreq[0];
		$_SESSION['ksreqpassword2'] = $exp_tcs_ksreq[1];
		$_SESSION['ksreqhost_db2'] = $exp_tcs_ksreq[2];
	$_SESSION['ksreqconnect_crmdb'] = $exp_tcs_ksreq[0].", ".$exp_tcs_ksreq[1].", ".$exp_tcs_ksreq[2];
	$_SESSION['ksreqconnect_crmdbs'] = oci_connect($exp_tcs_ksreq[0], $exp_tcs_ksreq[1], $exp_tcs_ksreq[2]);
	$connect_ksreqdb = oci_connect($exp_tcs_ksreq[0], $exp_tcs_ksreq[1], $exp_tcs_ksreq[2]);
	
	/* $exp_tcs_allbrn = explode(", ",$testObject->Get_Local_Conn($brncode, $brnmode));
		$_SESSION['allbrnusername'] = $exp_tcs_allbrn[0];
		$_SESSION['allbrnpassword'] = $exp_tcs_allbrn[1];
		$_SESSION['allbrnhost_db'] = $exp_tcs_allbrn[2];
	$_SESSION['allbrnconnect_db'] = $exp_tcs_allbrn[0].", ".$exp_tcs_allbrn[1].", ".$exp_tcs_allbrn[2];
	$connect_allbrndb = oci_connect($exp_tcs_allbrn[0], $exp_tcs_allbrn[1], $exp_tcs_allbrn[2]); */

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
	public function extract_connection_ktm()
	{
		$tcs = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source = $tcs->Get_KTM_Centra_Conn();
	
		$exp_source1 = explode("Data Source=",$source);
		
		$exp_source2 = explode(";Persist Security Info=True;User ID=",$exp_source1[1]);
		$dbname = $exp_source2[0]; // db name
		
		$exp_source3 = explode(";Password=",$exp_source2[1]);
		$usrname = $exp_source3[0]; // username
		
		$exp_source4 = explode(";Unicode=True",$exp_source3[1]);
		$psword = $exp_source4[0]; // password
		
		//$host = "172.16.50.3:1521/"; // test host name
		$host = "172.16.0.2:1522/"; // live host name
		
		$connection = $usrname.', '.$psword.', '.$host.$dbname;
		return $connection;
	}
	public function extract_connection_ktmtest()
	{
		$tcs = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source = $tcs->Get_KTM_Centra_Test_Conn();
	
		$exp_source1 = explode("Data Source=",$source);
		
		$exp_source2 = explode(";Persist Security Info=True;User ID=",$exp_source1[1]);
		$dbname = $exp_source2[0]; // db name
		
		$exp_source3 = explode(";Password=",$exp_source2[1]);
		$usrname = $exp_source3[0]; // username
		
		$exp_source4 = explode(";Unicode=True",$exp_source3[1]);
		$psword = $exp_source4[0]; // password
		
		$host = "172.16.0.51:1521/"; // test host name
		
		$connection = $usrname.', '.$psword.', '.$host.$dbname;
		return $connection;
	}
	public function extract_connection_crm()
	{
		$crm = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source_crm = $crm->Get_CRM_Conn_Ora();
	
		$exp_source1_crm = explode("Data Source=",$source_crm);
		
		$exp_source2_crm = explode(";Persist Security Info=True;User ID=",$exp_source1_crm[1]);
		$dbname_crm = $exp_source2_crm[0]; // db name
		
		$exp_source3_crm = explode(";Password=",$exp_source2_crm[1]);
		$usrname_crm = $exp_source3_crm[0]; // username
		
		$exp_source4_crm = explode(";Unicode=True",$exp_source3_crm[1]);
		$psword_crm = $exp_source4_crm[0]; // password
		
		//$host_crm = "172.16.0.49:1521/"; // test host name
		$host_crm = "172.16.48.2:1521/"; // live host name
		
		$connection_crm = $usrname_crm.', '.$psword_crm.', '.$host_crm.$dbname_crm;
		return $connection_crm;
	}
	public function extract_connection_tcstest()
	{
		$tcs = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source = $tcs->Get_Centra_Test_Conn();
	
		$exp_source1 = explode("Data Source=",$source);
		
		$exp_source2 = explode(";Persist Security Info=True;User ID=",$exp_source1[1]);
		$dbname = $exp_source2[0]; // db name
		
		$exp_source3 = explode(";Password=",$exp_source2[1]);
		$usrname = $exp_source3[0]; // username
		
		$exp_source4 = explode(";Unicode=True",$exp_source3[1]);
		$psword = $exp_source4[0]; // password
		
		$host = "172.16.0.51:1521/"; // test host name
		//$host = "172.16.0.2:1522/"; // live host name
		
		$connection = $usrname.', '.$psword.', '.$host.$dbname;
		return $connection;
	}
	public function extract_connection_crmtest()
	{
		$crmtest = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source_crmtest = $crmtest->Get_Crm_Test_Conn();
	
		$exp_source1_crmtest = explode("Data Source=",$source_crmtest);
		
		$exp_source2_crmtest = explode(";Persist Security Info=True;User ID=",$exp_source1_crmtest[1]);
		$dbname_crmtest = $exp_source2_crmtest[0]; // db name
		
		$exp_source3_crmtest = explode(";Password=",$exp_source2_crmtest[1]);
		$usrname_crmtest = $exp_source3_crmtest[0]; // username
		
		$exp_source4_crmtest = explode(";Unicode=True",$exp_source3_crmtest[1]);
		$psword_crmtest = $exp_source4_crmtest[0]; // password
		
		$host_crmtest = "172.16.0.49:1521/"; // test host name
		//$host_crmtest = "172.16.48.2:1521/"; // live host name
		
		$connection_crmtest = $usrname_crmtest.', '.$psword_crmtest.', '.$host_crmtest.$dbname_crmtest;
		return $connection_crmtest;
	}
	public function extract_connection_ksreq()
	{
		$ksreq = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source_ksreq = $ksreq->Get_Centra_Req_Conn();
	
		$exp_source1_ksreq = explode("Data Source=",$source_ksreq);
		
		$exp_source2_ksreq = explode(";Persist Security Info=True;User ID=",$exp_source1_ksreq[1]);
		$dbname_ksreq = $exp_source2_ksreq[0]; // db name
		
		$exp_source3_ksreq = explode(";Password=",$exp_source2_ksreq[1]);
		$usrname_ksreq = $exp_source3_ksreq[0]; // username
		
		$exp_source4_ksreq = explode(";Unicode=True",$exp_source3_ksreq[1]);
		$psword_ksreq = $exp_source4_ksreq[0]; // password
		
		$host_ksreq = "172.16.0.94:1521/"; // live host name
		
		$connection_ksreq = $usrname_ksreq.', '.$psword_ksreq.', '.$host_ksreq.$dbname_ksreq;
		return $connection_ksreq;
	}
	public function Get_Local_Conn($brncode, $brnmode)
	{
		$allbrn = new DOTNET('Connection_String, Version=1.0.0.0, Culture=neutral, PublicKeyToken=9d4d8c43253f345e', "Connection_String.Test_Conn");
		$source_allbrn = $allbrn->GetDataView();
	
		$exp_source1_allbrn = explode("Data Source=",$source_allbrn);
		
		$exp_source2_allbrn = explode(";Persist Security Info=True;User ID=",$exp_source1_allbrn[1]);
		$dbname_allbrn = $exp_source2_allbrn[0]; // db name
		
		$exp_source3_allbrn = explode(";Password=",$exp_source2_allbrn[1]);
		$usrname_allbrn = $exp_source3_allbrn[0]; // username
		
		$exp_source4_allbrn = explode(";Unicode=True",$exp_source3_allbrn[1]);
		$psword_allbrn = $exp_source4_allbrn[0]; // password

		switch ($brncode){
			case 1: // TUP
				$host_allbrn = "172.16.8.2:1521/"; // live host name
				break;
			case 2: // CBE - I
				$host_allbrn = "172.16.16.2:1521/"; // live host name
				break;
			case 3: // ERD
				$host_allbrn = "172.16.24.2:1521/"; // live host name
				break;
			case 4: // CHN
				$host_allbrn = "172.16.32.2:1521/"; // live host name
				break;
			case 5: // TRY
				$host_allbrn = "172.16.40.2:1521/"; // live host name
				break;
			case 7: // CB2
				$host_allbrn = "172.16.56.2:1521/"; // live host name
				break;
			case 8: // CB3
				$host_allbrn = "172.16.64.2:1521/"; // live host name
				break;
			case 9: // KRR
				$host_allbrn = "172.16.72.2:1521/"; // live host name
				break;
			case 10: // EKM
				$host_allbrn = "172.16.80.2:1521/"; // live host name
				break;
			case 11: // TNV
				$host_allbrn = "172.16.88.2:1521/"; // live host name
				break;
			case 12: // VLR
				$host_allbrn = "172.16.104.2:1521/"; // live host name
				break;
			case 13: // SLM
				$host_allbrn = "172.16.112.2:1521/"; // live host name
				break;
			case 14: // MDU
				$host_allbrn = "172.16.120.2:1521/"; // live host name
				break;
			case 15: // VPM
				$host_allbrn = "172.16.128.2:1521/"; // live host name
				break;
			case 16: // VCY
				$host_allbrn = "172.16.136.2:1521/"; // live host name
				break;
			case 17: // HSR
				$host_allbrn = "172.16.144.2:1521/"; // live host name
				break;
			case 19: // CTR
				$host_allbrn = "172.16.160.2:1521/"; // live host name
				break;
			case 22: // TUT
				$host_allbrn = "172.16.170.2:1521/"; // live host name
				break;
			default: // TUP
				$host_allbrn = "172.16.8.2:1521/"; // live host name
				break;
		}
		
		$connection_allbrn = $usrname_allbrn.', '.$psword_allbrn.', '.$host_allbrn.$dbname_allbrn;
		return $connection_allbrn;
	}
}
?>