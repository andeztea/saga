<?php
 include "../fpdf17/fpdf.php";
 include "../config/koneksi.php";
//SourceCode by AndezNET.com
$pdf=new FPDF('L','cm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'SMS ANDEZNET GATEWAY',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->SetX(3);
$pdf->MultiCell(19.5,0.5,'CETAK INBOX',0,'L');


$pdf->SetLineWidth(0);
$pdf->Ln();

$pdf->SetFont('Arial','B',10);


$pdf->Cell(1,0.8,'NO',1,0,'C');
$pdf->Cell(4,0.8,'TANGGAL',1,0,'C');
$pdf->Cell(3,0.8,'PENGIRIM',1,0,'C');
$pdf->Cell(20,0.8,'PESAN',1,0,'C');

$pdf->SetFont('Arial','',10);
$pdf->Ln();

$hasi=mysqli_query($mysqli,"SELECT * FROM INBOX order by ReceivingDateTime desc");
$no = 1;

while($hasil=mysqli_fetch_array($hasi,MYSQL_ASSOC)){

$pdf->SetFillColor(255,255,255);
$pdf->Cell(1,0.8,$no++,1,0,'C',true);
$pdf->Cell(4,0.8,$hasil['ReceivingDateTime'],1,0,'L',true);
$pdf->Cell(3,0.8,$hasil['SenderNumber'],1,0,'L',true);
$pdf->Cell(20,0.8,$hasil['TextDecoded'],1,0,'L',true);
$pdf->Ln();
}


$pdf->Ln();
$pdf->Output();

?>