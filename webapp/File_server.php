<?php
include_once('lib/config.php');
include_once('lib/function_connect.php');
include_once('lib/general_functions.php');
$page = "File_server";
try {
	// connect and login to FTP server
	 $ftp_conn = ftp_connect(ftpvri_server_apdsk, 5022)  or die('Could not connect to ftpvri_server_apdsk');
	 $login = ftp_login($ftp_conn, ftpvri_user_name_apdsk, ftpvri_user_pass_apdsk);
}
catch(Exception $e) { //catch exception
  echo 'Error Message: ' .$e->getMessage();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($ftp_files)){
						
			
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
					 ftp_get($ftp_conn, $tempHandle, $file, FTP_BINARY);
                     $baseFile[] = basename( $tempHandle);	
                     $temFiles = basename( $tempHandle);				 
					 file_put_contents( $temFiles, file_get_contents($tempHandle));
					$zip->addFile($temFiles);
					$j++;
					
					
					
				}
				$zip->close();				
				foreach($baseFile as $tpFile) {
					if (is_readable($tpFile)) {
						chmod($tpFile, 0777);     
						unlink($tpFile);
					}
				}
				
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
					unlink($tmpDir);
					
					exit();
					
				
			}else{
			   echo 'Failed!';
			}
			
	
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Offcanvas template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="jquery-ui-light/jquery-ui.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
<link href="b-icons/font/bootstrap-icons.css" rel="stylesheet" integrity="" crossorigin="anonymous">
<link href="assets/css/select2.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <!-- Favicons -->
<link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="assets/img/favicons/manifest.json">
<link rel="mask-icon" href="assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
		
		html,
body {
  overflow-x: hidden; /* Prevent scroll on narrow devices */
}

body {
  padding-top: 56px;
}

@media (max-width: 991.98px) {
  .offcanvas-collapse {
    position: fixed;
    top: 56px; /* Height of navbar */
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #343a40;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
  }
  .offcanvas-collapse.open {
    visibility: visible;
    transform: translateX(-100%);
  }
}

.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;
}

.nav-scroller .nav {
  display: flex;
  flex-wrap: nowrap;
  padding-bottom: 1rem;
  margin-top: -1px;
  overflow-x: auto;
  color: rgba(255, 255, 255, .75);
  text-align: center;
  white-space: nowrap;
  -webkit-overflow-scrolling: touch;
}

.nav-underline .nav-link {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: .875rem;
  color: #6c757d;
}

.nav-underline .nav-link:hover {
  color: #007bff;
}

.nav-underline .active {
  font-weight: 500;
  color: #343a40;
}

.text-white-50 { color: rgba(255, 255, 255, .5); }

.bg-purple { background-color: #6f42c1; }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    
  </head>
  <body class="bg-light">
    
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Offcanvas navbar</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="offcanvas" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="#">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Notifications</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Switch account</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Settings</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown01">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<?php require_once('partials/sub_navbar.php');?>

<main class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <img class="me-3" src="assets/brand/bootstrap-logo-white.svg" alt="" width="48" height="38">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1">PHP FILE HOST</h1>
      <small>File Upload and Download Features</small>
    </div>
  </div>
  <div class="d-flex align-items-center p-3 my-3">
  <button type="button" class="btn btn-primary show-toast" id="toastbtn">Show Toast</button>
  </div>
  <form role="form" name="frm_upload"  id="frm_upload" action="" method="POST" enctype="multipart/form-data" >
	<div class="d-flex align-items-center p-3 my-3">
		<div class="list-group">
			<?
			$server_file = 'approval_desk/Bid/file_upload/';
			$contents = ftp_nlist($ftp_conn, $server_file);
			
				for($i=0;$i<count($contents);$i++){
					
					$ext = explode(".",$contents[$i]);
					if($ext[1] !=''){
					$get_filename_with_ext = explode("/",$contents[$i]);
					$get_filename = explode(".",$get_filename_with_ext);
					?>
					
					  <label class="list-group-item">
						<input class="form-check-input me-1" name = "ftp_files[]" id="files_<?=$i?>" type="checkbox" value="<?=$contents[$i]?>">
						<?=end($get_filename_with_ext)?>
					  </label>
					 
					
					<?
					}
				}
			?>
		</div>
	</div>
	<input type="submit" name="Download" id="Download" class="btn btn-primary"  value ="Download As Zip ">
	</form>

</main>
	
	  <!-- Position it: -->
	  <!-- - `.toast-container` for spacing between toasts -->
	  <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
	  <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
		<div class="toast-container position-absolute bottom-0 end-0 p-3">			
			<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			  <div class="toast-header">
				<img src="b-icons/bootstrap.svg" width="16" height="16" class="rounded me-2" alt="img">
				<strong class="me-auto">Bootstrap</strong>
				<small class="text-muted">2 seconds ago</small>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			  </div>
			  <div class="toast-body">
				Heads up, toasts will stack automatically
			  </div>
			</div>
		</div>
		
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Holy guacamole!</strong> You are using New bootstrap 5.
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>


<!-- style="position: absolute; top: 0; right: 0;" -->

    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="assets/js/jquery-3.5.1.min.js" integrity="" crossorigin="anonymous"></script>
	<script src="jquery-ui-light/jquery-ui.min.js" integrity="" crossorigin="anonymous"></script>
	<script src="assets/js/select2.js" integrity="" crossorigin="anonymous"></script>
	<script type="text/javascript">
				$("#frm_upload1").on('submit', function(e){		
			
			e.preventDefault();			
			
				alert("OK");
				var form_data = new FormData(document.getElementById("frm_upload"));
				form_data.append("action","downloadMultiple");
				   $.ajax({
					url: "ajax/ajax_file_download.php",
					type: "post",
					data: form_data,
					contentType: false,
					processData:false,
					dataType:"binary",
					success: function(d) {
						window.location = 'ajax/ajax_file_download.php';
					}
				});
			
		});
		
		 function downloadFile() {
			 window.location = 'ajax/ajax_file_download.php?action=downloadMultiple';
		}
	</script>
     
  </body>
</html>
