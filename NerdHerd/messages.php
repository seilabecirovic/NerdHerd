<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();}

 ?>

<?php
$filename = "messages.csv";
if (file_exists("contacts.xml"))
{
 $xml=simplexml_load_file("contacts.xml");
 $messages= $xml->children();
 $csv_header="Name,";
 $csv_header.="Email,";
 $csv_header.="Text";
 $csv_header.="\n";
 $csv_row ='';
 foreach( $messages as $poruka)
 {
   $csv_row.=htmlspecialchars($poruka->Name);
   $csv_row.=",";
   $csv_row.=htmlspecialchars($poruka->Email);
   $csv_row.=",";
   $csv_row.=htmlspecialchars($poruka->Text);
   $csv_row.="\n";
 }
 header('Content-type: application/csv');
 header('Content-Disposition: attachment; filename='.$filename);
 echo $csv_header . $csv_row;
 exit;
 }
   else {
    echo '<script type="text/javascript">alert("There are no messages!");</script>';
    header('Location: ' . "index.php");
    exit;

   }

 ?>
