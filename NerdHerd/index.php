<!DOCTYPE html>
<?php
session_start();
 ?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <title>NerdHerd</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
            $veza = new PDO("mysql:dbname=nhbase;host=nherd-1-oqld9;charset=utf8", "admin", "pass");
            $veza->exec("set names utf8");
             $rezultat = $veza -> query("SELECT id, title, picture1 FROM reviews ORDER BY id desc LIMIT 9");
             if ($rezultat!=null)
             {
               $brojac=0;
               foreach ($rezultat as $review) {
                 if($brojac%3==0){
                   echo '<div class="red">';
                 }
                 echo '<div class="element">';
                 echo '<img src="'.htmlspecialchars($review['picture1']).'" alt="Review" />';
                 echo '<h2> <a href=review.php?id='.htmlspecialchars($review['id']).'>'.htmlspecialchars($review['title']).'</a></h2>';
                 echo '</div>';
                 if($brojac%3==2){
                   print "</div>";
                 }
                 $brojac++;
               }
             }
             else              {
                echo '<h1>No reviews</h1>';
                }


        /*    if (file_exists("reviews.xml"))
            {
             $xml=simplexml_load_file("reviews.xml");
             $last_id   = count($xml) - 1;
             $sviRevs = $xml->children();
             $brojac=0;
             $samoDevet=0;
             $otvoreno = false;
             for ($x = $last_id; $x >=0; $x--)
             {
               if($brojac%3==0){
                 echo '<div class="red">';
                 $otvoreno = true;
               }
               $Node= $sviRevs[$x];
               echo '<div class="element">';
                 $pictures=$Node->Pictures;
               echo '<img src="'.htmlspecialchars($pictures->Picture1).'" alt="Review" />';
               echo '<h2> <a href=review.php?id='.htmlspecialchars($Node->ID).'>'.htmlspecialchars($Node->Title).'</a></h2>';
               echo '</div>';
               if($brojac%3==2){
                 print "</div>";
               }
               $brojac++;
               $samoDevet++;
               if ($samoDevet==9) break;
             }
           }
           else              {
              echo '<h1>No reviews</h1>';
              }
              */
            ?>

          </div>
        </div>
      </div>
</body>
</html>
