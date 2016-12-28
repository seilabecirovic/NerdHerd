<!DOCTYPE html>
<html>
<?php

$posted = false;
 if( $_POST ) {
   $posted = true;
   if (file_exists("comments.xml"))
   {
    $xml=simplexml_load_file("comments.xml");
    $last_id   = count($xml) - 1;
    $etwas = $xml->children();
    $stillnoidea= $etwas[$last_id];
    $broj = $stillnoidea->ID+1;
    $comment= $xml->addChild('comment');
    $comment->addChild('ID', $broj."");
    $comment->addChild('RevID',$_POST['revic']);
    $comment->addChild('Name', $_POST['name']);
    $comment->addChild('Quality', $_POST['quality']."");
    $comment->addChild('Text', $_POST['Tekst']);
    $result= $xml->asXML("comments.xml");
   }
   else {
     $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><comments></comments>');
     $xml->addAttribute('version', '1.0');
     $comment= $xml->addChild('comment');
     $comment->addChild('ID', '1');
     $comment->addChild('RevID',$_POST['revic']);
     $comment->addChild('Name', $_POST['name']);
     $comment->addChild('Quality', $_POST['quality']."");
     $comment->addChild('Text', $_POST['Tekst']);
     $result= $xml->asXML("comments.xml");
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
                <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
<div class="glavne">
  <?php
  $prom="";
  if(isset($_REQUEST['id'])){
  $xml=simplexml_load_file("unconfirmedReviews.xml");
  $prom=$_REQUEST['id'];
  $sviRevs = $xml->children();
  $otvoreno = false;
  foreach( $sviRevs as $review)
  {
      if ($review->ID==$_REQUEST['id'])
      {
        echo '<div class="titlerev"><h1>'.$review->Title.'</h1></div>';
        echo '<div class="par"><p>'.$review->Name.'</p>'.'<p>'.$review->Email.'</p></div>';
        echo '<div class="revpic">
            <img class="carousel fade" onclick="enlargeImage(this)" src="http://i.lv3.hbo.com/assets/images/series/westworld/episodes/media-blast/160819-westworld-s1-blast-07-1280.jpg" alt="Review" />
            <img class="carousel fade" onclick="enlargeImage(this)" src="https://s.yimg.com/uu/api/res/1.2/UI5BpO8MK6MMeFq7.ln7Rg--/aD03MjA7dz0xMjgwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://s.yimg.com/uu/api/res/1.2/_0FaLlWmbB9v6lkydKSkhg--/aD03MjA7dz0xMjgwO3NtPTE7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/creatr-images/GLB/2016-10-03/f024f7e0-8937-11e6-818b-75dbca047757_SuperFanTV_s2016e193C_NIGHT_Westworld_Thumb.png"
                alt="Review" />
            <img class="carousel fade" onclick="enlargeImage(this)" src="http://media.comicbook.com/uploads1/2015/08/westworld-trailer-147031-1280x0.jpg" alt="Review" />
            <span class="buttonLijevo" onclick="CarouselFun(-1)">&#10094;</span>
            <span class="buttonDesno" onclick="CarouselFun(1)">&#10095;</span>
            <div class="dots">
                <span class="dot" onclick="trenutniCarousel(1)"></span>
                <span class="dot" onclick="trenutniCarousel(2)"></span>
                <span class="dot" onclick="trenutniCarousel(3)"></span>
            </div>
        </div>';
        echo '<div class="par"><p><br>'.$review->Text.'</p></div>';
        break;
      }
  }
}
  ?>

    <div class="komentar">
        <form class="forma-komentar" action="#" onsubmit="return unosKom()" method="post">
            <h3>Comment</h3>
            <div class="unoskoment">
                <label>Name</label>
                <input type="text" name="name" value="">
                <br>
            </div>
            <div class="unoskoment">
                <label>Review quality (1-10) </label>
                <input type="range" name="quality" min="1" max="10">
                <br>
            </div>
            <div class="unoskoment">
                <label>Text</label>
                <textarea rows=3 maxlength="1000" name="Tekst"></textarea>
            </div>
            <div class="unoskoment">
                <ul class="greska"></ul>
            </div>
            <?php
            echo'<input type="hidden" name="revic" value='.$prom."".'>'?>
            <input class="komentbutton" type="submit" value="Send">
        </form>
    </div>
</div>
</div>


<div id="myModal" class="modal" onclick="closeButton()">
    <span class="close" onclick="closeButton()">&times;</span>
    <img class="modal-content" id="modalImage" src="http://www.vishmax.com/en/innovattive-cms/themes/themax-theme-2015/images/no-image-found.gif" alt="Review">
</div>
</div>

</body>

</html>
