<?php
?>
<div class="nav-scroller bg-white shadow-sm">
  <nav class="nav nav-underline" aria-label="Secondary navigation">
    <a class="nav-link <?php if ($page=="Dashboard") {?> active<?}?> aria-current="page" href="#">Dashboard</a>
    <a class="nav-link" <?php if ($page=="Friends") {?> active<?}?>  href="">
      Friends
      <span class="badge bg-light text-dark rounded-pill align-text-bottom">27</span>
    </a>
    <a class="nav-link <?php if ($page=="Explore") {?> active <?}?> " href="Explore.php">Explore</a>
    <a class="nav-link <?php if ($page=="File_server") {?> active <?}?> " href="File_server.php">File Server</a>
    <a class="nav-link <?php if ($page=="Table_pdf") {?> active <?}?> " href="Table_pdf.php">Table to PDF</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
    <a class="nav-link" href="#">Link</a>
  </nav>
</div>