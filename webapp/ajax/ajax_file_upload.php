<?php
include_once('../lib/config.php');
include_once('../lib/function_connect.php');
include_once('../lib/general_functions.php');
extract($_REQUEST);
try {
	// connect and login to FTP server
	 $ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022)  or die('Could not connect to ftpvri_server_apdsk');
	 $login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
}
catch(Exception $e) { //catch exception
  echo 'Error Message: ' .$e->getMessage();
}
  function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
function file_upload_to_server($files,$local_path,$server_path,$special_string,$ftp_conn1,$login1,$ftp_address)
    {
	    
		$assign4 = $files['name'];
		//Initialize file upload
		if(!is_dir($local_path)){
			return 'Local Directory Not Found';
		}
		$total_size=0;
		for($i4=0; $i4<count($assign4); $i4++)
		{
			$total_size += $files['size'][$i4];
		}	
		if($total_size > 3200000){
			return 'File Size Exist Maximum';
		}	
			//print_r($assign4);			
	
				for($i4=0; $i4<count($assign4); $i4++)
				{
					if($assign4[$i4] != '')
					{
						$lstapri = '-'; $complogos9 = '-';
						if($files['type'][$i4] == "image/jpeg" or $files['type'][$i4] == "image/gif" or $files['type'][$i4] == "image/png" or $files['type'][$i4] == "application/pdf") {
							$lstapri = find_indicator( $files['type'][$i4] );

							$imgfile9 = $files['tmp_name'][$i4];
							if($lstapri == 'i')
							{
								$info = getimagesize($imgfile9);
								$image9 = imagecreatefromjpeg($imgfile9);
								if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($imgfile9);
								elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($imgfile9);
								elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($imgfile9);
								// save it
								imagejpeg($image, $imgfile9, 20);
							}

							switch($files['type'][$i4]) {
								case 'image/jpeg':
								case 'image/jpg':
								case 'image/gif':
								case 'image/png':
										$extn4 = 'jpg';
										break;
								case 'application/pdf':
										$extn4 = 'pdf';
										break;
							}

							$expl = explode(".", $files['name'][$i4]);
							$upload_img9 = $lstapri."_".time()."_".$i4.".".$extn4;
							$source9 = $imgfile9;
							$complogos9 = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $upload_img9); //str_replace(" ", "_", $upload_img2));
							$complogos9 = str_replace(" ", "-", $upload_img9);
							$complogos9 = strtolower($complogos9);

							//// Thumb start
							if($lstapri == 'i')
							{
								$upload_img9_tmp = $lstapri."_".time()."_".$i4.".jpg";
								$source9_tmp = $imgfile9;
								$complogos9_tmp = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $upload_img9_tmp); //str_replace(" ", "_", $upload_img1));
								$complogos9_tmp = str_replace(" ", "-", $upload_img9_tmp);
								$complogos9_tmp = strtolower($complogos9_tmp);

								$width = $info[0];
								$height = $info[1];
								$newwidth1=200;
								$newheight1=200;
								$tmp1=imagecreatetruecolor($newwidth1, $newheight1);
								imagecopyresampled($tmp1,$image9,0,0,0,0,$newwidth1,$newheight1,$width,$height);

								$resized_file = "../uploaded_files/". $complogos9_tmp;
								$dest_thumbfile = $server_path."/thumb_images/".$complogos9_tmp;
								imagejpeg($tmp1, $resized_file, 50);
								imagedestroy($image9);
								imagedestroy($tmp1);
								//echo "^^^".$complogos9_tmp.'<br>';
								move_uploaded_file($source9_tmp, $dest_thumbfile);
								$local_resized_file = "../uploaded_files/".$complogos9_tmp;
								$server_file = $server_path.'thumb_images/'.$complogos9_tmp;

								if ($ftp_conn1 ) {
									// turn passive mode on
									ftp_pasv($ftp_conn1, true);	
									$upload = ftp_put($ftp_conn1, $server_file, $local_resized_file, FTP_BINARY);
									//echo "tmp Succes".$upload ;
									unlink($local_resized_file);
								}
							}
							//// Thumb end							
							$original_complogos1 = $local_path.$complogos9;
							//echo '!!!'.$complogos9.'<br>';
							move_uploaded_file($source9, $original_complogos1);

							// Upload into FTP
							 $local_file = $original_complogos1;							
							 $server_file = $server_path.$complogos9;
						

							if ($ftp_conn1) {
								// turn passive mode on
								ftp_pasv($ftp_conn, true);								
								$upload = ftp_put($ftp_conn1, $server_file, $local_file, FTP_BINARY);							
								unlink($local_file);
							}
							if ($upload) {
								$tr= "File Uploaded";
							}else{
								$tr= "File Not Uploaded";
							}
							ftp_close($ftp_conn1);
							// Upload into FTP
						}
					}
				}
				
				return $tr;
								
    }
if($action=="Save"){
		//print_r($_REQUEST);
	
		if($_FILES['formFileMultiple']['name'][0] != '') {
			$assign4=$_FILES['formFileMultiple']['name'];
			$noofattachment = count($_FILES['formFileMultiple']['name']);
		}
		$local_file1 = "../uploads/file_upload/";
		$server_file = 'approval_desk/Bid/file_upload/';
		$file_up_status = file_upload_to_server($_FILES['formFileMultiple'],$local_file1,$server_file,'dummay',$ftp_conn,$login,ftpvri_server_apdsk);
		
		var_dump($file_up_status);
}

?>