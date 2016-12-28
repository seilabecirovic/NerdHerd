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
<div class="glavne">
  <?php
  if (file_exists("unconfirmedReviews.xml"))
  {
   $xml=simplexml_load_file("unconfirmedReviews.xml");
   $sviRevs = $xml->children();
   foreach( $sviRevs as $review)
   {
       echo '<div class="revred">';

     echo '<div class="revslika">';
     echo '<img src="http://www.vishmax.com/en/innovattive-cms/themes/themax-theme-2015/images/no-image-found.gif" alt="Review" />';
     echo '</div>';
     echo '<div class="tekstrev">';
     echo '<h2> <a href=review.php?id='.$review->ID.'>'.$review->Title.'</a></h2>';
     echo '<p>'.$review->Name.'</p>'.'<p>'.$review->Email.'</p>';
     echo '</div>';
      echo "</div>";
     }
   }

 else              {
    echo '<h1>No reviews</h1>';
    }

  ?>


</div>
</div>
</div>

</body>

</html>
