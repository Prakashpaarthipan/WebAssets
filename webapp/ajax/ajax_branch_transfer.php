<?php
session_start();
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
include_once('../lib/config.php');
include_once('../lib/function_connect.php');
//include_once('../lib/general_functions.php');
extract($_REQUEST);
if($action =='branch') {
	//$sql_descode=select_query_json("select brn.BRNCODE,brn.nicname,brn.BRNNAME,pr.prjname branch  ,pr.prjcode , pr.prjcode||'  '||pr.prjname BRANCHNAME from trandata.branch@tcscentr brn,trandata.approval_project_id_master@tcscentr pr       where brn.DELETED = 'N' and pr.deleted = 'N' and brn.brncode = pr.brncode  and pr.pro_active = 'Y'  and pr.prjmode in ('B','M') and brn.nicname like '%".strtoupper($name_startsWith)."%'order by pr.prjcode asc","Centra","TCS");
      $sql_descode=select_query_json("select brncode,nicname from trandata.branch@tcscentr   where commode > 0 and deleted = 'N' and nicname like '%".strtoupper($name_startsWith)."%' order by brncode","Centra","TCS");
	//and atc.ATCCODE = '".$filter."'
	//".$_SESSION['tcs_empsrno']."
	//print_r($sql_descode);
	//120 - CLEAN INDIA TODAY BRANCH ID
    $users_arr = array();

	 foreach($sql_descode as $sectionrow) {
	// $branch = explode('-',$sectionrow['BRNNAME']);
	//  $name = $branch[0];
	//  $name = substr($name,2,-1);
	// $name = $sectionrow['NICNAME'];
	 $id = $sectionrow['BRNCODE'];
     $name=  trim(preg_replace('/[^A-Za-z\-]/', ' ',$sectionrow['NICNAME'] ));
	 //$brn = $sectionrow['BRANCH'];
     //$users_arr[] = array("id" => $id, "name" => $name , "brn" => $brn);
     array_push($users_arr, $id." - ".$name);
	 }
	 echo json_encode($users_arr);
	}
	if($action =='section') {

	$brncode = explode(" - ", $brncode);
    $sql_table=select_query_json("select brncode,nicname,commode from trandata.branch@tcscentr   where commode > 0 and deleted = 'N' and brncode = ".trim($brncode[0])." order by brncode","Centra","TCS");
	if($sql_table[0]['COMMODE'] == 7){
		$Sec_table = 'new_empsection';
	}else{
		$Sec_table = 'empsection';
	}
	$sql_esecode = select_query_json("select esecode, esename from ".$Sec_table." where DELETED = 'N' and esename like '%".strtoupper($name_startsWith)."%' order by esecode","Centra","TCS");
	//echo "select esecode esename from ".$Sec_table." where DELETED = 'N' order by esecode";
    $users_arr = array();

	 foreach($sql_esecode as $sectionrow) {
	// $branch = explode('-',$sectionrow['BRNNAME']);
	//  $name = $branch[0];
	//  $name = substr($name,2,-1);
	// $name = $sectionrow['NICNAME'];
	 $id = $sectionrow['ESECODE'];
     $name=  trim(preg_replace('/[^A-Za-z\-]/', ' ',$sectionrow['ESENAME'] ));
	 //$brn = $sectionrow['BRANCH'];
     //$users_arr[] = array("id" => $id, "name" => $name , "brn" => $brn);
     array_push($users_arr, $id." - ".$name);
	 }
	 echo json_encode($users_arr);
	}
	if($action =='designation') {

	$brncode = explode(" - ", $brncode);
    $sql_table=select_query_json("select brncode,nicname,commode from trandata.branch@tcscentr   where commode > 0 and deleted = 'N' and brncode = ".trim($brncode[0])." order by brncode","Centra","TCS");
	if($sql_table[0]['COMMODE'] == 7){
		$Sec_table = 'new_designation';
	}else{
		$Sec_table = 'designation';
	}
	$sql_esecode = select_query_json("select dsecode dsename from ".$Sec_table." where DELETED = 'N' order by dsecode","Centra","TCS");
    $users_arr = array();

	 foreach($sql_esecode as $sectionrow) {
	// $branch = explode('-',$sectionrow['BRNNAME']);
	//  $name = $branch[0];
	//  $name = substr($name,2,-1);
	// $name = $sectionrow['NICNAME'];
	 $id = $sectionrow['ESECODE'];
     $name=  trim(preg_replace('/[^A-Za-z\-]/', ' ',$sectionrow['ESENAME'] ));
	 //$brn = $sectionrow['BRANCH'];
     //$users_arr[] = array("id" => $id, "name" => $name , "brn" => $brn);
     array_push($users_arr, $id." - ".$name);
	 }
	 echo json_encode($users_arr);
	}