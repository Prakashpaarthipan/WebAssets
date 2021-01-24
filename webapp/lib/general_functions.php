<?
session_start();
error_reporting(0);
include_once('config.php');
// connect and login to FTP server

try {
	$ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022) or die("Could not1 connect to Approval Desk FTP server");
	$login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
}
catch(Exception $e) { //catch exception
  echo 'Error Message: ' .$e->getMessage();
}

function listFolderFiles($dir){
	include_once('lib/config.php');
	$ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022) or die("Could not2 connect to ftpvri_server_apdsk");
	$login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);

    $files = ftp_nlist($ftp_conn, $dir);
	return $files;
}

function find_datacount($data, $dataindi, $dataurl){
	include_once('lib/config.php');
	// echo "**".ftpvri_server_apdsk."**".ftpvri_user_name_apdsk."**".ftpvri_user_pass_apdsk."**"; exit;
	$ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022) or die("Could not3 connect to ftpvri_server_apdsk");
	$login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
	$vari = listFolderFiles("approval_desk/request_entry/".$dataurl."/");

	$cntvalue = 0;
	for($ivar = 0; $ivar < count($vari); $ivar++) {
		$remove_dir = explode("/", $vari[$ivar]);
		$exp = explode("_", $remove_dir[3]);
		$expdot = explode(".", $vari[$ivar]);
		$filename = $data.''.$exp[5].'_'.$exp[6];
		switch($exp[5])
		{
			case 'i':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "&nbsp;&nbsp;<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" data-toggle=\"lightbox\" data-gallery=\"multiimages\" data-title=\"\" data-footer=".$filename." style=\"float:left\"><img src=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" class=\"img-responsive style_box\" border=0 style=\"width:100px; height:100px; margin-left:10px\"></a>";
					$cntvalue++;
				}
				break;
			case 'n':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "&nbsp;&nbsp;<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
					$cntvalue++;
				}
				break;
			case 'w':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "&nbsp;&nbsp;<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
					$cntvalue++;
				}
				break;
			case 'e':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "&nbsp;&nbsp;<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
					$cntvalue++;
				}
				break;
			case 'p':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "&nbsp;&nbsp;<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
					$cntvalue++;
				}
				break;
			default:
				if($filename == $remove_dir[3]) {
					$fieldindi .= '';
				}
				break;
		}
	}
	return $cntvalue++;
}


function find_data($data, $dataindi, $dataurl)
{
	include_once('lib/config.php');
	$ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022) or die("Could not3 connect to ftpvri_server_apdsk");
	$login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
	$vari = listFolderFiles("approval_desk/request_entry/".$dataurl."/");

	for($ivar = 0; $ivar < count($vari); $ivar++) {
		$remove_dir = explode("/", $vari[$ivar]);
		$exp = explode("_", $remove_dir[3]);
		$tmp_ext = explode('.',$exp[6]);
		$expdot = explode(".", $vari[$ivar]);
		$filename = $data.''.$exp[5].'_'.$exp[6];
		$tmp_filename = $data.''.$exp[5].'_'.$tmp_ext[0].'.jpg';
		$filename_download = 'Click <a href=\'ftp://"'.$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/approval_desk/request_entry/'.$dataurl.'/'.$filename.'\'>here</a>';
		switch($exp[5])
		{
			case 'i':
				/* if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" data-toggle=\"lightbox\" data-gallery=\"multiimages\" data-title=\"\" data-footer=\"<a target='_blank' download href='ftp://".$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/approval_desk/request_entry/'.$dataurl.'/'.$filename."' class='btn btn-success'><i class='fa fa-fw fa-download'></i> Download Image</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='idrotate btn btn-primary'><i class='fa fa-fw fa-rotate-right'></i> Rotate</a>\" style=\"float:left; margin-bottom:10px\"><img src=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/thumb_images/".$tmp_filename."\" class=\"img-responsive style_box\" id='image' border=0 style=\"width:100px; height:100px; margin-left:5px\"></a>";
				} */ // OLD IMAGE PAGE
				if($filename == $remove_dir[3]) {
					/* $fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" data-toggle=\"lightbox\" data-gallery=\"multiimages\" data-title=\"\" data-footer=\"<a target='_blank' download href='ftp://".$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/approval_desk/request_entry/'.$dataurl.'/'.$filename."' class='btn btn-success'><i class='fa fa-fw fa-download'></i> Download Image</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='idrotate btn btn-primary'><i class='fa fa-fw fa-rotate-right'></i> Rotate</a>&nbsp;&nbsp;<button class='btn btn-primary zoom-in'>Zoom In <i class='fa fa-fw fa-plus'></i></button>&nbsp;&nbsp;<button class='btn btn-primary zoom-out'>Zoom Out <i class='fa fa-fw fa-minus'></i></button>&nbsp;&nbsp;<button class='btn btn-warning reset'>Reset <i class='fa fa-fw fa-refresh'></i></button>\" style=\"float:left; margin-bottom:10px\"><img src=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/thumb_images/".$tmp_filename."\" class=\"img-responsive style_box\" id='image' border=0 style=\"width:100px; height:100px; margin-left:5px\"></a>"; // CLOSE FOR THUMB.. 07-10-2016 */
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" data-toggle=\"lightbox\" data-gallery=\"multiimages\" data-title=\"\" data-footer=\"<a target='_blank' download href='ftp://".$ftp_user_name.':'.$ftp_user_pass.'@'.$ftp_server.'/approval_desk/request_entry/'.$dataurl.'/'.$filename."' class='btn btn-success'><i class='fa fa-fw fa-download'></i> Download Image</a>&nbsp;&nbsp;<a href='javascript:void(0)' class='idrotate btn btn-primary'><i class='fa fa-fw fa-rotate-right'></i> Rotate</a>&nbsp;&nbsp;<button class='btn btn-primary zoom-in'>Zoom In <i class='fa fa-fw fa-plus'></i></button>&nbsp;&nbsp;<button class='btn btn-primary zoom-out'>Zoom Out <i class='fa fa-fw fa-minus'></i></button>&nbsp;&nbsp;<button class='btn btn-warning reset'>Reset <i class='fa fa-fw fa-refresh'></i></button>\" style=\"float:left; margin-bottom:10px\"><img src=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$tmp_filename."\" class=\"img-responsive style_box\" id='image' border=0 style=\"width:100px; height:100px; margin-left:5px\"></a>"; // OPEN FOR THUMB.. 07-10-2016
				}
				break;
			case 'n':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\" style=\"float:left; margin-bottom:10px; margin-left:5px;\"><img src=\"images/icon\notepad.png\" style=\"width: 20px;height: 20px;border:0px;\"> ".$filename."</a>";
				}
				break;
			case 'w':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\" style=\"float:left; margin-bottom:10px; margin-left:5px;\"><img src=\"images/icon\word.png\" style=\"width: 20px;height: 20px;border:0px;\"> ".$filename."</a>";
				}
				break;
			case 'e':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\" style=\"float:left; margin-bottom:10px; margin-left:5px;\"><img src=\"images/icon\excel.png\" style=\"width: 20px;height: 20px;border:0px;\"> ".$filename."</a>";
				}
				break;
			case 'p':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\" style=\"float:left; margin-bottom:10px; margin-left:5px;\"><img src=\"images/icon\pdf.png\" style=\"width: 20px;height: 20px;border:0px;\"> ".$filename."</a>";
				}
				break;
			default:
				if($filename == $remove_dir[3]) {
					$fieldindi .= '';
				}
				break;
		}
	}
	return $fieldindi;
}


function find_data_without($data, $dataindi, $dataurl)
{
	include_once('lib/config.php');
	$ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022) or die("Could not3 connect to ftpvri_server_apdsk");
	$login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
	$vari = listFolderFiles("approval_desk/request_entry/".$dataurl."/");

	for($ivar = 0; $ivar < count($vari); $ivar++) {
		$remove_dir = explode("/", $vari[$ivar]);
		$exp = explode("_", $remove_dir[3]);
		$expdot = explode(".", $vari[$ivar]);
		$filename = $data.''.$exp[5].'_'.$exp[6];
		switch($exp[5])
		{
			case 'i':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" style=\"float:left\"><img src=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" border=0 style=\"width:100px; height:100px; border: 1px solid #666666; margin-left:10px\"></a>";
				}
				break;
			case 'n':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
				}
				break;
			case 'w':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
				}
				break;
			case 'e':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
				}
				break;
			case 'p':
				if($filename == $remove_dir[3]) {
					$fieldindi .= "<a href=\"ftp://".$ftp_user_name.":".$ftp_user_pass."@".$ftp_server."/approval_desk/request_entry/".$dataurl."/".$filename."\" target=\"_blank\" class=\"style_box\">".$filename."</a><br><br>";
				}
				break;
			default:
				if($filename == $remove_dir[3]) {
					$fieldindi .= '';
				}
				break;
		}
	}
	return $fieldindi;
}


// find_indicator( 'image/jpeg' )
function find_indicator( $indicatortype )
{
	switch ($indicatortype)
	{
		case 'image/jpeg':
			$indicat = 'i';
			break;
		case 'image/jpg':
			$indicat = 'i';
			break;
		case 'image/png':
			$indicat = 'i';
			break;
		case 'image/gif':
			$indicat = 'i';
			break;

		case 'text/plain':
			$indicat = 'n';
			break;
		case 'application/msword':
			$indicat = 'w';
			break;
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			$indicat = 'w';
			break;
		case 'application/vnd.ms-excel':
			$indicat = 'e';
			break;
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			$indicat = 'e';
			break;
		case 'application/pdf':
			$indicat = 'p';
			break;

		default:
			$indicat = 'i';
			break;
	}
	return $indicat;
}

// find_indicator_fromfile( 'filename.pdf' ), find_indicator_fromfile( 'filename.png' )
function find_indicator_fromfile( $filename )
{
	$indicatortype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	switch ($indicatortype)
	{
		case 'jpeg':
		case 'jpg':
			$indicat = 'i';
			break;

		case 'txt':
			$indicat = 'n';
			break;

		case 'doc':
		case 'docx':
			$indicat = 'w';
			break;

		case 'xls':
		case 'csv':
			$indicat = 'e';
			break;

		case 'pdf':
			$indicat = 'p';
			break;

		default:
			$indicat = 'i';
			break;
	}
	return $indicat;
}


function moneyFormatIndia($num1){
	$num2 = explode(".", $num1);
	$num = $num2[0];
    $explrestunits = "";
    if(strlen($num)>3){
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++){
            // creates each of the 2's group and adds a comma to the end
            if($i==0)
            {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            }else{
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}


function convert_rup($number)
{
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] ." " . $digits[$counter] . $plural . " " . $hundred : $words[floor($number / 10) * 10]. " " . $words[$number % 10] . " ". $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " .
          $words[$point = $point % 10] : '';
 return "Rs:-  " .$result ."  Only" ;
}


function calculate_total($quantity, $rate, $discount, $tax)
{
	//calculate_total($sql_reqd[$rqdi]['PRDQTY1'], $sql_reqd[$rqdi]['PRDVALU1'], $sql_reqd[$rqdi]['PRDDISC1'], $sql_reqd[$rqdi]['PRDTAX1'])
	$total1 = $quantity * $rate;
	$total2 = $total1 - ($total1 * ($discount / 100));
	$total3 = $total2 + ($total2 * ($tax / 100));
	return round($total3);
}


/* function chk_usr_login($usrcode) // Without IP Address
{
	$s_str = "";
	$c_ampm_mode = "";

	$dvchk = select_query_json("Select user_lock(".$usrcode.") as Chk from dual");
	$s_str = "Select to_char(sysdate,'dd') as dys,to_char(sysdate,'AM') AMPM,to_char(sysdate,'HH24.MI') LOGIN_TIME_HR from dual";
	$dvday = select_query_json($s_str);
	// $login_time_hr = $dvday[0]["LOGIN_TIME_HR"];

	$vl = ($dvchk[0]["CHK"] == "Y" ? ",'B'" : "");
	$s_str = " Select decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") as Weks from attn_register where empsrno=(select nvl(sum(empsrno),0) emp_srno from userid where usrcode=".$usrcode.") and payyear=to_char(sysdate,'YYYY') and paymont=to_char(sysdate,'MM') and decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") in ('A','P','W','L'". $vl .") ";
	$c_ampm_mode = $dvday[0]["AMPM"];
	$dvday = select_query_json($s_str);

	if(count($dvday) > 0)
	{
		switch($dvday[0]["WEKS"])
		{
			case "W" :
				return "Entered User is Weekly Off Today , So Not Possible to Login! ";
				break;
			case "L":
				return "Entered User is Leave Today , So Not Possible to Login! ";
				break;
			case "B":
				return "Entered User is Absent Today , So Not Possible to Login! ";
				break;
			case "AM":
				return "Entered User is HalfDay(AM) Leave , So Not Possible to Login! ";
				break;
			case "PM":
				return "Entered User is HalfDay(PM) Leave , So Not Possible to Login! ";
				break;
			default:
				return 1;
				break;
		}
	} else { return 1; }
} */

function chk_usr_logins($usrcode, $currentip) // With IP Address
{
	$s_str = "";
	$c_ampm_mode = "";

	$dvchk = select_query_json("Select user_lock('".$usrcode."', '".$currentip."') as Chk from dual", "Centra", "TCS");
	$s_str = "Select to_char(sysdate,'dd') as dys,to_char(sysdate,'AM') AMPM,to_char(sysdate,'HH24.MI') LOGIN_TIME_HR from dual";
	$dvday = select_query_json($s_str, "Centra", "TCS");
	// $login_time_hr = $dvday[0]["LOGIN_TIME_HR"];

	$vl = ($dvchk[0]["CHK"] == "Y" ? ",'B'" : "");
	$s_str = " Select decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") as Weks from attn_register where empsrno=(select nvl(sum(empsrno),0) emp_srno from userid where usrcode=".$usrcode.") and payyear=to_char(sysdate,'YYYY') and paymont=to_char(sysdate,'MM') and decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") in ('A','P','W','L'". $vl .") ";
	$c_ampm_mode = $dvday[0]["AMPM"];
	$dvday = select_query_json($s_str, "Centra", "TCS");

	if(count($dvday) > 0)
	{
		switch($dvday[0]["WEKS"])
		{
			case "W" :
				return "Entered User is Weekly Off Today , So Not Possible to Login! ";
				break;
			case "L":
				return "Entered User is Leave Today , So Not Possible to Login! ";
				break;
			case "B":
				return "Entered User is Absent Today , So Not Possible to Login! ";
				break;
			case "AM":
				return "Entered User is HalfDay(AM) Leave , So Not Possible to Login! ";
				break;
			case "PM":
				return "Entered User is HalfDay(PM) Leave , So Not Possible to Login! ";
				break;
			default:
				return 1;
				break;
		}
	} else { return 1; }
}

function chk_usr_logins_json($usrcode, $currentip) // With IP Address
{
	$s_str = "";
	$c_ampm_mode = "";

	$dvchk = select_query_json("Select user_lock('".$usrcode."', '".$currentip."') as Chk from dual", "Centra", 'TCS');
	$s_str = "Select to_char(sysdate,'dd') as dys,to_char(sysdate,'AM') AMPM,to_char(sysdate,'HH24.MI') LOGIN_TIME_HR from dual";
	$dvday = select_query_json($s_str, "Centra", 'TCS');
	// $login_time_hr = $dvday[0]["LOGIN_TIME_HR"];

	$vl = ($dvchk[0]["CHK"] == "Y" ? ",'B'" : "");
	$s_str = " Select decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") as Weks from attn_register where empsrno=(select nvl(sum(empsrno),0) emp_srno from userid where usrcode=".$usrcode.") and payyear=to_char(sysdate,'YYYY') and paymont=to_char(sysdate,'MM') and decode(d". $dvday[0]["DYS"] .",null,'B',d". $dvday[0]["DYS"] .") in ('A','P','W','L'". $vl .") ";
	$c_ampm_mode = $dvday[0]["AMPM"];
	$dvday = select_query_json($s_str, "Centra", 'TCS');

	if(count($dvday) > 0)
	{
		switch($dvday[0]["WEKS"])
		{
			case "W" :
				return "Entered User is Weekly Off Today , So Not Possible to Login! ";
				break;
			case "L":
				return "Entered User is Leave Today , So Not Possible to Login! ";
				break;
			case "B":
				return "Entered User is Absent Today , So Not Possible to Login! ";
				break;
			case "AM":
				return "Entered User is HalfDay(AM) Leave , So Not Possible to Login! ";
				break;
			case "PM":
				return "Entered User is HalfDay(PM) Leave , So Not Possible to Login! ";
				break;
			default:
				return 1;
				break;
		}
	} else { return 1; }
}


function UserIPAddress($usercode, $currentip) {
	$userip = array("9938358" => "172.16.50.5", // KS Sir - MD
					"2000000" => "172.16.50.6", // PS Madam - MD
					"3000000" => "", // AK Sir - MD

					"2444001" => "172.16.48.12", // RDTM - Sr. GM
					"2001002" => "172.16.52.11", // Ganesh - GM
					"1986888" => "172.16.50.2", // Kumaran - GM
					"1062001" => "172.16.52.33", // NSM - GM

					"1118001" => "172.16.51.11", // PKN - Accounts HOD
					"1389888" => "172.16.50.13", // Senthil - IT HOD
					"1112001" => "172.16.48.30", // UC Muthukumaar - Admin HOD
					"1228001" => "172.16.52.5", // SP Saravanan - MIA HOD
					"1340005" => "172.16.48.43", // Venkat Durairaj - Sales HOD
					"1384004" => "172.16.50.21", // Karthikeyan - HW HOD
					"1366003" => "172.16.48.72", // Mohan - MIS HOD
					"1367002" => "172.16.51.12", // Ashok - Payments HOD
					"6635888" => "172.16.9.152" // Chandra Sekaran - Designing HOD
				   );
	if (array_key_exists($usercode, $userip)) {
		if($userip[$usercode] == $currentip) {
			return 1; // "Match found and Same IP Address - ".$userip[$usercode];
		} else {
			return 2; // "Match found but different IP Address - ".$userip[$usercode];
		}
	} else {
		return 0; // "Match not found";
	}
}


/* In Array Multiarray Method 1 */
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
/* In Array Multiarray Method 1 */


/* In Array Multiarray Method 2 */
function in_multiarray($elem, $array, $field)
{
    $top = sizeof($array) - 1;
    $bottom = 0;
    while($bottom <= $top)
    {
        if($array[$bottom][$field] == $elem)
            return true;
        else
            if(is_array($array[$bottom][$field]))
                if(in_multiarray($elem, ($array[$bottom][$field])))
                    return true;
        $bottom++;
    }
    return false;
}
/* In Array Multiarray Method 2 */

function get_month($month) {
	$ex = explode(",", $month);
	switch($ex[0]) {
		case 1:
			$mnt = "JAN"; break;
		case 2:
			$mnt = "FEB"; break;
		case 3:
			$mnt = "MAR"; break;
		case 4:
			$mnt = "APR"; break;
		case 5:
			$mnt = "MAY"; break;
		case 6:
			$mnt = "JUN"; break;
		case 7:
			$mnt = "JUL"; break;
		case 8:
			$mnt = "AUG"; break;
		case 9:
			$mnt = "SEP"; break;
		case 10:
			$mnt = "OCT"; break;
		case 11:
			$mnt = "NOV"; break;
		case 12:
			$mnt = "DEC"; break;
	}
	return $mnt.", ".$ex[1];
}


function findmonth($month) {
	switch($month) {
		case 1:
			$mnt = "JAN"; break;
		case 2:
			$mnt = "FEB"; break;
		case 3:
			$mnt = "MAR"; break;
		case 4:
			$mnt = "APR"; break;
		case 5:
			$mnt = "MAY"; break;
		case 6:
			$mnt = "JUN"; break;
		case 7:
			$mnt = "JUL"; break;
		case 8:
			$mnt = "AUG"; break;
		case 9:
			$mnt = "SEP"; break;
		case 10:
			$mnt = "OCT"; break;
		case 11:
			$mnt = "NOV"; break;
		case 12:
			$mnt = "DEC"; break;
	}
	return $mnt;
}

function find_enddate($mnth) {
	$enddate = date('t/m/Y', strtotime('01-'.$mnth.'-Y'));
	return $enddate;
}

function find_onlylastdate($mnth) {
	$enddate = date('t', strtotime('01-'.$mnth.'-Y'));
	return $enddate;
}

function user_rights($mainmenu, $user)
{
	$inner_mainmenu = select_query_json("select * from SRM_MENU mnu, SRM_MENU_ACCESS acc
												where mnu.MNUCODE = acc.MNUCODE and mnu.MAINMENU = '".$mainmenu."' and acc.entsrno = ".$user."
												order by mnu.MNUCODE Asc", "Centra", "TCS");
	$access = 0;
	for($menu = 0; $menu < count($inner_mainmenu); $menu++)
	{
		if($inner_mainmenu[$menu]['VEWVALU'] == 'Y')
		{
			$access++;
		}
	}
	if($access == 0) { return 0; }
	else { return 1; }
}

// Add internal Verification user dynamically from MD user
function add_ivuser($md_user, $alternate_user, $txt_approval_number, $maxarqcode) {
	$ivqry = 0;
	$sql_akiv = select_query_json("select COUNT(*) CNT from APPROVAL_request 
											where aprnumb = '".$txt_approval_number."' and ARQSRNO=".$maxarqcode." AND (REQSTFR = ".$md_user." 
												and REQSTBY <> ".$alternate_user.")", "Centra", "TCS");
	if(count($sql_akiv) > 0) {
		$tbl_akiv = "APPROVAL_request";
		$field_akiv = array();
		$field_akiv['APPSTAT'] = 'F';
		// print_r($field_akiv);
		$where_akiv = " APRNUMB='".$txt_approval_number."' and ARQSRNO=".$maxarqcode." ";
		$insert_akiv = update_dbquery($field_akiv, $tbl_akiv, $where_akiv);

		// MR. AK Sir User - 21344
		$fstusr = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$md_user, "Centra", "TCS"); // MR. AK Sir User - 21344
		$fstusrdes = "designation"; $fstusrsec = "empsection";
		if($fstusr[0]['PAYCOMPANY'] == 2) {
			$fstusrdes = "new_designation"; $fstusrsec = "new_empsection";
		}
		$fstusrdesignation = select_query_json("Select DESNAME From ".$fstusrdes." where DESCODE = ".$fstusr[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection = select_query_json("Select ESENAME From ".$fstusrsec." where deleted = 'N' and ESECODE = ".$fstusr[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. AK Sir User - 21344

		// MR. NSM Sir User - 168
		$fstusr1 = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$alternate_user, "Centra", "TCS"); // MR. NSM Sir User - 168
		$fstusrdes1 = "designation"; $fstusrsec1 = "empsection";
		if($fstusr1[0]['PAYCOMPANY'] == 2) {
			$fstusrdes1 = "new_designation"; $fstusrsec1 = "new_empsection";
		}
		$fstusrdesignation1 = select_query_json("Select DESNAME From ".$fstusrdes1." where DESCODE = ".$fstusr1[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection1 = select_query_json("Select ESENAME From ".$fstusrsec1." where deleted = 'N' and ESECODE = ".$fstusr1[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. NSM Sir User - 168

		$ivqry = delete_dbquery("INSERT INTO APPROVAL_request select ARQCODE,ARQYEAR,(".$maxarqcode.")+1,ATYCODE,ATMCODE,APMCODE,ATCCODE,APPRFOR,REQSTTO,APPRSUB,APPRDET,APPRSFR,APPRSTO,APPATTN,APRQVAL,APPDVAL,APPFVAL,BRNCODE,DEPCODE,TARNUMB,TARBALN,TARDESC,'".$fstusr[0]['EMPSRNO']."','".$fstusr[0]['EMPCODE']." - ".$fstusr[0]['EMPNAME']."','".$fstusr[0]['DESCODE']."','".$fstusr[0]['ESECODE']."','".$fstusrdesignation[0]['DESNAME']."','".$fstusrsection[0]['ESENAME']."','".$fstusr1[0]['EMPSRNO']."','".$fstusr1[0]['EMPCODE']." - ".$fstusr1[0]['EMPNAME']."','".$fstusr1[0]['DESCODE']."','".$fstusr1[0]['ESECODE']."','".$fstusrdesignation1[0]['DESNAME']."','".$fstusrsection1[0]['ESENAME']."',RQESTTO,RQTODES,RQTODSC,RQTOESC,RQTODSN,RQTOESN,APRNUMB,'N','I',APPINTP,10129,INTPDES,INTPDSC,INTPESC,INTPDSN,INTPESN,INTPAPR,INTSUGG,INTPFRD,INTPTOD,'".$fstusr[0]['EMPSRNO']."',ADDDATE,EDTUSER,EDTDATE,DELETED,'".$fstusr[0]['EMPSRNO']."',DELDATE,APRCODE,APRHURS,APRDAYS,APRDUED,'VERIFY THIS APPROVAL',APRTITL,FINSTAT,FINUSER,FINCMNT,FINDATE,TARVLCY,TARVLLY,EXPNAME,TARPRCY,TARPRLY,USRSYIP,PRJPRCS,PLANVAL,IMDUEDT,IMUSRCD,IMSTATS,IMFINDT,IMUSRIP,TYPMODE,SUBCORE,BUDTYPE,BUDCODE,IMFNIMG,NXLVLUS,PRICODE,SUPCODE,SUPNAME,SUPCONT,PRODWIS,RESPUSR,ALTRUSR,RELAPPR,ORGRECV,ORGRVUS,ORGRVDT,ORGRVDC,CNVRMOD,PURHEAD,APPTYPE,ADVAMNT,AGNSAPR,WRKINUSR,ARQPCOD,BDPLANR,DYNSUBJ,TXTSUBJ,RMQUOTS,RMBDAPR,RMCLRPT,RMARTWK,RMCONAR,WARQUAR,CRCLSTK,PAYPERC,FNTARDT,RPTUSER,ACKUSER,ACKSTAT,ACKDATE,AGEXPDT,AGADVAM,DYSBFDT,DYSBTDT, APPICON,RTFNUSR,RMPONUM,AUTFRWD,EXPSRNO,QUOYEAR,HAPNUMB,RQVALUE,AREASON ,EXPYEAR,INVNUMB,INVDATE,ACTMODE from APPROVAL_request where APRNUMB = '".$txt_approval_number."' and ARQSRNO=".$maxarqcode);
	}
	return $ivqry;
}
// Add internal Verification user dynamically from MD user

// Add internal Verification user dynamically FOR BID
function add_ivuser1($md_user, $alternate_user, $txt_approval_number, $maxarqcode) {
	$ivqry = 0;
	$sql_akiv = select_query_json("select COUNT(*) CNT from APPROVAL_request 
										where aprnumb = '".$txt_approval_number."' and ARQSRNO=".$maxarqcode." AND (REQSTFR = ".$md_user." 
											and REQSTBY <> ".$alternate_user.")", "Centra", "TCS");
	if(count($sql_akiv) > 0) {
		$tbl_akiv = "APPROVAL_request";
		$field_akiv = array();
		$field_akiv['APPSTAT'] = 'F';
		$field_akiv['APRTITL'] = 'BIDIV';

		// print_r($field_akiv);
		$where_akiv = " APRNUMB='".$txt_approval_number."' and ARQSRNO=".$maxarqcode." ";
		$insert_akiv = update_dbquery($field_akiv, $tbl_akiv, $where_akiv);

		// MR. AK Sir User - 21344
		$fstusr = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$md_user, "Centra", "TCS"); // MR. AK Sir User - 21344
		$fstusrdes = "designation"; $fstusrsec = "empsection";
		if($fstusr[0]['PAYCOMPANY'] == 2) {
			$fstusrdes = "new_designation"; $fstusrsec = "new_empsection";
		}
		$fstusrdesignation = select_query_json("Select DESNAME From ".$fstusrdes." where DESCODE = ".$fstusr[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection = select_query_json("Select ESENAME From ".$fstusrsec." where deleted = 'N' and ESECODE = ".$fstusr[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. AK Sir User - 21344

		// MR. NSM Sir User - 168
		$fstusr1 = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$alternate_user, "Centra", "TCS"); // MR. NSM Sir User - 168
		$fstusrdes1 = "designation"; $fstusrsec1 = "empsection";
		if($fstusr1[0]['PAYCOMPANY'] == 2) {
			$fstusrdes1 = "new_designation"; $fstusrsec1 = "new_empsection";
		}
		$fstusrdesignation1 = select_query_json("Select DESNAME From ".$fstusrdes1." where DESCODE = ".$fstusr1[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection1 = select_query_json("Select ESENAME From ".$fstusrsec1." where deleted = 'N' and ESECODE = ".$fstusr1[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. NSM Sir User - 168

		$maxarqcode1 = select_query_json("Select  nvl(Max(ARQSRNO),1)+1 maxarqsrno
												From APPROVAL_REQUEST WHERE APRNUMB='".$txt_approval_number."'", "Centra", 'TCS');

		$ivqry = delete_dbquery("INSERT INTO APPROVAL_request select ARQCODE,ARQYEAR,(".$maxarqcode1[0]['MAXARQSRNO']."),ATYCODE,ATMCODE,APMCODE,ATCCODE,APPRFOR,REQSTTO,APPRSUB,APPRDET,APPRSFR,APPRSTO,APPATTN,APRQVAL,APPDVAL,APPFVAL,BRNCODE,DEPCODE,TARNUMB,TARBALN,TARDESC,'".$fstusr[0]['EMPSRNO']."','".$fstusr[0]['EMPCODE']." - ".$fstusr[0]['EMPNAME']."','".$fstusr[0]['DESCODE']."','".$fstusr[0]['ESECODE']."','".$fstusrdesignation[0]['DESNAME']."','".$fstusrsection[0]['ESENAME']."','".$fstusr1[0]['EMPSRNO']."','".$fstusr1[0]['EMPCODE']." - ".$fstusr1[0]['EMPNAME']."','".$fstusr1[0]['DESCODE']."','".$fstusr1[0]['ESECODE']."','".$fstusrdesignation1[0]['DESNAME']."','".$fstusrsection1[0]['ESENAME']."',RQESTTO,RQTODES,RQTODSC,RQTOESC,RQTODSN,RQTOESN,APRNUMB,'N','I',APPINTP,10129,INTPDES,INTPDSC,INTPESC,INTPDSN,INTPESN,INTPAPR,INTSUGG,INTPFRD,INTPTOD,'".$fstusr[0]['EMPSRNO']."',ADDDATE,EDTUSER,EDTDATE,DELETED,'".$fstusr[0]['EMPSRNO']."',DELDATE,APRCODE,APRHURS,APRDAYS,APRDUED,'VERIFY THIS APPROVAL',APRTITL,FINSTAT,FINUSER,FINCMNT,FINDATE,TARVLCY,TARVLLY,EXPNAME,TARPRCY,TARPRLY,USRSYIP,PRJPRCS,PLANVAL,IMDUEDT,IMUSRCD,IMSTATS,IMFINDT,IMUSRIP,TYPMODE,SUBCORE,BUDTYPE,BUDCODE,IMFNIMG,NXLVLUS,PRICODE,SUPCODE,SUPNAME,SUPCONT,PRODWIS,RESPUSR,ALTRUSR,RELAPPR,ORGRECV,ORGRVUS,ORGRVDT,ORGRVDC,CNVRMOD,PURHEAD,APPTYPE,ADVAMNT,AGNSAPR,WRKINUSR,ARQPCOD,BDPLANR,DYNSUBJ,TXTSUBJ,RMQUOTS,RMBDAPR,RMCLRPT,RMARTWK,RMCONAR,WARQUAR,CRCLSTK,PAYPERC,FNTARDT,RPTUSER,ACKUSER,ACKSTAT,ACKDATE,AGEXPDT,AGADVAM,DYSBFDT,DYSBTDT, APPICON,RTFNUSR,RMPONUM,AUTFRWD,EXPSRNO,QUOYEAR,HAPNUMB,RQVALUE,AREASON ,EXPYEAR,INVNUMB,INVDATE,ACTMODE from APPROVAL_request where APRNUMB = '".$txt_approval_number."' and ARQSRNO=".$maxarqcode);
	}
	return $ivqry;
}
// Add internal Verification user dynamically FOR BID


// Add internal Verification user dynamically from MD user - Product TEST DB
function add_ivuser_product_test($md_user, $alternate_user, $txt_approval_number, $maxarqcode) {
	$ivqry = 0;
	$sql_akiv = select_query_json("select COUNT(*) CNT from APPROVAL_PRODUCTWISE_BUDGET where aprnumb = '".$txt_approval_number."' and PBDSRNO=".$maxarqcode." AND (REQSTFR = 21344 and REQSTBY <> 168)", "Centra", "TCS");
	if(count($sql_akiv) > 0) {
		$tbl_akiv = "APPROVAL_PRODUCTWISE_BUDGET";
		$field_akiv = array();
		$field_akiv['APPSTAT'] = 'F';
		// print_r($field_akiv);
		$where_akiv = " APRNUMB='".$txt_approval_number."' and PBDSRNO=".$maxarqcode." ";
		$insert_akiv = update_dbquery($field_akiv, $tbl_akiv, $where_akiv);

		// MR. AK Sir User - 21344
		$fstusr = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$md_user, "Centra", "TCS"); // MR. AK Sir User - 21344
		$fstusrdes = "designation"; $fstusrsec = "empsection";
		if($fstusr[0]['PAYCOMPANY'] == 2) {
			$fstusrdes = "new_designation"; $fstusrsec = "new_empsection";
		}
		$fstusrdesignation = select_query_json("Select DESNAME From ".$fstusrdes." where DESCODE = ".$fstusr[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection = select_query_json("Select ESENAME From ".$fstusrsec." where deleted = 'N' and ESECODE = ".$fstusr[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. AK Sir User - 21344

		// MR. NSM Sir User - 168
		$fstusr1 = select_query_json("select * from employee_office emp, employee_salary sal where emp.empsrno = sal.empsrno and emp.empsrno = ".$alternate_user, "Centra", "TCS"); // MR. NSM Sir User - 168
		$fstusrdes1 = "designation"; $fstusrsec1 = "empsection";
		if($fstusr1[0]['PAYCOMPANY'] == 2) {
			$fstusrdes1 = "new_designation"; $fstusrsec1 = "new_empsection";
		}
		$fstusrdesignation1 = select_query_json("Select DESNAME From ".$fstusrdes1." where DESCODE = ".$fstusr1[0]['DESCODE'], "Centra", "TCS"); // Req.forward user designation
		$fstusrsection1 = select_query_json("Select ESENAME From ".$fstusrsec1." where deleted = 'N' and ESECODE = ".$fstusr1[0]['ESECODE'], "Centra", "TCS"); // Req.forward user section
		// MR. NSM Sir User - 168

		/* echo ("INSERT INTO APPROVAL_PRODUCTWISE_BUDGET select PBDYEAR,PBDCODE,ATYCODE,ATMCODE,APMCODE,ATCCODE,APPRDET,BRNCODE,DEPCODE,TARNUMB,APRQVAL,APPFVAL,'".$fstusr[0]['EMPSRNO']."','".$fstusr[0]['EMPCODE']." - ".$fstusr[0]['EMPNAME']."','".$fstusr[0]['DESCODE']."','".$fstusr[0]['ESECODE']."','".$fstusrdesignation[0]['DESNAME']."','".$fstusrsection[0]['ESENAME']."','".$fstusr1[0]['EMPSRNO']."','".$fstusr1[0]['EMPCODE']." - ".$fstusr1[0]['EMPNAME']."','".$fstusr1[0]['DESCODE']."','".$fstusr1[0]['ESECODE']."','".$fstusrdesignation1[0]['DESNAME']."','".$fstusrsection1[0]['ESENAME']."',RQESTTO,RQTODES,RQTODSC,RQTOESC,RQTODSN,RQTOESN,'N','I',APPINTP,'3000000',ADDDATE,EDTUSER,EDTDATE,DELETED,DELUSER,DELDATE,APRCODE,'VERIFY THIS APPROVAL',USRSYIP,SUBCORE,BUDTYPE,BUDCODE,PRICODE,(".$maxarqcode.")+1,FINSTAT,FINUSER,FINCMNT,FINDATE,EXPSRNO,APRNUMB,PREPUSR,INTPEMP,INTPFRD,INTPTOD from APPROVAL_PRODUCTWISE_BUDGET where APRNUMB = '".$txt_approval_number."' and PBDSRNO=".$maxarqcode); */

		$ivqry = delete_dbquery("INSERT INTO APPROVAL_PRODUCTWISE_BUDGET select PBDYEAR,PBDCODE,ATYCODE,ATMCODE,APMCODE,ATCCODE,APPRDET,BRNCODE,DEPCODE,TARNUMB,APRQVAL,APPFVAL,'".$fstusr[0]['EMPSRNO']."','".$fstusr[0]['EMPCODE']." - ".$fstusr[0]['EMPNAME']."','".$fstusr[0]['DESCODE']."','".$fstusr[0]['ESECODE']."','".$fstusrdesignation[0]['DESNAME']."','".$fstusrsection[0]['ESENAME']."','".$fstusr1[0]['EMPSRNO']."','".$fstusr1[0]['EMPCODE']." - ".$fstusr1[0]['EMPNAME']."','".$fstusr1[0]['DESCODE']."','".$fstusr1[0]['ESECODE']."','".$fstusrdesignation1[0]['DESNAME']."','".$fstusrsection1[0]['ESENAME']."',RQESTTO,RQTODES,RQTODSC,RQTOESC,RQTODSN,RQTOESN,'N','I',APPINTP,'3000000',ADDDATE,EDTUSER,EDTDATE,DELETED,DELUSER,DELDATE,APRCODE,'VERIFY THIS PRODUCTWISE BUDGET APPROVAL',USRSYIP,SUBCORE,BUDTYPE,BUDCODE,PRICODE,(".$maxarqcode.")+1,FINSTAT,FINUSER,FINCMNT,FINDATE,EXPSRNO,APRNUMB,PREPUSR,INTPEMP,INTPFRD,INTPTOD,ALTRUSR,RELAPPR,RESPUSR from APPROVAL_PRODUCTWISE_BUDGET where APRNUMB = '".$txt_approval_number."' and PBDSRNO=".$maxarqcode);
	}
	return $ivqry;
}
// Add internal Verification user dynamically from MD user - Product TEST DB

// Avoid image rotate problem in request entry
function image_fix_orientation($filename)
{
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation']))
    {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation'])
        {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
        imagejpeg($image, $filename, 90);
    }
}

// Avoid image rotate problem in request entry

// If we send usercode, it will return the employee branch logo and text - 06-11-2017
function find_employee_branch($user_empcode) {
	$expld2 = explode(" - ", $user_empcode);
	$sql_empbrn = select_query_json("select emp.empcode, emp.empname, brn.brncode, brn.brnname, brn.nicname, regexp_replace(SubStr(nicname,1,4),'[0-9]','')||SubStr(nicname,5,10) branch
											from employee_office emp, branch brn
											where emp.BRNCODE = brn.BRNCODE and emp.empcode in (".$expld2[0].")");
	switch ($sql_empbrn[0]['BRNCODE']) {
		case 201:
		case 202:
		case 205: // KTM
			$brnlogo = "<img src='images/ktm-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		case 203:
		case 204:
		case 206: // STJ
		case 300: // STJ - CORP
			$brnlogo = "<img src='images/stj-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		default: // TCS & CORP
			// $brnlogo = "<span style='font-family: \"freehand471\",\"Helvetica Neue\",Helvetica,Arial; color:#ff0000; font-weight:normal; font-size: 22px;'>The Chennai Silks</span> - ".$sql_empbrn[0]['BRANCH'];
			$brnlogo = "<img src='images/tcs-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;
	}
	return $brnlogo;
}
// If we send usercode, it will return the employee branch logo and text - 06-11-2017

// If we send usercode, it will return the employee branch logo and text - 06-11-2017
function find_branch_logo($brncode) {
	$sql_empbrn = select_query_json("select brn.brncode, brn.brnname, brn.nicname, regexp_replace(SubStr(nicname,1,4),'[0-9]','')||SubStr(nicname,5,10) branch
											from branch brn
											where brn.BRNCODE in (".$brncode.")");
	switch ($sql_empbrn[0]['BRNCODE']) {
		case 201:
		case 202:
		case 205: // KTM
			$brnlogo = "<img src='images/ktm-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		case 203:
		case 204:
		case 206: // STJ
		case 300: // STJ - CORP
			$brnlogo = "<img src='images/stj-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		case 33: // Nachaas
			$brnlogo = "<img src='images/nachaas.jpg' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		default: // TCS & CORP
			// $brnlogo = "<span style='font-family: \"freehand471\",\"Helvetica Neue\",Helvetica,Arial; color:#ff0000; font-weight:normal; font-size: 22px;'>The Chennai Silks</span> - ".$sql_empbrn[0]['BRANCH'];
			$brnlogo = "<img src='images/tcs-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;
	}
	return $brnlogo;
}
// If we send usercode, it will return the employee branch logo and text - 06-11-2017

//for printing the branch code
function print_employee_branch($user_empcode) {


	$expld2 = explode(" - ", $user_empcode);
	$sql_empbrn = select_query_json("select emp.empcode, emp.empname, brn.brncode, brn.brnname, brn.nicname, regexp_replace(SubStr(nicname,1,4),'[0-9]','')||SubStr(nicname,5,10) branch
											from employee_office emp, branch brn
											where emp.BRNCODE = brn.BRNCODE and emp.empcode in (".$expld2[0].")");
	switch ($sql_empbrn[0]['BRNCODE']) {
		case 201:
		case 202:
		case 205: // KTM
			$brnlogo = "<img src='file://172.16.0.49/websites/phpsite/approval-desk/images/ktm-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		case 203:
		case 204:
		case 206: // STJ
			$brnlogo = "<img src='file://172.16.0.49/websites/phpsite/approval-desk/images/stj-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;

		default: // TCS & CORP
			// $brnlogo = "<span style='font-family: \"freehand471\",\"Helvetica Neue\",Helvetica,Arial; color:#ff0000; font-weight:normal; font-size: 22px;'>The Chennai Silks</span> - ".$sql_empbrn[0]['BRANCH'];
			$brnlogo = "<img src='file://172.16.0.49/websites/phpsite/approval-desk/images/tcs-logo.png' border=0 style='max-width:160px; height:auto; vertical-align:middle;' align='middle'><span style='vertical-align:middle'> - ".$sql_empbrn[0]['BRANCH']."</span>";
			break;
	}
	return $brnlogo;
}




// Add Approval Flow user Dynamically
function add_approval_flow_users($userlisting, $aprnumb) {
	$arrcnt = count($userlisting);
	/* $sql_aprno = select_query_json("select * from approval_mdhierarchy
											where aprnumb like '".$aprnumb."' and AMHSRNO >= (select AMHSRNO from approval_mdhierarchy
												where aprnumb like '".$aprnumb."' and APPHEAD = '1118')", 'Centra', 'TCS'); // */

	$sql_aprno = select_query_json("select * from approval_mdhierarchy where aprnumb like '".$aprnumb."' order by AMHSRNO desc", 'Centra', 'TCS');
	$sql_altuser = select_query_json("select EMPSRNO from approval_mdhierarchy mdh, employee_office emp 
											where emp.empcode = mdh.APPHEAD and mdh.aprnumb like '".$aprnumb."' 
											order by mdh.AMHSRNO asc", 'Centra', 'TCS');
	for($ii = 0; $ii < count($sql_aprno); $ii++) { // echo "++".$ii."++";
		$tbl_apprq = "approval_mdhierarchy";
		if($sql_aprno[$ii]['APPHEAD'] == $_SESSION['tcs_user']) {
			$field_apprq['AMHSRNO'] = ($sql_aprno[$ii]['AMHSRNO'] + $arrcnt);
			$where_apprq = "AMHSRNO = '".$sql_aprno[$ii]['AMHSRNO']."' and aprnumb = '".$aprnumb."'";
			// print_r($field_apprq);
			$update_apprq = update_dbquery($field_apprq, $tbl_apprq, $where_apprq);
			// echo "++".$update_apprq."++";
			break;
		} else {
			$field_apprq['AMHSRNO'] = ($sql_aprno[$ii]['AMHSRNO'] + $arrcnt);
			$where_apprq = "AMHSRNO = '".$sql_aprno[$ii]['AMHSRNO']."' and aprnumb = '".$aprnumb."'";
			// print_r($field_apprq);
			$update_apprq = update_dbquery($field_apprq, $tbl_apprq, $where_apprq);
			// echo "++".$update_apprq."++";
		}
	}
	$initial_srno = ($sql_aprno[$ii]['AMHSRNO'] + $arrcnt);

	for($int_i = 0; $int_i < count($userlisting); $int_i++) {
		$initial_srno--;
		$usr_explode2 = explode(" - ", $userlisting[$int_i]);

		$sql_user  = select_query_json("select * from employee_office emp, designation des, empsection ese
												where emp.esecode = ese.esecode and emp.descode = des.descode and ese.deleted = 'N' and des.deleted = 'N' and emp.empcode = ".$usr_explode2[0], 'Centra', 'TCS');

		delete_dbquery("insert into approval_mdhierarchy values ('".$sql_aprno[0]['APMCODE']."', '".$initial_srno."', '".$sql_user[0]['EMPCODE']."', '".$sql_user[0]['DESCODE']."', '1', 'Y', '".$_SESSION['tcs_user']."', '0', '".$aprnumb."', '0')")."<br>";
		// echo "insert into approval_mdhierarchy values ('".$sql_aprno[0]['APMCODE']."', '".$initial_srno."', '".$sql_user[0]['EMPCODE']."', '".$sql_user[0]['DESCODE']."', '1', 'Y', '".$sql_user[0]['DESNAME']."', '0', '".$aprnumb."', '0')";
		$apmlist .= $sql_user[0]['EMPCODE']."~~";


		if($initial_srno == 1) {
			// Only SK Sir
			if($sql_user[0]['EMPCODE'] == 3) {
				delete_dbquery("update APPROVAL_REQUEST set RQESTTO = '21344', RQTODES = '3 -  S KAARTHI', RQTODSC = '194', RQTOESC = '151', RQTODSN = 'DIRECTOR', RQTOESN = '001 OWNER' where aprnumb like '".$aprnumb."' and RQESTTO in (20118, 21344)");
			}
			// Only PS Madam
			if($sql_user[0]['EMPCODE'] == 2) {
				delete_dbquery("update APPROVAL_REQUEST set RQESTTO = '43400', RQTODES = '2 -  PADHMA SIVLINGAM S', RQTODSC = '194', RQTOESC = '151', RQTODSN = 'DIRECTOR', RQTOESN = '001 OWNER' where aprnumb like '".$aprnumb."' and RQESTTO in (21344, 20118)");
			}
			// Only KS Sir
			if($sql_user[0]['EMPCODE'] == 1) {
				delete_dbquery("update APPROVAL_REQUEST set RQESTTO = '20118', RQTODES = '1 -  SIVALINGAM K', RQTODSC = '193', RQTOESC = '151', RQTODSN = 'MANAGING DIRECTOR', RQTOESN = '001 OWNER' where aprnumb like '".$aprnumb."' and RQESTTO in (43400, 21344)");
			} else {
				delete_dbquery("update APPROVAL_REQUEST set RQESTTO = '".$sql_user[0]['EMPSRNO']."', RQTODES = '".$sql_user[0]['EMPCODE']." - ".$sql_user[0]['EMPNAME']."', RQTODSC = '".$sql_user[0]['DESCODE']."', RQTOESC = '".$sql_user[0]['ESECODE']."', RQTODSN = '".$sql_user[0]['DESNAME']."', RQTOESN = '".$sql_user[0]['ESENAME']."' where aprnumb like '".$aprnumb."' and RQESTTO in (".$sql_altuser[0]['EMPSRNO'].")");
				// echo "update APPROVAL_REQUEST set RQESTTO = '".$sql_user[0]['EMPSRNO']."', RQTODES = '".$sql_user[0]['EMPCODE']." - ".$sql_user[0]['EMPNAME']."', RQTODSC = '".$sql_user[0]['DESCODE']."', RQTOESC = '".$sql_user[0]['ESECODE']."', RQTODSN = '".$sql_user[0]['DESNAME']."', RQTOESN = '".$sql_user[0]['ESENAME']."' where aprnumb like '".$aprnumb."' and RQESTTO in (".$sql_altuser[0]['EMPSRNO'].")";
			}
		}
	}

	// echo "==".$apmlist."==";
	return $apmlist;
}
// Add Approval Flow user Dynamically


function find_finiancial_year($cur_month) {
	switch ($cur_month) {
		case 4:
			$list_month = array("MAY, ".date("Y"), "JUN, ".date("Y"), "JUL, ".date("Y"), "AUG, ".date("Y"), "SEP, ".date("Y"), "OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 5:
			$list_month = array("JUN, ".date("Y"), "JUL, ".date("Y"), "AUG, ".date("Y"), "SEP, ".date("Y"), "OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 6:
			$list_month = array("JUL, ".date("Y"), "AUG, ".date("Y"), "SEP, ".date("Y"), "OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 7:
			$list_month = array("AUG, ".date("Y"), "SEP, ".date("Y"), "OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 8:
			$list_month = array("SEP, ".date("Y"), "OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 9:
			$list_month = array("OCT, ".date("Y"), "NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 10:
			$list_month = array("NOV, ".date("Y"), "DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 11:
			$list_month = array("DEC, ".date("Y"), "JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 12:
			$list_month = array("JAN, ".(date("Y")+1), "FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 1:
			$list_month = array("FEB, ".(date("Y")+1), "MAR, ".(date("Y")+1));
			break;

		case 2:
			$list_month = array("MAR, ".(date("Y")+1));
			break;

		case 3:
			$list_month = array('');
			break;
	}
	return $list_month;
}


// Find Quarter from date and time
function date_quarter()
{
    $curMonth = ltrim(date("m", time()), '0');
    switch ($curMonth) {
    	case 1:
    	case 2:
    	case 3:
    		$curQuarter = 4;
    		break;

    	case 4:
    	case 5:
    	case 6:
    		$curQuarter = 1;
    		break;

    	case 7:
    	case 8:
    	case 9:
    		$curQuarter = 2;
    		break;

    	case 10:
    	case 11:
    	case 12:
    		$curQuarter = 3;
    		break;

    	default:
    		$curQuarter = 1;
    		break;
    }
    return $curQuarter;
}
// Find Quarter from date and time

// Display the limit in request listing pages
function list_summary($str, $limit=1000, $strip = false) {
    $str = ($strip == true)?strip_tags($str):$str;
    if (strlen ($str) > $limit) {
        $str = substr ($str, 0, $limit - 3);
        return (substr ($str, 0, strrpos ($str, ' ')).'...');
    }
    return trim($str);
}
// Display the limit in request listing pages

// Get Content details from FTP
function get_content_details($aprnumb) {
	$sql_search = select_query_json("select * from APPROVAL_request where aprnumb = '".$aprnumb."' order by arqsrno desc");
	if($sql_search[0]['APPRFOR'] == '1') {
	    $filepathname = $sql_search[0]['APPRSUB'];
	    $filename = "ftp://".$ftp_user_name_apdsk.":".$ftp_user_pass_apdsk."@".$ftp_server_apdsk.$ftp_srvport_apdsk."/approval_desk/text_approval_source/".$filepathname;
	    $handle = fopen($filename, "r");
	    $contents = fread($handle, filesize($filename));
	    fclose($handle);
	    // echo strip_tags(str_replace("&nbsp;", " ", $contents));
	    return list_summary(strip_tags(str_replace("&nbsp;", " ", $contents)), $limit=1000, $strip = false);
	} else {
	    return $sql_search[0]['APPRDET'];
	}
}
// Get Content details from FTP

// Format from seconds to Days
function formatSeconds( $seconds )
{
	return $days = floor($seconds / (24*60*60));
}
// Format from seconds to Days

// To Generate Multiple Branch approvals from only one approval
function generate_multiple_branch($txt_approval_number, $slt_topcore) {
	$ai = 0;
	echo "Select * From APPROVAL_BRANCH_DETAIL where APRNUMB = '".$txt_approval_number."'";
	$sql_descode=select_query_json("Select * From APPROVAL_BRANCH_DETAIL where APRNUMB = '".$txt_approval_number."'", "Centra", "TEST");
	foreach($sql_descode as $sectionrow) { $ai++;
		$ARQCODE = select_query_json("Select nvl(Max(ARQCODE),0)+1 maxarqcode From APPROVAL_REQUEST","Centra","TEST");
		$current_year = select_query_json("Select Poryear From Codeinc", "Centra", 'TCS');
		$IMUSRIP = select_query_json("Select nvl(Max(ARQCODE),0)+1 maxarqcode, nvl(Max(ARQSRNO),1) maxarqsrno
											From APPROVAL_REQUEST WHERE ARQYEAR = '".$current_year[0]['PORYEAR']."' and ARQSRNO = 1 and ATCCODE = ".$slt_topcore, "Centra", "TEST");
		switch($slt_topcore)
		{
			case 1:
					$startwith = 1;
					break;
			case 2:
					$startwith = 2;
					break;
			case 3:
					$startwith = 3;
					break;
			case 4:
					$startwith = 4;
					break;
			default:
					$startwith = 1;
					break;
		}

		$srno = $startwith.str_pad($IMUSRIP[0]['MAXARQCODE'], 6, '0', STR_PAD_LEFT);
		$f_value = select_query_json("Select IMUSRIP From APPROVAL_REQUEST where APRNUMB = '".$txt_approval_number."'", "Centra", "TEST");
		$vall = explode($f_value[0]['IMUSRIP'], $txt_approval_number);
		// $valll = explode(substr($f_value[0]['IMUSRIP'],-4),$vall[1]);
		// $apprno = "".$vall[0]." ".$srno." ".$valll[0]." ".substr($srno,-4)." ".$valll[1].""; RQTOESN

		$currentdate1 = strtoupper(date('d-m-Y'));
		$currenttime1 = strtoupper(date('h:i A'));

		if($IMUSRIP[0]['MAXARQCODE'] < 10000) {
			$valll = explode(substr($f_value[0]['IMUSRIP'],-4),$vall[1]);
			$apprno = strtoupper($vall[0].$srno.' / '.$currentdate1.' / '.substr($srno, -4).' / '.$currenttime1);
		} else {
			$valll = explode(substr($f_value[0]['IMUSRIP'],-5),$vall[1]);
			$apprno = strtoupper($vall[0].$srno.' / '.$currentdate1.' / '.substr($srno, -5).' / '.$currenttime1);
		}
		/////// Check Approval no-----------------
		
		//  INSERT INTO APPROVAL_REQUEST Table
		$ivqry = delete_test_dbquery("INSERT INTO APPROVAL_REQUEST select '".$ARQCODE[0]['MAXARQCODE']."', ARQYEAR, ARQSRNO, ATYCODE, ATMCODE, APMCODE, ATCCODE, APPRFOR, REQSTTO, APPRSUB, APPRDET, APPRSFR, APPRSTO, APPATTN, '".$sectionrow['APRAMNT']."', '".$sectionrow['APRAMNT']."', '".$sectionrow['APRAMNT']."', '".$sectionrow['BRNCODE']."', DEPCODE, TARNUMB, TARBALN, TARDESC, REQSTBY, RQBYDES, REQDESC, REQESEC, REQDESN, REQESEN, REQSTFR, RQFRDES, RQFRDSC, RQFRESC, RQFRDSN, RQFRESN, RQESTTO, RQTODES, RQTODSC, RQTOESC, RQTODSN, RQTOESN, '".$apprno."', APPSTAT, APPFRWD, APPINTP, INTPEMP, INTPDES, INTPDSC, INTPESC, INTPDSN, INTPESN, INTPAPR, INTSUGG, INTPFRD, INTPTOD, ADDUSER, ADDDATE, EDTUSER, EDTDATE, 'Y', DELUSER, DELDATE, APRCODE, APRHURS, APRDAYS, APRDUED, APPRMRK, APRTITL, FINSTAT, FINUSER, FINCMNT, FINDATE, TARVLCY, TARVLLY, EXPNAME, TARPRCY, TARPRLY, USRSYIP, PRJPRCS, PLANVAL, IMDUEDT, IMUSRCD, IMSTATS, IMFINDT, '".$srno."', TYPMODE, SUBCORE, BUDTYPE, BUDCODE, IMFNIMG, NXLVLUS, PRICODE, SUPCODE, SUPNAME, SUPCONT, PRODWIS, RESPUSR, ALTRUSR, '".$txt_approval_number."', ORGRECV, ORGRVUS, ORGRVDT, ORGRVDC, CNVRMOD, PURHEAD, APPTYPE, ADVAMNT, AGNSAPR, WRKINUSR, '".$srno."', BDPLANR, DYNSUBJ, TXTSUBJ, RMQUOTS, RMBDAPR, RMCLRPT, RMARTWK, RMCONAR, WARQUAR, CRCLSTK, PAYPERC, FNTARDT, RPTUSER, ACKUSER, ACKSTAT, ACKDATE, AGEXPDT, AGADVAM, DYSBFDT, DYSBTDT, APPICON, RTFNUSR, RMPONUM, AUTFRWD, EXPSRNO, QUOYEAR, HAPNUMB from APPROVAL_REQUEST where APRNUMB = '".$txt_approval_number."'");
		echo "<br>INSERT INTO APPROVAL_REQUEST select '".$ARQCODE[0]['MAXARQCODE']."', ARQYEAR, ARQSRNO, ATYCODE, ATMCODE, APMCODE, ATCCODE, APPRFOR, REQSTTO, APPRSUB, APPRDET, APPRSFR, APPRSTO, APPATTN, '".$sectionrow['APRAMNT']."', '".$sectionrow['APRAMNT']."', '".$sectionrow['APRAMNT']."', '".$sectionrow['BRNCODE']."', DEPCODE, TARNUMB, TARBALN, TARDESC, REQSTBY, RQBYDES, REQDESC, REQESEC, REQDESN, REQESEN, REQSTFR, RQFRDES, RQFRDSC, RQFRESC, RQFRDSN, RQFRESN, RQESTTO, RQTODES, RQTODSC, RQTOESC, RQTODSN, RQTOESN, '".$apprno."', APPSTAT, APPFRWD, APPINTP, INTPEMP, INTPDES, INTPDSC, INTPESC, INTPDSN, INTPESN, INTPAPR, INTSUGG, INTPFRD, INTPTOD, ADDUSER, ADDDATE, EDTUSER, EDTDATE, 'Y', DELUSER, DELDATE, APRCODE, APRHURS, APRDAYS, APRDUED, APPRMRK, APRTITL, FINSTAT, FINUSER, FINCMNT, FINDATE, TARVLCY, TARVLLY, EXPNAME, TARPRCY, TARPRLY, USRSYIP, PRJPRCS, PLANVAL, IMDUEDT, IMUSRCD, IMSTATS, IMFINDT, '".$srno."', TYPMODE, SUBCORE, BUDTYPE, BUDCODE, IMFNIMG, NXLVLUS, PRICODE, SUPCODE, SUPNAME, SUPCONT, PRODWIS, RESPUSR, ALTRUSR, '".$txt_approval_number."', ORGRECV, ORGRVUS, ORGRVDT, ORGRVDC, CNVRMOD, PURHEAD, APPTYPE, ADVAMNT, AGNSAPR, WRKINUSR, '".$srno."', BDPLANR, DYNSUBJ, TXTSUBJ, RMQUOTS, RMBDAPR, RMCLRPT, RMARTWK, RMCONAR, WARQUAR, CRCLSTK, PAYPERC, FNTARDT, RPTUSER, ACKUSER, ACKSTAT, ACKDATE, AGEXPDT, AGADVAM, DYSBFDT, DYSBTDT, APPICON, RTFNUSR, RMPONUM, AUTFRWD, EXPSRNO, QUOYEAR, HAPNUMB from APPROVAL_REQUEST where APRNUMB = '".$txt_approval_number."'";

		$budget_planner_temp = select_query_json("Select nvl(Max(APRSRNO),0)+1 MXAPRSRNO From approval_budget_planner_temp WHERE APRNUMB = '".$apprno."' ", "Centra", 'TEST');
		$budget_val = select_query_json("Select RESVALU, EXTVALU From approval_budget_planner_temp WHERE APRNUMB = '".$txt_approval_number."' ", "Centra", 'TEST');

		if($budget_val[0]['RESVALU'] == '0'){
			$RESVALU = 0;
		} else {
			$RESVALU = $sectionrow['APRAMNT'];
		}

		if($budget_val[0]['EXTVALU'] == '0'){
			$EXTVALU = 0;
		} else {
			$EXTVALU = $sectionrow['APRAMNT'];
		}

		if($ai == 1) {
			echo "<br>INSERT INTO approval_budget_planner_temp select '".$apprno."' , '".$budget_planner_temp[0]['MXAPRSRNO']."', APRPRID, APRMNTH, '".$sectionrow['APRAMNT']."', APPMNTH, APPYEAR, TARNUMB, '".$RESVALU."', '".$EXTVALU."', BUDMODE, APRYEAR, ADDUSER, ADDDATE, EDTUSER, EDTDATE, DELETED, DELUSER, DELDATE, '".$sectionrow['BRNCODE']."', APPMODE, EXPSRNO, EXISTVL, USEDVAL, ACCVRFY, TMTARNO, ATYCODE, PHDCODE, PGRCODE, ESECODE, DEPCODE, PRJCODE, XTRAVAL from approval_budget_planner_temp where APRNUMB = '".$txt_approval_number."'";
			$ivqry = delete_test_dbquery("INSERT INTO approval_budget_planner_temp select '".$apprno."' , '".$budget_planner_temp[0]['MXAPRSRNO']."', APRPRID, APRMNTH, '".$sectionrow['APRAMNT']."', APPMNTH, APPYEAR, TARNUMB, '".$RESVALU."', '".$EXTVALU."', BUDMODE, APRYEAR, ADDUSER, ADDDATE, EDTUSER, EDTDATE, DELETED, DELUSER, DELDATE, '".$sectionrow['BRNCODE']."', APPMODE, EXPSRNO, EXISTVL, USEDVAL, ACCVRFY, TMTARNO, ATYCODE, PHDCODE, PGRCODE, ESECODE, DEPCODE, PRJCODE, XTRAVAL from approval_budget_planner_temp where APRNUMB = '".$txt_approval_number."'");

			/*//** $ivqry = delete_test_dbquery("INSERT INTO approval_budget_planner select '".$apprno."' , '".$budget_planner_temp[0]['MXAPRSRNO']."', APRPRID, APRMNTH, '".$sectionrow['APRAMNT']."', APPMNTH, APPYEAR, TARNUMB, '".$RESVALU."', '".$EXTVALU."', BUDMODE, APRYEAR, ADDUSER, ADDDATE, EDTUSER, EDTDATE, DELETED, DELUSER, DELDATE, '".$sectionrow['BRNCODE']."', 'N', EXPSRNO, EXISTVL, USEDVAL, DEPCODE, PRJCODE, XTRAVAL from approval_budget_planner_temp where APRNUMB = '".$txt_approval_number."'");
			$ivqry = delete_test_dbquery("update approval_budget_planner set APPMODE = 'Y' where APRNUMB = '".$apprno."'"); */

			$amrsrno = 0;
			$sql_descode_approval_mdhierarchy=select_query_json("Select * From approval_mdhierarchy where APRNUMB = '".$txt_approval_number."'", "Centra", "TEST");
			foreach($sql_descode_approval_mdhierarchy as $sectionrow) {
				$amrsrno++;
				$ivqry = delete_test_dbquery("INSERT INTO approval_mdhierarchy select APMCODE, AMHSRNO, APPHEAD, APPDESG, APPDAYS, APPRIOR, APPTITL, VRFYREQ, '".$apprno."', PBDAPPR from approval_mdhierarchy where APRNUMB = '".$apprno."'");
			}
		}
	}
}

function generate_multiple_branch_finish_process($txt_approval_number, $slt_topcore) {
	$ai = 0;
	$sql_descode = select_query_json("SELECT * from approval_request where RELAPPR = '".$txt_approval_number."' order by APRNUMB", "Centra", "TEST");
	foreach($sql_descode as $sectionrow) { $ai++;
		$sql_current_approval = select_query_json("SELECT * from approval_request where APRNUMB = '".$sectionrow['APRNUMB']."' and deleted = 'Y'", "Centra", "TEST");
		//  INSERT INTO APPROVAL_REQUEST Table
		$ivqry = delete_test_dbquery("INSERT INTO APPROVAL_REQUEST select '".$sql_current_approval[0]['ARQCODE']."', ARQYEAR, ARQSRNO, ATYCODE, ATMCODE, APMCODE, ATCCODE, APPRFOR, REQSTTO, APPRSUB, APPRDET, APPRSFR, APPRSTO, APPATTN, '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['BRNCODE']."', DEPCODE, TARNUMB, TARBALN, TARDESC, REQSTBY, RQBYDES, REQDESC, REQESEC, REQDESN, REQESEN, REQSTFR, RQFRDES, RQFRDSC, RQFRESC, RQFRDSN, RQFRESN, RQESTTO, RQTODES, RQTODSC, RQTOESC, RQTODSN, RQTOESN, '".$sectionrow['APRNUMB']."', APPSTAT, APPFRWD, APPINTP, INTPEMP, INTPDES, INTPDSC, INTPESC, INTPDSN, INTPESN, INTPAPR, INTSUGG, INTPFRD, INTPTOD, ADDUSER, ADDDATE, EDTUSER, EDTDATE, 'Y', DELUSER, DELDATE, APRCODE, APRHURS, APRDAYS, APRDUED, APPRMRK, APRTITL, FINSTAT, FINUSER, FINCMNT, FINDATE, TARVLCY, TARVLLY, EXPNAME, TARPRCY, TARPRLY, USRSYIP, PRJPRCS, PLANVAL, IMDUEDT, IMUSRCD, IMSTATS, IMFINDT, '".$sql_current_approval[0]['IMUSRIP']."', TYPMODE, SUBCORE, BUDTYPE, BUDCODE, IMFNIMG, NXLVLUS, PRICODE, SUPCODE, SUPNAME, SUPCONT, PRODWIS, RESPUSR, ALTRUSR, '".$txt_approval_number."', ORGRECV, ORGRVUS, ORGRVDT, ORGRVDC, CNVRMOD, PURHEAD, APPTYPE, ADVAMNT, AGNSAPR, WRKINUSR, '".$sql_current_approval[0]['ARQPCOD']."', BDPLANR, DYNSUBJ, TXTSUBJ, RMQUOTS, RMBDAPR, RMCLRPT, RMARTWK, RMCONAR, WARQUAR, CRCLSTK, PAYPERC, FNTARDT, RPTUSER, ACKUSER, ACKSTAT, ACKDATE, AGEXPDT, AGADVAM, DYSBFDT, DYSBTDT, APPICON, RTFNUSR, RMPONUM, AUTFRWD, EXPSRNO, QUOYEAR, HAPNUMB from APPROVAL_REQUEST where APRNUMB = '".$txt_approval_number."'");

		echo "<br>INSERT INTO APPROVAL_REQUEST select '".$sql_current_approval[0]['ARQCODE']."', ARQYEAR, ARQSRNO, ATYCODE, ATMCODE, APMCODE, ATCCODE, APPRFOR, REQSTTO, APPRSUB, APPRDET, APPRSFR, APPRSTO, APPATTN, '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['APPFVAL']."', '".$sql_current_approval[0]['BRNCODE']."', DEPCODE, TARNUMB, TARBALN, TARDESC, REQSTBY, RQBYDES, REQDESC, REQESEC, REQDESN, REQESEN, REQSTFR, RQFRDES, RQFRDSC, RQFRESC, RQFRDSN, RQFRESN, RQESTTO, RQTODES, RQTODSC, RQTOESC, RQTODSN, RQTOESN, '".$sectionrow['APRNUMB']."', APPSTAT, APPFRWD, APPINTP, INTPEMP, INTPDES, INTPDSC, INTPESC, INTPDSN, INTPESN, INTPAPR, INTSUGG, INTPFRD, INTPTOD, ADDUSER, ADDDATE, EDTUSER, EDTDATE, 'Y', DELUSER, DELDATE, APRCODE, APRHURS, APRDAYS, APRDUED, APPRMRK, APRTITL, FINSTAT, FINUSER, FINCMNT, FINDATE, TARVLCY, TARVLLY, EXPNAME, TARPRCY, TARPRLY, USRSYIP, PRJPRCS, PLANVAL, IMDUEDT, IMUSRCD, IMSTATS, IMFINDT, '".$sql_current_approval[0]['IMUSRIP']."', TYPMODE, SUBCORE, BUDTYPE, BUDCODE, IMFNIMG, NXLVLUS, PRICODE, SUPCODE, SUPNAME, SUPCONT, PRODWIS, RESPUSR, ALTRUSR, '".$txt_approval_number."', ORGRECV, ORGRVUS, ORGRVDT, ORGRVDC, CNVRMOD, PURHEAD, APPTYPE, ADVAMNT, AGNSAPR, WRKINUSR, '".$sql_current_approval[0]['ARQPCOD']."', BDPLANR, DYNSUBJ, TXTSUBJ, RMQUOTS, RMBDAPR, RMCLRPT, RMARTWK, RMCONAR, WARQUAR, CRCLSTK, PAYPERC, FNTARDT, RPTUSER, ACKUSER, ACKSTAT, ACKDATE, AGEXPDT, AGADVAM, DYSBFDT, DYSBTDT, APPICON, RTFNUSR, RMPONUM, AUTFRWD, EXPSRNO, QUOYEAR, HAPNUMB from APPROVAL_REQUEST where APRNUMB = '".$txt_approval_number."'";

		$budget_planner_temp = select_query_json("Select nvl(Max(APRSRNO),0)+1 MXAPRSRNO From approval_budget_planner_temp WHERE APRNUMB = '".$apprno."' ", "Centra", 'TEST');
		$budget_val = select_query_json("Select RESVALU, EXTVALU From approval_budget_planner_temp WHERE APRNUMB = '".$txt_approval_number."' ", "Centra", 'TEST');

		if($budget_val[0]['RESVALU'] == '0'){
			$RESVALU = 0;
		} else {
			$RESVALU = $sectionrow['APRAMNT'];
		}

		if($budget_val[0]['EXTVALU'] == '0'){
			$EXTVALU = 0;
		} else {
			$EXTVALU = $sectionrow['APRAMNT'];
		}

		if($ai == 1) {
			$ivqry = delete_test_dbquery("INSERT INTO approval_budget_planner select '".$apprno."' , '".$budget_planner_temp[0]['MXAPRSRNO']."', APRPRID, APRMNTH, '".$sectionrow['APRAMNT']."', APPMNTH, APPYEAR, TARNUMB, '".$RESVALU."', '".$EXTVALU."', BUDMODE, APRYEAR, ADDUSER, ADDDATE, EDTUSER, EDTDATE, DELETED, DELUSER, DELDATE, '".$sectionrow['BRNCODE']."', 'N', EXPSRNO, EXISTVL, USEDVAL, DEPCODE, PRJCODE, XTRAVAL from approval_budget_planner_temp where APRNUMB = '".$txt_approval_number."'");
			$ivqry = delete_test_dbquery("update approval_budget_planner_temp set deleted = 'Y' where APRNUMB = '".$apprno."'"); 
			$ivqry = delete_test_dbquery("update approval_budget_planner set APPMODE = 'Y' where APRNUMB = '".$apprno."'"); 

			$amrsrno = 0;
			$sql_descode_approval_mdhierarchy=select_query_json("Select * From approval_mdhierarchy where APRNUMB = '".$txt_approval_number."'", "Centra", "TEST");
			foreach($sql_descode_approval_mdhierarchy as $sectionrow) {
				$amrsrno++;
				$ivqry = delete_test_dbquery("INSERT INTO approval_mdhierarchy select APMCODE, AMHSRNO, APPHEAD, APPDESG, APPDAYS, APPRIOR, APPTITL, VRFYREQ, '".$apprno."', PBDAPPR from approval_mdhierarchy where APRNUMB = '".$apprno."'");
			}
		}
	}
}

// To Generate Multiple Branch approvals from only one approval


// To Fix the Subject
function approved_subject_create_new_list($txt_approval_number) {
	$currentdate = strtoupper(date('d-M-Y h:i:s A'));
	$sql_descode = select_query_json("Select distinct ATYCODE , TARNUMB , APMNAME , TOPCORE , SUBCORE , ENTSRNO FROM approval_subject_add where APRNUMB = '".$txt_approval_number."'", "Centra", "TCS");
	//$s_no = 0;
	foreach($sql_descode as $sectionrow) {
		$txt_apmcode = select_query_json("Select nvl(Max(APMCODE),0)+1 maxarqcode From approval_master", "Centra", "TCS");
			$ivqry = delete_dbquery("INSERT INTO approval_master select distinct '".$txt_apmcode[0]['MAXARQCODE']."', ATYCODE, '1', APMNAME, '1', '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N',  '', '', TARNUMB, SUBCORE, TOPCORE from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and ENTSRNO = '".$sectionrow['ENTSRNO']."'");

		if ($sectionrow['ATYCODE'] != '1') {
			$sql_descode_1 = select_query_json("Select * FROM approval_subject_add where APRNUMB = '".$txt_approval_number."' AND ENTSRNO = '".$sectionrow['ENTSRNO']."' ORDER BY BRNHDSR", "Centra", "TCS");
			$BRNHDCD = select_query_json("Select nvl(Max(BRNHDCD),0)+1 maxarqcode From approval_branch_head", "Centra", "TCS"); // subject group

			foreach($sql_descode_1 as $sectionrow_new) {
				if ($sectionrow_new['TARNUMB'] == '0') {
					$apm_code = $txt_apmcode[0]['MAXARQCODE'];
					$apm_value = '0';
					$apm_tarnumb = '0';
					$apm_depcode = '0';
				}else {
					$apm_code = '0';
					$apm_value = '1000000000';
					$apm_tarnumb = $sectionrow_new['EMPNAME'];
					$apm_depcode = $sectionrow_new['SUBCORE'];
				}
				$ivqrya = delete_dbquery("INSERT INTO approval_branch_head select '".$BRNHDCD[0]['MAXARQCODE']."', BRNCODE, EMPSRNO, EMPCODE, EMPNAME, '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N', '' , '' , '".$sectionrow_new['BRNHDSR']."', '".$apm_depcode."', '".$apm_tarnumb."', '".$apm_value."', '".$apm_code."', '' from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and BRNHDSR = '".$sectionrow_new['BRNHDSR']."'");
			}

		}
	}
}
// To Fix the Subject

function approved_create_new_list($txt_approval_number) {
	$currentdate = strtoupper(date('d-M-Y h:i:s A'));
	$sql_descode = select_query_json("Select distinct ATYCODE , TARNUMB , APMNAME , TOPCORE , SUBCORE , ENTSRNO FROM approval_subject_add where APRNUMB = '".$txt_approval_number."'", "Centra", "TCS");
	$s_no = 0;
	foreach($sql_descode as $sectionrow) {
		$txt_apmcode = select_query_json("Select nvl(Max(APMCODE),0)+1 maxarqcode From approval_master", "Centra", "TCS");
		// echo "<br>";
		// echo "INSERT INTO approval_master select distinct '".$txt_apmcode[0]['MAXARQCODE']."', ATYCODE, '1', APMNAME, '1', '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N',  '', '', TARNUMB, SUBCORE, TOPCORE from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and ENTSRNO = '".$sectionrow['ENTSRNO']."'";
		//echo "<br>";
		$ivqry = delete_dbquery("INSERT INTO approval_master select distinct '".$txt_apmcode[0]['MAXARQCODE']."', ATYCODE, '1', APMNAME, '1', '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N',  '', '', TARNUMB, SUBCORE, TOPCORE from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and ENTSRNO = '".$sectionrow['ENTSRNO']."'");

		if ($sectionrow['ATYCODE'] != '1') {
			/*
			if ($sectionrow_new['TARNUMB'] == '0') {
				$apm_code = $txt_apmcode[0]['MAXARQCODE'];
				$apm_value = '0';
				$apm_tarnumb = '0';
				$apm_depcode = '0';
			}else {
				$apm_code = '0';
				$apm_value = '1000000000';
				$apm_tarnumb = $sectionrow_new['EMPNAME'];
				$apm_depcode = $sectionrow_new['SUBCORE'];
			}
			$BRNHDCD = select_query_json("Select nvl(Max(BRNHDCD),0)+1 maxarqcode From approval_branch_head", "Centra", "TCS"); // subject group

			 echo "<br>";
			 echo "INSERT INTO approval_branch_head select '".$BRNHDCD[0]['MAXARQCODE']."', BRNCODE, EMPSRNO, EMPCODE, EMPNAME, '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N', '' , '' , '".$sectionrow_new['BRNHDSR']."', '".$apm_depcode."', '".$apm_tarnumb."', '".$apm_value."', '".$apm_code."', HDORDNO from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and BRNHDSR = '".$sectionrow_new['BRNHDSR']."'";
			*/

			$sql_descode_1 = select_query_json("Select * FROM approval_subject_add where APRNUMB = '".$txt_approval_number."' AND ENTSRNO = '".$sectionrow['ENTSRNO']."' ORDER BY BRNHDSR", "Centra", "TCS");
			$BRNHDCD = select_query_json("Select nvl(Max(BRNHDCD),0)+1 maxarqcode From approval_branch_head", "Centra", "TCS"); // subject group
			foreach($sql_descode_1 as $sectionrow_new) {
				if ($sectionrow_new['TARNUMB'] == '0') {
					$apm_code = $txt_apmcode[0]['MAXARQCODE'];
					$apm_value = '0';
					$apm_tarnumb = '0';
					$apm_depcode = '0';
				}else {
					$apm_code = '0';
					$apm_value = '1000000000';
					$apm_tarnumb = $sectionrow_new['EMPNAME'];
					$apm_depcode = $sectionrow_new['SUBCORE'];
				}
				 // echo "<br>";
				 // echo "INSERT INTO approval_branch_head select '".$BRNHDCD[0]['MAXARQCODE']."', BRNCODE, EMPSRNO, EMPCODE, EMPNAME, '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N', '' , '' , '".$sectionrow_new['BRNHDSR']."', '".$apm_depcode."', '".$apm_tarnumb."', '".$apm_value."', '".$apm_code."' from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and BRNHDSR = '".$sectionrow_new['BRNHDSR']."'";
				
				$ivqrya = delete_dbquery("INSERT INTO approval_branch_head select '".$BRNHDCD[0]['MAXARQCODE']."', BRNCODE, EMPSRNO, EMPCODE, EMPNAME, '".$_SESSION['tcs_usrcode']."', sysdate , '', '', 'N', '' , '' , '".$sectionrow_new['BRNHDSR']."', '".$apm_depcode."', '".$apm_tarnumb."', '".$apm_value."', '".$apm_code."', '' from approval_subject_add where APRNUMB = '".$txt_approval_number."' and ATYCODE = '".$sectionrow['ATYCODE']."' and BRNHDSR = '".$sectionrow_new['BRNHDSR']."'");
			}

		}
	}
}

// To Find the End Date (Based on 10 AM to 7 PM)
function find_end_date($start_dt, $duration) {
	// $int=1;
	// $start_date=date_create("21-Oct-2018 12:01:00 PM");
	// $end_date=date_create("21-Oct-2018 12:01:00 PM");//initialize
	// $start_init_next=date_create("21-Oct-2018 12:01:00 PM");

	$start_date=date_create($start_dt);
	$end_date=date_create($start_dt);//initialize
	$start_init_next=date_create($start_dt);
	$interval=date_interval_create_from_date_string($duration.' hour');

	/////////////////////
	$difference=$interval;
	$start_init=date_format($start_date,"d-M-Y");
	$start_init_next=date_add($start_init_next,date_interval_create_from_date_string('1 day'));
	$start_init_next=date_format($start_init_next,"d-M-Y");
	if(($start_date>date_create($start_init." 7:00:00 PM") && $start_date<date_create($start_init_next." 10:00:00 AM")) )
	{
	    $start_date=date_create($start_init_next." 10:00:00 AM");
	    $end_date=date_create($start_init_next." 10:00:00 AM");
	}
	elseif($start_date<date_create($start_init." 10:00:00 AM"))
	{
	    $start_date=date_create($start_init." 10:00:00 AM");
	    $end_date=date_create($start_init." 10:00:00 AM"); 
	}

	$flag=0; $i=0;
	while($flag==0)
	{
	    $i++;
		$cur_start_date=$end_date;
		$cur_start_date=date_format($cur_start_date,"d-M-Y");
		date_add($end_date,$difference);

		$dummy=date_create($cur_start_date." 7:00:00 PM");

		if($end_date<$dummy)
		{
		    $flag=1;
		}
		else
		{   
		    $end_cur_date=date_format($end_date,"d-M-Y");

		    if(strtotime($end_cur_date) == strtotime($cur_start_date)){
		       $diff=date_diff($end_date,date_create($end_cur_date." 7:00:00 PM"));
		    }
		    else{
		        
		         $diff=date_diff(date_create($cur_start_date." 7:00:00 PM"),$end_date);
		    }
		    
		    $difference=date_interval_create_from_date_string($diff->d.' day '.$diff->h.' hour '.$diff->i.' minutes '.$diff->s.' seconds');
		   
		    if(strtotime($end_cur_date) == strtotime($cur_start_date))
		    {
		       $end_date=date_add($end_date,date_interval_create_from_date_string('1 day'));   
		    }
		    $end_cur_date=date_format($end_date,"d-M-Y");
		    $end_date=date_create($end_cur_date." 10:00:00 AM");
		}

		if($i==10)
		{
		    exit();
		}
	}

	// echo "start date => ".date_format($start_date,"d-M-Y h:i:s A")."<br>end date => ".date_format($end_date,"d-M-Y h:i:s A")."\n";
	return strtoupper(date_format($end_date,"d-M-Y h:i:s A"));
}
// To Find the End Date (Based on 10 AM to 7 PM)


// Function for Delete the against approval nos PO No
function func_delete_against_approvalno($txt_approval_number, $txt_against_approval, $slt_budgetmode) {
	$currentdate = strtoupper(date('d-M-Y h:i:s A'));
	// To Delete the PO from budget_planner_summary
	$bps_table="budget_planner_summary";
    $bps_fld=array();
    $bps_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
    $bps_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
    $bps_fld['DELETED'] = 'Y';
    $where_bps = "APPNUMB = '".$txt_against_approval."' and DELETED = 'N'";
    $insert_bps = update_dbquery($bps_fld, $bps_table, $where_bps);
    // To Delete the PO from budget_planner_summary

    if($txt_against_approval != '-' and $txt_against_approval != '0') {
	    // To Delete the PO from non_ord_summary
		$nos_table="non_ord_summary";
	    $nos_fld=array();
	    $nos_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
	    $nos_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
	    $nos_fld['DELETED'] = 'Y';
	    $where_nos = "APPNUMB = '".$txt_against_approval."' and DELETED = 'N'";
	    $insert_nos = update_dbquery($nos_fld, $nos_table, $where_nos);
	    // To Delete the PO from non_ord_summary

	    // To Delete the PO from non_req_summary
		$nrs_table="non_req_summary";
	    $nrs_fld=array();
	    $nrs_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
	    $nrs_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
	    $nrs_fld['DELETED'] = 'Y';
	    $where_nrs = "APPNUMB = '".$txt_against_approval."' and DELETED = 'N'";
	    $insert_nrs = update_dbquery($nrs_fld, $nrs_table, $where_nrs);
	    // To Delete the PO from non_req_summary
	}



    // To Delete the PO from approval_budget_planner_temp
	$nrs_table="approval_budget_planner_temp";
    $nrs_fld=array();
    $nrs_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
    $nrs_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
    $nrs_fld['DELETED'] = 'Y';
    $where_nrs = "APRNUMB = '".$txt_against_approval."' and DELETED = 'N'";
    $insert_nrs = update_dbquery($nrs_fld, $nrs_table, $where_nrs);
    // To Delete the PO from approval_budget_planner_temp

    // To Delete the PO from approval_budget_planner
	$nrs_table="approval_budget_planner";
    $nrs_fld=array();
    $nrs_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
    $nrs_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
    $nrs_fld['DELETED'] = 'Y';
    $where_nrs = "APRNUMB = '".$txt_against_approval."' and DELETED = 'N'";
    $insert_nrs = update_dbquery($nrs_fld, $nrs_table, $where_nrs);
    // To Delete the PO from approval_budget_planner
    

    if($slt_budgetmode == 2) { // Self Cheque
	    // To Delete the PO from self_cheque_req_summary
		$srs_table="self_cheque_req_summary";
	    $srs_fld=array();
	    $srs_fld['DELUSER'] = $_SESSION['tcs_usrcode'];
	    $srs_fld['DELDATE'] = 'dd-Mon-yyyy HH:MI:SS AM~~'.$currentdate;    
	    $srs_fld['DELETED'] = 'Y';
	    $where_srs = "APPNUMB = '".$txt_against_approval."' and DELETED = 'N'";
	    $insert_srs = update_dbquery($srs_fld, $srs_table, $where_srs);
	    // To Delete the PO from self_cheque_req_summary
	}

    if($insert_bps == 1 and $insert_nos == 1 and $insert_nrs == 1) {
    	return 1;
    } else {
    	return 0;
    }
}
// Function for Delete the against approval nos PO No

// Function for Group by Key value in PHP Array
function group_by($key, $data) {
    $cmnt_att_arqsrno = array();
	foreach ($data as $docs_element) {
	    $cmnt_att_arqsrno[$docs_element[$key]][] = $docs_element;
	}
    return $cmnt_att_arqsrno;
}
// Function for Group by Key value in PHP Array

// To Generate Link from # hashtag
function remarks_split($aprnumb, $remarks) {
    preg_match_all("/(#[0-9]+)/", $remarks, $matches);
    $cnt_sql_remarks = count($matches[0]);
    $expl_url = explode("#",$_SERVER['REQUEST_URI']);

    for ($cnti = 0; $cnti < $cnt_sql_remarks; $cnti++) { 
        $matches_id = str_replace('#', '', $matches[0][$cnti]);
        $matches_ids[] = str_replace('#', '', $matches[0][$cnti]);
        $sql_remarks = select_query_json("select APRDOCS from approval_request_docs 
                                                    where aprnumb = '".$aprnumb."' and apdcsrn = '".$matches_id."'", 'Centra', 'TCS');
        $data_update[] = "<a href='".$expl_url[0]."|".$sql_remarks[0]['APRDOCS']."' style='color: #ff0000; font-size:16px; font-weight:bold;' title='Refer : ".$matches_id."'><i class='fa fa-paperclip fa-5 fa-rotate-90'></i> ".$matches_id."</a>";
    }


    // print_r( $matches[0] );
    //** print_r( $matches_ids );
    // rint_r( $data_update );
    $url_tag = str_replace($matches[0], $data_update, $remarks);
    echo $final_url = str_replace("|", "#", $url_tag);
    /* $exp_remarks = explode("#", $remarks);
    $cnt_sql_remarks = count($exp_remarks);

    $sql_repl = '';
    for ($cnti = 0; $cnti <= $cnt_sql_remarks; $cnti++) { 
        if($exp_remarks[$cnti] != 0) {
            $sql_remarks = select_query_json("select APRDOCS from approval_request_docs where aprnumb = '".$aprnumb."' and apdcsrn = '".$exp_remarks[$cnti]."'", 'Centra', 'TCS');
            $data_update = "<a href='#".$sql_remarks[0]['APRDOCS']."' style='color: #ff0000; font-size:16px; font-weight:bold;' title='Refer : ".$exp_remarks[$cnti]."'><i class='fa fa-paperclip fa-5 fa-rotate-90'></i> ".$exp_remarks[$cnti]."</a>";
            // $sql_repl .= str_replace("#".$exp_remarks[$cnti], $data_update, $remarks);
            $sql_repl .= preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', $data_update, $remarks);
        }
    } */
    // echo "<br>".$sql_repl;
} 
// To Generate Link from # hashtag
?>