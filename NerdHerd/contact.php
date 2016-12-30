<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<?php
$posted = false;
 if( $_POST ) {
   $posted = true;
   if (file_exists("contacts.xml"))
   {
    $xml=simplexml_load_file("contacts.xml");
    $last_id   = count($xml) - 1;
    $etwas = $xml->children();
    $stillnoidea= $etwas[$last_id];
    $broj = $stillnoidea->ID+1;
    $contact= $xml->addChild('contact');
    $contact->addChild('ID', $broj."");
    $contact->addChild('Name', htmlspecialchars($_POST['name']));
    $contact->addChild('Email',htmlspecialchars( $_POST['email']));
    $contact->addChild('Text', htmlspecialchars($_POST['Tekst']));
    $result= $xml->asXML("contacts.xml");
   }
   else {
     $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><contacts></contacts>');
     $xml->addAttribute('version', '1.0');
     $contact= $xml->addChild('contact');
     $contact->addChild('ID', '1');
     $contact->addChild('Name', htmlspecialchars($_POST['name']));
     $contact->addChild('Email',htmlspecialchars( $_POST['email']));
     $contact->addChild('Text', htmlspecialchars($_POST['Tekst']));
     $result= $xml->asXML("contacts.xml");
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
              <li>  <a href='allreview.php'>All reviews</a></li>
              <?php if(isset($_SESSION['user'])){
                echo "<li>  <a href='approved.php'>Approved reviews</a></li>
                <li>  <a href='unconfirmedReviews.php'>Unconfirmed reviews</a></li>
                <li>  <a href='unconfirmedComments.php'>Unconfirmed comments</a></li>
                <li>  <a href='messages.php'>Get Messages</a></li>
                <li>  <a href='login.php?action=logout'>Logout</a></li>";
              }
              else {
                echo "
                <li>  <a href='addreview.php'>Add a review</a></li>
                <li>  <a href='about.php'>About</a></li>
                <li>  <a href='contact.php'>Contact </a></li>
                <li>  <a href='login.php'>Login</a></li>";
              }
               ?>
               <li>  <a href='search.php'>Search</a></li>
              <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
          <?php
    if( $posted ) {
      if( $result )
        echo "<script type='text/javascript'>alert('Your message has been submitted successfully!')</script>";
      else
        echo "<script type='text/javascript'>alert('Your message has not been submitted!')</script>";
    }
  ?>
<div class="glavne">
    <div class="dodkont">
        <form class="forma-kontakt" action="#" onsubmit="return unosKont()" method="post">
            <div class="unoskont">
                <label>Name</label>
                <input type="text" name="name" value="">
                <br>
            </div>
            <div class="unoskont">
                <label>Email</label>
                <input type="email" name="email" value="">
                <br>
            </div>
            <div class="unoskont">
                <label>Text</label>
                <textarea rows=5 maxlength="1000" name="Tekst"></textarea>
            </div>
            <div class="unoskont">
                <ul class="greska"></ul>
            </div>
            <input class="konbutton" type="submit" value="Send">
        </form>
    </div>

</div>
</div>
</div>

</body>

</html>
