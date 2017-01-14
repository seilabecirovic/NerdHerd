<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();
}

 ?>
 <?php
 $db_server= getenv('NHERD_SERVICE_HOST');
 $db_username=getenv('MYSQL_USER');
 $db_pw = getenv('MYSQL_PASSWORD');
 $db = getenv('MYSQL_DATABASE');

 ?>
<!DOCTYPE html>
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
            <div class="titlerev"><h1>Reviews</h1></div>
            <table>
              <tr>
                <th>
                  Title
                </th>
                <th>
                  Author
                </th>
                <th>
                  Number of comments
                </th>
                <th>
                  Option
                </th>
              </tr>
              <?php
              $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
              $veza->exec("set names utf8");
               $rezultat = $veza -> query("SELECT id, name, title FROM reviews");
               if ($rezultat!=null)
               {
                 $brojac=0;
                 foreach ($rezultat as $review) {
                   echo '<tr><td>';
                   echo '<a href="review.php?id='.htmlspecialchars($review['id']).'">'.htmlspecialchars($review['title']).'</a></td>';
                   echo '<td>'.htmlspecialchars($review['name']).'</td>';
                   $upit=$veza -> query("SELECT id, reviID from comments where reviID=".$review['id'].";");
                   if($upit!=false){
                   $komentari=$upit ->fetchAll();
                   if($komentari!=null)
                   $brojac=count($komentari);
                 }
                   echo '<td>'.$brojac."".'</td>';
                   echo '<td><a href="ExportPDF.php?id='.htmlspecialchars($review['id']).'">Get PDF</a></td>';
                    echo "</tr>";

                  }
                }
                else              {
                   echo '<h1>No reviews</h1>';
                   }
            /*  if (file_exists("reviews.xml"))
              {
               $xml=simplexml_load_file("reviews.xml");
               $sviRevs = $xml->children();
               foreach( $sviRevs as $review)
               {
                 echo '<tr><td>';
                 echo '<a href="review.php?id='.htmlspecialchars($review->ID).'">'.htmlspecialchars($review->Title).'</a></td>';
                 echo '<td>'.htmlspecialchars($review->Name).'</td>';
                  $brojac=0;
                 if (file_exists("comments.xml"))
                 {
                   $xml1=simplexml_load_file("comments.xml");
                   $sviKom = $xml1->children();
                   foreach( $sviKom as $kom)
                   {
                     $glupost1=$kom->RevID."";
                     $glupost2=$review->ID."";
                     if ($glupost1==$glupost2) $brojac++;
                   }
                 }
                 else $brojac=0;
                 echo '<td>'.$brojac."".'</td>';
                 echo '<td><a href="ExportPDF.php?id='.htmlspecialchars($review->ID).'">Get PDF</a></td>';
                  echo "</tr>";
                 }
               }

             else              {
                echo '<h1>No reviews</h1>';
                }
*/
               ?>

            </table>
            <br>
          </div>
        </div>
      </div>
</body>
</html>
