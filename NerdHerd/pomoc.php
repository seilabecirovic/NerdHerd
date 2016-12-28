<?php
$posted = false;
   $posted = true;
   if (file_exists("unconfirmedReviews.xml"))
   {
    $xml=simplexml_load_file("unconfirmedReviews.xml");
    $last_id   = count($xml) - 1;

    $etwas = $xml->children();
    $stillnoidea= $etwas[$last_id];
    $broj = $stillnoidea->ID+1;
    echo "<H1>".$broj."</H1>";
/*    $broj = (int)$stillnoidea + 1;
    $review= $xml->addChild('review');
    $review->addChild('ID', $broj . "");
    $review->addChild('Name', $_POST['name']);
    $review->addChild('Email', $_POST['email']);
    $review->addChild('Title', $_POST['title']);
    $review->addChild('Text', $_POST['Tekst']);
    $result= $xml->asXML("unconfirmedReviews.xml");*/

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

 ?>
