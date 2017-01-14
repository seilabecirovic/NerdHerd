<?php
session_start();
 ?>
<!DOCTYPE html>
<html>

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
                <li>  <a href='messages.php'>Get Messages</a></li>";
                if($_SESSION['button']=='0')
                echo "<li>  <a href='xmlToDB.php'>Export data</a></li>";
                echo "<li>  <a href='login.php?action=logout'>Logout</a></li>";
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
               <li> <a href='nerdherd.php?review'>Web Service</a></li>
              <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
<div class="glavne">
  <?php
  $veza = new PDO("mysql:dbname=nerdherd;host=localhost;charset=utf8", "spirala4", "spirala4");
  $veza->exec("set names utf8");
   $rez = $veza -> query("SELECT id, name, email, title, picture1 FROM reviews");
   if ($rez!=false)
   {
     $rezultat=$rez->fetchAll();
     if($rezultat!=null){
     foreach ($rezultat as $review) {
       echo '<div class="revred">';
     echo '<div class="revslika">';
     echo '<img src="'.htmlspecialchars($review['picture1']).'" alt="Review" />';
     echo '</div>';
     echo '<div class="tekstrev">';
     echo '<h2> <a href=review.php?id='.htmlspecialchars($review['id']).'>'.htmlspecialchars($review['title']).'</a></h2>';
     echo '<p>'.htmlspecialchars($review['name']).'</p>'.'<p>'.htmlspecialchars($review['email']).'</p>';
     echo '</div>';
      echo "</div>";
     }
   }
   else echo '<h1>No reviews</h1>';
 }
   else              {
      echo '<h1>No reviews</h1>';
      }
  /*if (file_exists("reviews.xml"))
  {
   $xml=simplexml_load_file("reviews.xml");
   $sviRevs = $xml->children();
   foreach( $sviRevs as $review)
   {
       echo '<div class="revred">';

     echo '<div class="revslika">';
    $pictures=$review->Pictures;
     echo '<img src="'.htmlspecialchars($pictures->Picture1).'" alt="Review" />';
     echo '</div>';
     echo '<div class="tekstrev">';
     echo '<h2> <a href=review.php?id='.htmlspecialchars($review->ID).'>'.htmlspecialchars($review->Title).'</a></h2>';
     echo '<p>'.htmlspecialchars($review->Name).'</p>'.'<p>'.htmlspecialchars($review->Email).'</p>';
     echo '</div>';
      echo "</div>";
     }
   }

 else              {
    echo '<h1>No reviews</h1>';
  }*/

  ?>


</div>
</div>
</div>

</body>

</html>
