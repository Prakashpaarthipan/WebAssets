<?php
include_once('lib/config.php');
include_once('lib/function_connect.php');
include_once('lib/general_functions.php');
$page = "Tcpdf";
error_reporting('E_ALL');
function  fetch_data()  
 {  
      $output = '';  
     $get_data = select_query_json("select * from non_rate_comparison","Centra","TEST");
	 foreach($get_data as $data)
      {       
      $output .= '<tr>  
                          <td>'.$data["PRDCODE"].'</td>  
                          <td>'.$data["SUBCODE"].'</td>  
                          <td>'.$data["SUPCODE"].'</td>  
                          <td>'.$data["NTOYEAR"].'</td>  
                          <td>'.$data["NTONUMB"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
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
  
  <form role="form" name="frm_pdf"  id="frm_pdf" action="vendors/TCPDF/examples/print.php" method="POST" enctype="multipart/form-data">
  <input name="frm_function" value="generate" id="frm_function" type="hidden"/>
  <div class="d-flex align-items-center p-3 my-3">
  <button type="submit" class="btn btn-primary" id="tcpdfbtn">TCSPDF CHECK</button>
  </div>
  </form>
  <div>
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
     <table>
      <thead>
        <tr>
        <th>BRANCH </th>
        <th>PRODUCT</th>
        <th>SUB-PRODUCT</th>
        <th>RATE</th>
        <th>APPROVAL NO</th>
        </tr>
       
      </thead>
      <tbody>
        <tr>
          <td>TUP      </td>
          <td>ABZ - PACKING COVER      </td>
          <td> 5 - MINI PACKING COVER      </td>
          <td>20</td>
          <td>ADMIN / PURCHASE 4000159 / 12-12-2021 / 159 / 12:08PM   </td>
        </tr>
         <tr>
          <td>TUP      </td>
          <td>ABZ - PACKING COVER      </td>
          <td> 5 - MINI PACKING COVER      </td>
          <td>10</td>
          <td>ADMIN / PURCHASE 4000159 / 12-12-2021 / 159 / 12:08PM   </td>
        </tr>
         <tr>
          <td>TUP      </td>
          <td>ABZ - PACKING COVER      </td>
          <td> 5 - MINI PACKING COVER      </td>
          <td>20</td>
          <td>ADMIN / PURCHASE 4000159 / 12-12-2021 / 159 / 12:08PM   </td>
        </tr>
         <tr>
          <td>TUP      </td>
          <td>ABZ - PACKING COVER      </td>
          <td> 5 - MINI PACKING COVER      </td>
          <td>20</td>
          <td>ADMIN / PURCHASE 4000159 / 12-12-2021 / 159 / 12:08PM   </td>
        </tr>
      </tbody>        
     </table>
  </div>
  
</main>

<!-- style="position: absolute; top: 0; right: 0;" -->

    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	<script src="assets/js/jquery-3.5.1.min.js" integrity="" crossorigin="anonymous"></script>
	<script src="jquery-ui-light/jquery-ui.min.js" integrity="" crossorigin="anonymous"></script>
	<script src="assets/js/select2.js" integrity="" crossorigin="anonymous"></script>
	<script type="text/javascript">

	</script>
     
  </body>
</html>
