<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();
}

 ?>
<?php
require('FPDF\tfpdf.php');
class PDF extends tFPDF {
    const DPI = 96;
    const MM_IN_INCH = 25.4;
    const A4_HEIGHT = 297;
    const A4_WIDTH = 210;
    const MAX_WIDTH = 800;
    const MAX_HEIGHT = 500;
    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
    }
    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);
        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;
        $scale = min($widthScale, $heightScale);
        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }
    function centreImage($img) {
        list($width, $height) = $this->resizeToFit($img);
        $this->Image(
            $img, (self::A4_HEIGHT - $width) / 2,
            (self::A4_WIDTH - $height) / 2,
            $width,
            $height
        );
    }
}?>
<?php

$pdf=new PDF();

$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
if(isset($_REQUEST['id'])){

$xml=simplexml_load_file("reviews.xml");

$prom=$_REQUEST['id'];

$sviRevs = $xml->children();

foreach( $sviRevs as $review)
{
  $glupost1=$review->ID."";
  $glupost2=$prom."";
    if ($glupost1==$glupost2)
    {
      $pdf->AddPage();
      $pdf->SetFont('DejaVu','',12);
      $pdf->Cell(0,20,$review->Title,0,2);
      $pdf->SetFont('DejaVu','',12);
      $pdf->Cell(0,10,"by ".$review->Name." ".$review->Email,0,2);
      $pdf->MultiCell(0,5,$review->Text,0,1);
      $pictures=$review->Pictures;
      $pdf->AddPage("L");
      $pdf->centreImage($pictures->Picture1."");
      $pdf->AddPage("L");
      $pdf->centreImage($pictures->Picture2."");
      $pdf->AddPage("L");
      $pdf->centreImage($pictures->Picture3."");
      $brojac=0;
      if (file_exists("comments.xml"))
      {

        $xml1=simplexml_load_file("comments.xml");
        $sviKom = $xml1->children();

          $pdf->AddPage();
        foreach( $sviKom as $kom)
        {
          $glupost1=$kom->RevID."";
          $glupost2=$review->ID."";
          if ($glupost1==$glupost2)
          {$brojac++;
            $pdf->Cell(0,20,'Comment '.$brojac."",0,2);
            $pdf->Cell(0,5,$kom->Name,0,2);
            $pdf->Cell(0,5,'Quality: '.$kom->Quality,0,2);
            $pdf->MultiCell(0,5,$kom->Text,0,2);

          }
        }
        if ($brojac==0) { $pdf->Cell(0,10,'Review has no comments.',0,2);}
      }
      else{   $pdf->AddPage();$pdf->Cell(0,5,'Review has no comments.',0,2);}

      $pdf->output();
      break;
    }
}
}
?>
