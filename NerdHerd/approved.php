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
                <li>  <a href='allreview.php'>All reviews </a></li>
                <li>  <a href='addreview.php'>Add a review</a></li>
                <li>  <a href='about.php'>About</a></li>
                <li>  <a href='contact.php'>Contact </a></li>
                <li>  <a href='messages.php'>Get Messages</a></li>
                <li>  <a href='approved.php'>Approved reviews with comments</a></li>
                <li>  <a href='unconfirmedComments.php'>Unconfirmed comments</a></li>
                <li>  <a href='unconfirmedReviews.php'>Unconfirmed reviews</a></li>
                <li>  <a href='login.php'>Login</a></li>
                <li>  <a href='logout.php'>Logout</a></li>
                <li>  <a href='search.php'>Search</a></li>
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
              if (file_exists("unconfirmedReviews.xml"))
              {
               $xml=simplexml_load_file("unconfirmedReviews.xml");
               $sviRevs = $xml->children();
               foreach( $sviRevs as $review)
               {
                 echo '<tr><td>';
                 echo '<a href="review.php?id='.$review->ID.'">'.$review->Title.'</a></td>';
                 echo '<td>'.$review->Name.'</td>';
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
                 echo '<td><a href="pdfEksport.php">Get PDF</a></td>';
                  echo "</tr>";
                 }
               }

             else              {
                echo '<h1>No reviews</h1>';
                }

               ?>

            </table>
            <br>
          </div>
        </div>
      </div>
</body>
</html>
