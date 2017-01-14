<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();
}
?>

<?php
$veza = new PDO("mysql:dbname=nerdherd;host=localhost;charset=utf8", "spirala4", "spirala4");
$veza->exec("set names utf8");
 $veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 /*prenos review-ova*/
if (file_exists("reviews.xml"))
{
 $xml=simplexml_load_file("reviews.xml");
 $sviRevs = $xml->children();
 foreach( $sviRevs as $review)
 {

   $rez = $veza -> query("SELECT * FROM reviews WHERE xmlid=".$review->ID);
   if($rez!=false)
   {
     $nesto=$rez->fetch();
     if($nesto==null){
     $sql = "INSERT INTO reviews (name,email,title,text,picture1,picture2,picture3,xmlid)
     VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3, :xmlid)";
     $unos = $veza->prepare($sql);
     $pictures=$review->Pictures;
     $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,"title"=>$review->Title,
   "text"=>$review->Text,"picture1"=>$pictures->Picture1,"picture2"=>$pictures->Picture2,"picture3"=>$pictures->Picture3,"xmlid"=>$review->ID));
   }
 }
 else {
   $sql = "INSERT INTO reviews (name,email,title,text,picture1,picture2,picture3,xmlid)
   VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3, :xmlid)";
   $unos = $veza->prepare($sql);
   $pictures=$review->Pictures;
   $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,"title"=>$review->Title,
 "text"=>$review->Text,"picture1"=>$pictures->Picture1,"picture2"=>$pictures->Picture2,"picture3"=>$pictures->Picture3,"xmlid"=>$review->ID));
 }
}
}


 /*prenos unconfirmedreview-ova*/
if (file_exists("unconfirmedReviews.xml"))
{
 $xml=simplexml_load_file("unconfirmedReviews.xml");
 $sviRevs = $xml->children();
 foreach( $sviRevs as $review)
 {

   $rez = $veza -> query("SELECT * FROM unconfirmedreviews WHERE xmlid=".$review->ID);
   if($rez!=false)
   {
     $nesto=$rez->fetch();
     if($nesto==null){
     $sql = "INSERT INTO unconfirmedreviews (name,email,title,text,picture1,picture2,picture3,xmlid)
     VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3, :xmlid)";
     $unos = $veza->prepare($sql);
     $pictures=$review->Pictures;
     $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,"title"=>$review->Title,
   "text"=>$review->Text,"picture1"=>$pictures->Picture1,"picture2"=>$pictures->Picture2,"picture3"=>$pictures->Picture3,"xmlid"=>$review->ID));
   }
 }
 else{
   $sql = "INSERT INTO unconfirmedreviews (name,email,title,text,picture1,picture2,picture3,xmlid)
   VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3, :xmlid)";
   $unos = $veza->prepare($sql);
   $pictures=$review->Pictures;
   $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,"title"=>$review->Title,
 "text"=>$review->Text,"picture1"=>$pictures->Picture1,"picture2"=>$pictures->Picture2,"picture3"=>$pictures->Picture3,"xmlid"=>$review->ID));
 }
}
}

 /*prenos comment-ara*/
 if (file_exists("comments.xml"))
 {
  $xml=simplexml_load_file("comments.xml");
  $sviRevs = $xml->children();
  foreach( $sviRevs as $review)
  {

    $rez = $veza -> query("SELECT * FROM comments WHERE xmlid=".$review->ID);
    if($rez!=false)
    {
      $nesto=$rez->fetch();
      if($nesto==null){
      $sql = "INSERT INTO comments (reviID,name,quality,text,xmlid)
      VALUES (:reviID, :name, :quality, :text, :xmlid)";
      $sklj = $veza -> query("SELECT * FROM reviews WHERE xmlid=".$review->RevID);
      $something = $sklj -> fetch();
      $unos = $veza->prepare($sql);
      $unos->execute(array("reviID"=>$something['id'],"name"=>$review->Name,"quality"=>$review->Quality,
    "text"=>$review->Text,"xmlid"=>$review->ID));
    }
  }
  else{
    $sql = "INSERT INTO comments (reviID,name,quality,text,xmlid)
    VALUES (:reviID, :name, :quality, :text, :xmlid)";
      $sklj = $veza -> query("SELECT * FROM reviews WHERE xmlid=".$review->RevID);
    $something = $sklj -> fetch();
    $unos = $veza->prepare($sql);
    $unos->execute(array("reviID"=>$something['id'],"name"=>$review->Name,"quality"=>$review->Quality,
  "text"=>$review->Text,"xmlid"=>$review->ID));
  }
 }
 }

 /*prenos unconfirmed comment-ara*/
 if (file_exists("uncomments.xml"))
 {
  $xml=simplexml_load_file("uncomments.xml");
  $sviRevs = $xml->children();
  foreach( $sviRevs as $review)
  {

    $rez = $veza -> query("SELECT * FROM uncomments WHERE xmlid=".$review->ID);
    if($rez!=false)
    {
      $nesto=$rez->fetch();
      if($nesto==null){
      $sql = "INSERT INTO uncomments (revID,name,quality,text,xmlid)
      VALUES (:revID, :name, :quality, :text, :xmlid)";
      $sklj = $veza -> query("SELECT * FROM reviews WHERE xmlid=".$review->RevID);
      $something = $sklj -> fetch();
      $unos = $veza->prepare($sql);
      $unos->execute(array("revID"=>$something['id'],"name"=>$review->Name,"quality"=>$review->Quality,
    "text"=>$review->Text,"xmlid"=>$review->ID));
    }
  }
  else{
    $sql = "INSERT INTO uncomments (revID,name,quality,text,xmlid)
    VALUES (:reviID, :name, :quality, :text, :xmlid)";
      $sklj = $veza -> query("SELECT * FROM reviews WHERE xmlid=".$review->RevID);
    $something = $sklj -> fetch();
    $unos = $veza->prepare($sql);
    $unos->execute(array("revID"=>$something['id'],"name"=>$review->Name,"quality"=>$review->Quality,
  "text"=>$review->Text,"xmlid"=>$review->ID));
  }
 }
 }
 /*prenos contactsa*/
 if (file_exists("contacts.xml"))
 {
  $xml=simplexml_load_file("contacts.xml");
  $sviRevs = $xml->children();
  foreach( $sviRevs as $review)
  {

    $rez = $veza -> query("SELECT * FROM contacts WHERE xmlid=".$review->ID);
    if($rez!=false)
    {
      $nesto=$rez->fetch();
      if($nesto==null){
      $sql = "INSERT INTO contacts (name,email,text,xmlid)
      VALUES (:name, :email, :text, :xmlid)";
      $unos = $veza->prepare($sql);
      $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,
    "text"=>$review->Text,"xmlid"=>$review->ID));
    }
  }
  else{
    $sql = "INSERT INTO contacts (name,email,text,xmlid)
    VALUES (:name, :email, :text, :xmlid)";
    $unos = $veza->prepare($sql);
    $unos->execute(array("name"=>$review->Name,"email"=>$review->Email,
  "text"=>$review->Text,"xmlid"=>$review->ID));
  }
 }
 }
$sql = "UPDATE users SET button='1' WHERE id=1";
 $veza->exec($sql);
  $_SESSION['button']='1';
 echo '<script type="text/javascript">alert("Sucess!");</script>';
 header('Location: ' . "index.php");
 ?>
