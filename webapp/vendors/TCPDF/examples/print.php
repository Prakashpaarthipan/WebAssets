<?php
include_once('../../../lib/config.php');
include_once('../../../lib/function_connect.php');
include_once('../../../lib/general_functions.php');
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 001');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$prdcode = 'ABZ';
$subcode = 5;

$prd_rate = select_query_json("select * from NON_RATE_COMPARISON where prdcode = '".$prdcode."' and subcode = '".$subcode."'","Centra","TEST");
// Set some content to print
$html = '<table style="border-collapse: collapse; border: 1px solid black;font-size:8px">
      <thead>
        <tr>
        <th style="height:20px;text-align:center;border: 1px solid black;width:8%">BRANCH </th>
        <th style="height:20px;text-align:center;border: 1px solid black;width:20%">PRODUCT</th>
        <th style="height:20px;text-align:center;border: 1px solid black;width:20%">SUB-PRODUCT</th>
        <th style="height:20px;text-align:center;border: 1px solid black;width:8%">RATE</th>
        <th style="height:20px;text-align:center;border: 1px solid black;width:44%">APPROVAL NO</th>
        </tr>
       
      </thead>
      <tbody>';
      foreach ($prd_rate as $key => $value) {
      
        $html .='<tr>
          <td style="border: 1px solid black;width:8%">'.$value["BRNCODE"].'</td>
          <td style="border: 1px solid black;width:20%">'.$value["PRDCODE"].' </td>
          <td style="border: 1px solid black;width:20%">'.$value["SUBCODE"].' </td>
          <td style="border: 1px solid black;width:8%">'.$value["PRDRATE"].'</td>
          <td style="border: 1px solid black;width:44%">'.$value["APRNUMB"].'</td>
        </tr>';
      }
        
         
       $html .=' </tbody>        
                </table>';


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
//1312_16_1_2020-21_fieldimpl_p_2
$file_Name = 'product_2.pdf';
$pdf->Output(__DIR__ . '/uploads/'.$file_Name, 'F'); // I for inline pdf view / F for Save File


              $local_file = __DIR__ . '/uploads/'.$file_Name;
              $server_file = 'approval_desk/request_entry/non_product/'.$file_Name;

              // Approval Documents
              $attch = select_query_json("select nvl(max(APDCSRN),0)+1 MAXSRNO from APPROVAL_REQUEST_DOCS where APRNUMB = '".$apprno."'","Centra","TCS");
              $tbl_docs = "APPROVAL_REQUEST_DOCS";
              $field_docs['APRNUMB'] = $apprno;
              $field_docs['APDCSRN'] = $attch[0]['MAXSRNO'];
              $field_docs['APRDOCS'] = $file_Name;
              $field_docs['APRHEAD'] = 'non_product';
              $field_docs['DOCSTAT'] = 'N';
              $field_docs['ARQSRNO'] = 1;
              // print_r($field_docs);
              // Approval Documents

              if ((!$conn_id) || (!$login_result)) {
                $upload = ftp_put($ftp_conn, $server_file, $local_file, FTP_BINARY);
                // echo "<br>lar Succes";
                //unlink($local_file);
              }
              if ($upload) {
               // $insert_docs = insert_dbquery($field_docs, $tbl_docs);
              }

//============================================================+
// END OF FILE
//============================================================+
