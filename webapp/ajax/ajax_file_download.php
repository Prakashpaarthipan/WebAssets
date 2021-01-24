<?php
include_once('../lib/config.php');
include_once('../lib/function_connect.php');
include_once('../lib/general_functions.php');
try {
	// connect and login to FTP server
	 $ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022)  or die('Could not connect to ftpvri_server_apdsk');
	 $login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
}
catch(Exception $e) { //catch exception
  echo 'Error Message: ' .$e->getMessage();
}
/* header("Content-Type: application/force-download");
					header("Content-Type: application/octet-stream");
					header("Content-Type: application/download"); */
if($action == 'downloadMultiple'){
	// File Download Can not make using Ajax Request. Use Same page Post request					
			
			$tmpFolder = time();
			
			$local_file = "../uploads/";
			if(!is_dir($local_file.$tmpFolder)){
				mkdir($local_file.$tmpFolder,0777,true);
			}			
			if(extension_loaded('zip')){
				$zip = new ZipArchive();
			}else{
				return 'Can not Zip the files';
			}
			$tmpDir = $local_file.$tmpFolder.'/';
			$filename   =   $tmpFolder.'.zip';
			ftp_pasv($ftp_conn, true);	
			
			if ($zip->open($filename,  ZipArchive::CREATE)){
				$j=0;
				foreach($ftp_files as $file){
					$getExten = explode(".",$file);
					 $tempHandle = 	$tmpDir.$j.'.'.$getExten[1];
					 $ge = ftp_get($ftp_conn, $tempHandle, $file, FTP_BINARY);	
											
					$zip->addFile($tempHandle);
					$j++;
				}
				$zip->close();				
				
					ob_start();	
				    header('Pragma: public');   // required
					header('Expires: 0');       // no cache					
					header("Content-Description: File Transfer");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
					
					header("Content-type: application/zip"); 
					header("Content-Disposition: attachment; filename=$filename");
					header('Content-Transfer-Encoding: binary');
					header("Content-length: " . filesize($filename));
					
					ob_clean();   
					ob_end_flush(); //Modify flush() to ob_end_flush();
					readfile("$filename");
					unlink($filename);
					//unlink($tmpDir);
					exit();
				
			}else{
			   echo 'Failed!';
			}
			
	
}