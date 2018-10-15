<?php
require "configpdf.php"; // connection to database 
require_once('library/fpdf.php');
require('cellfit.php');
$pdf= new FPDF_CellFit();
$dispensary_name=$_REQUEST['dispensary_name'];
$worker_category=$_REQUEST['select_category'];
	
$count="SELECT * FROM worker_info WHERE  dispensary_name='$dispensary_name' and worker_category='$worker_category'"; // SQL to get 10 records 
//$pdf = new FPDF(); 
$pdf->AddPage('P','A3');
//$width_cell=array(10,20,20,20,12,10,8,12,12,16,20,20,20,10,20,20,12,20,20,20,10,20,20);
$width_cell=array(6,17,15,18,12,4,8,8,8,10,12,16,16,25,10,20,15,15,15,10,4,10,13);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
// Select Arial bold 15
$pdf->SetFont('Arial','B',5);
$pdf->Cell($width_cell[0],10,'SL.No',1,0,C,true); // First header column 
$pdf->CellFitScaleForce($width_cell[1],10,'Worker Name',1,0,C,true); // Second header column
$pdf->CellFitScaleForce($width_cell[2],10,'Aadhar No',1,0,C,true); // Third header column 
$pdf->CellFitScaleForce($width_cell[3],10,'Father Name/Spouse Name',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[4],10,'D O B',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[5],10,'Gen',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[6],10,'Qual',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[7],10,'Cat',1,0,C,true); // Fourth header column
$pdf->CellFitScaleForce($width_cell[8],10,'Disp. ID No',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[9],10,'P.F.No',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[10],10,'Mobile No',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[11],10,'Account No',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[12],10,'IFSC Code',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[13],10,'Bank Name',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[14],10,'City',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[15],10,'Branch',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[16],10,'Dep Aadhar No.',1,0,C,true); // Third header column 
$pdf->CellFitScaleForce($width_cell[17],10,'Dependency Name',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[18],10,'Occupation',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[19],10,'Relation',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[20],10,'Gen',1,0,C,true); // Third header column 
$pdf->Cell($width_cell[21],10,'D O B',1,0,C,true); // Fourth header column
$pdf->Cell($width_cell[22],10,'Edu',1,0,C,true); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',5);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 
$count1=0;
/// each record is one row  ///
foreach ($dbo->query($count) as $row) {
$count1=$count1+1;
$aadhar_no1=$row['aadhar_no'];
$countd="SELECT * FROM dependency WHERE worker_adhaarcard_no='$aadhar_no1'"; 
foreach ($dbo->query($countd) as $rows) {


$pdf->Cell($width_cell[0],10,$count1,1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[1],10,$row['worker_name'],1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[2],10,$row['aadhar_no'],1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[3],10,$row['worker_father_name'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['dob'],1,0,C,$fill);
//$pdf->Cell($width_cell[5],10,$row['gender'],1,0,C,$fill);

   if($row['gender']=="Female")
   {
    $pdf->Cell($width_cell[5],10,F,1,0,C,$fill);

   }
 
   elseif($row['gender']=="Male")
   {
   $pdf->Cell($width_cell[5],10,M,1,0,C,$fill);

   }
    elseif($row['gender']=="Others")
   {
    $pdf->Cell($width_cell[5],10,O,1,0,C,$fill);

   }
    elseif($row['gender']=="")
   {
   $pdf->Cell($width_cell[5],10,NULL,1,0,C,$fill);
	
   }
 
$pdf->Cell($width_cell[6],10,$row['educ_qual'],1,0,C,$fill);
$pdf->Cell($width_cell[7],10,$row['category'],1,0,C,$fill);
$pdf->Cell($width_cell[8],10,$row['dept_id_card_no'],1,0,C,$fill);
$pdf->Cell($width_cell[9],10,$row['pf_no'],1,0,C,$fill);
$pdf->Cell($width_cell[10],10,$row['work_cont_no'],1,0,C,$fill);
$pdf->Cell($width_cell[11],10,$row['acc_no'],1,0,C,$fill);
$pdf->Cell($width_cell[12],10,$row['ifsc'],1,0,C,$fill);
$pdf->Cell($width_cell[13],10,$row['bank_addr'],1,0,C,$fill);
$pdf->Cell($width_cell[14],10,$row['bank_city'],1,0,C,$fill);
$pdf->Cell($width_cell[15],10,$row['bank_branch'],1,0,C,$fill);

$pdf->CellFitScaleForce($width_cell[16],10,$rows['aadhar_no'],1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[17],10,$rows['dependency_name'],1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[18],10,$rows['occupation'],1,0,C,$fill);
$pdf->CellFitScaleForce($width_cell[19],10,$rows['relation'],1,0,C,$fill);
 //$pdf->Cell($width_cell[20],10,$rows['sex'],1,0,L,$fill);
  if($rows['sex']=="Female")
   {
    $pdf->Cell($width_cell[5],10,F,1,0,C,$fill);

   }
 
   elseif($rows['sex']=="Male")
   {
   $pdf->Cell($width_cell[5],10,M,1,0,C,$fill);

   }
    elseif($rows['sex']=="Others")
   {
    $pdf->Cell($width_cell[5],10,O,1,0,C,$fill);

   }
    elseif($rows['sex']=="")
   {
   $pdf->Cell($width_cell[5],10,NULL,1,0,C,$fill);
   }
   
$pdf->Cell($width_cell[21],10,$rows['dob'],1,0,C,$fill);
$pdf->CellFitSpace($width_cell[22],10,$rows['educ_qual'],1,1,C,$fill);
$fill = !$fill;
}
}
/// end of records /// 
$pdf->Output();
?>
