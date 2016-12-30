<?php
session_start();
 ?>
 <?php
 $GLOBALS["IHaveCalledSrandBefore"]=1;
if (!$GLOBALS["IHaveCalledSrandBefore"]++) {
  srand((double) microtime() * 1000000);
}
?>
<!DOCTYPE html>
<html>
<?php

$posted = false;
 if( $_POST ) {
   $posted = true;
   if (file_exists("uncomments.xml"))
   {
    $xml=simplexml_load_file("uncomments.xml");
    $last_id   = count($xml) - 1;
    $etwas = $xml->children();
    $stillnoidea= $etwas[$last_id];
    $randval = rand(1,1024);
    $comment= $xml->addChild('comment');
    $comment->addChild('ID', $randval."");
    $comment->addChild('RevID',htmlspecialchars($_POST['revic']));
    $comment->addChild('Name', htmlspecialchars($_POST['name']));
    $comment->addChild('Quality',htmlspecialchars($_POST['quality'].""));
    $comment->addChild('Text', htmlspecialchars($_POST['Tekst']));
    $result= $xml->asXML("uncomments.xml");
   }
   else {
     $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><comments></comments>');
     $xml->addAttribute('version', '1.0');
     $comment= $xml->addChild('comment');
     $randval = rand(1,1024);
     $comment->addChild('ID', $randval."");
     $comment->addChild('RevID',htmlspecialchars($_POST['revic']));
     $comment->addChild('Name', htmlspecialchars($_POST['name']));
     $comment->addChild('Quality',htmlspecialchars($_POST['quality'].""));
     $comment->addChild('Text', htmlspecialchars($_POST['Tekst']));
     $result= $xml->asXML("uncomments.xml");
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
<div class="glavne">
  <?php
  $prom="";
  if(isset($_REQUEST['id'])){
  $xml=simplexml_load_file("reviews.xml");
  $prom=$_REQUEST['id'];
  $sviRevs = $xml->children();
  $otvoreno = false;
  foreach( $sviRevs as $review)
  {
      if ($review->ID==$_REQUEST['id'])
      {
        echo '<div class="titlerev"><h1>'.htmlspecialchars($review->Title).'</h1></div>';
        echo '<div class="par"><p>'.htmlspecialchars($review->Name).'</p>'.'<p>'.htmlspecialchars($review->Email).'</p></div>';
        echo '<div class="revpic">';
        $pictures=$review->Pictures;
        echo    '<img class="carousel fade" onclick="enlargeImage(this)" src='.htmlspecialchars($pictures->Picture1).' alt="Review" />
            <img class="carousel fade" onclick="enlargeImage(this)" src='.htmlspecialchars($pictures->Picture2).' alt="Review" />
            <img class="carousel fade" onclick="enlargeImage(this)" src='.htmlspecialchars($pictures->Picture3).' alt="Review" />
            <span class="buttonLijevo" onclick="CarouselFun(-1)">&#10094;</span>
            <span class="buttonDesno" onclick="CarouselFun(1)">&#10095;</span>
            <div class="dots">
                <span class="dot" onclick="trenutniCarousel(1)"></span>
                <span class="dot" onclick="trenutniCarousel(2)"></span>
                <span class="dot" onclick="trenutniCarousel(3)"></span>
            </div>
        </div>';
        echo '<div class="par"><p><br>'.htmlspecialchars($review->Text).'</p></div>';
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

    <?php
    $prom="";
    if(isset($_REQUEST['id'])){
    if (file_exists("comments.xml")){
    $xml=simplexml_load_file("comments.xml");
    $prom=$_REQUEST['id'];
    $koments = $xml->children();
    $count=0;
    foreach( $koments as $koment)
    {
      $glupost1=$koment->RevID."";
      $glupost2=$prom."";
      if ($glupost1==$glupost2){
      $count++;

          echo '<div class="par"><h2>Comment '.$count."".': </h2>';
          echo '<p>'.htmlspecialchars($koment->Name).'</p>'.'<p>Quality: '.htmlspecialchars($koment->Quality).'</p>';
          echo '<p>'.htmlspecialchars($koment->Text).'</p></div>';
        }
    }
    }
  }
    ?>
</div>
</div>


<div id="myModal" class="modal" onclick="closeButton()">
    <span class="close" onclick="closeButton()">&times;</span>
    <img class="modal-content" id="modalImage" src="http://www.vishmax.com/en/innovattive-cms/themes/themax-theme-2015/images/no-image-found.gif" alt="Review">
</div>
</div>

</body>

</html>
