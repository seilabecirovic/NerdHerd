<!DOCTYPE html>
<html>

<?php
$posted = false;
 if( $_POST ) {
   $posted = true;
   if (file_exists("unconfirmedReviews.xml"))
   {
    $xml=simplexml_load_file("unconfirmedReviews.xml");
    $last_id   = count($xml) - 1;
    $etwas = $xml->children();
    $stillnoidea= $etwas[$last_id];
    $broj = $stillnoidea->ID+1;
    $review= $xml->addChild('review');
    $review->addChild('ID', $broj."");
    $review->addChild('Name', $_POST['name']);
    $review->addChild('Email', $_POST['email']);
    $review->addChild('Title', $_POST['title']);
    $review->addChild('Text', $_POST['Tekst']);
    $result= $xml->asXML("unconfirmedReviews.xml");

   }
   else {
     $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><unconfirmedReviews></unconfirmedReviews>');
$xml->addAttribute('version', '1.0');
$review= $xml->addChild('review');
$review->addChild('ID', '1');
$review->addChild('Name', $_POST['name']);
$review->addChild('Email', $_POST['email']);
$review->addChild('Title', $_POST['title']);
$review->addChild('Text', $_POST['Tekst']);
$result= $xml->asXML("unconfirmedReviews.xml");
   }
 }
 ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <title>NerdHerd</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
    <link href="https://fonts.googleapis.com/css?family=Gentium+Basic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
</head>

<body>
    <script src="nerdherd.js" charset="utf-8"></script>
    <div class="stranica">
        <div class="logo">
            <div class="slika">
                <img src="http://pichoster.net/images/2016/11/04/pozadina.jpg" alt="NerdHerd" />
            </div>
        </div>
        <div class="meni">
            <ul class="navigacija" id="mojanav">
                <li>  <a href="index.php"> Latest reviews</a></li>
                <li>  <a href='allreview.php'>All reviews </a></li>
                <li>  <a href='addreview.php'>Add a review</a></li>
                <li>  <a href='about.php'>About</a></li>
                <li>  <a href='contact.php'>Contact </a></li>
                <li>Login</li>
                <li>  <a href='search.php'>Search</a></li>
                <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
          <?php
    if( $posted ) {
      if( $result )
        echo "<script type='text/javascript'>alert('Your review has been submitted successfully!')</script>";
      else
        echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
    }
  ?>
<div class="glavne">
    <div class="dodrev">
        <form class="forma-unosrev" name="forma-unosrev" action="" method="post" onsubmit="return unosRev()">
            <div class="unosrev">
                <label>Name</label>
                <input type="text" name="name" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Email</label>
                <input type="email" name="email" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Title</label>
                <input type="text" name="title" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Text</label>
                <textarea rows=10 maxlength="4000" name="Tekst"></textarea>
            </div>
            <div class="unosrev">
                <label>Image</label>
                <input class="picbutton" accept="image/*" type="file" name="imgfile" multiple="multiple">
            </div>
            <div class="unosrev">
                <ul class="greska"></ul>
            </div>
            <input class="revbutton" type="submit" value="Send">
        </form>
    </div>
    <div class="napomene">
        <h3> *Every review will be revised before publishing. Any writing, sign or visible representation that
          advocates or promotes the communication of which by any person would constitute an offence will be deleted. </h3>
    </div>
</div>

</div>
</div>

</body>

</html>
