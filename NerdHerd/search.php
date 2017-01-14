<?php
session_start();
 ?>
 <?php
 $db_server= getenv('NHERD_SERVICE_HOST');
 $db_username=getenv('MYSQL_USER');
 $db_pw = getenv('MYSQL_PASSWORD');
 $db = getenv('MYSQL_DATABASE');

 ?>
<?php
  $brojac=0;
$output="";
  if(isset($_POST['search'])){
    $searchq=htmlspecialchars($_POST['search']);
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    $searchq='%'.$searchq.'%';
    $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
    $veza->exec("set names utf8");
     $rez = $veza -> prepare ("SELECT id, name, title FROM reviews WHERE name LIKE :nesto OR title LIKE :jedno");
  $rez->execute(array('nesto' => $searchq, 'jedno'=>$searchq));
  if ($rez!=false){
    $nesto=$rez->fetchAll();
    if($nesto!=null){
     $brojac= count($nesto);
     foreach( $nesto as $review)
     {
       $title=$review['title'];
       $name = $review['name'];
       $revID =$review['id'];
       $output .= '<h2> <a href=review.php?id='.$revID.'>'.$title.' '.$name.'</a></h2>';
     }
   }
 }
    else  $output='There are no results';

   if ($brojac==0)
     $output='There are no results';
  /*  if (file_exists("reviews.xml"))
    {
      $xml=simplexml_load_file("reviews.xml");
      $sviRevs = $xml->children();
      $brojac=0;
      foreach( $sviRevs as $review)
      {
        if (stripos($review->Title,$searchq)!==false || stripos($review->Name,$searchq)!==false || stripos($review->Title." ".$review->Name,$searchq)!==false || stripos($review->Name." ".$review->Title,$searchq)!==false)
        {
          $title=$review->Title;
          $name = $review->Name;
          $revID =$review->ID;
          $output .= '<h2> <a href=review.php?id='.$revID.'>'.$title.' '.$name.'</a></h2>';
          $brojac++;
        }
      }
      if ($brojac==0)
        $output='There are no results';
    }
    else  $output='Search is not available';*/
    }
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
            <div class="titlerev"><h1>Search</h1>
            <br>
            <form class="forma-search" action="search.php"  method="post">
              <div class="searchie">
            <input type="text" name="search" placeholder="Titles and Autors search" onkeydown="searchkey()">
            <input class="searchbutton" type="submit" value=">>" >

</div>
<br>
          <div id="output" class="output">
            <?php
            echo $output;
            ?>
          </div>
          <br>
            </form>
          </div>
          </div>
        </div>
      </div>
    </body>
    </html>
