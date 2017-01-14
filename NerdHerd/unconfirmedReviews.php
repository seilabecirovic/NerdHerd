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
<?php
$red_izmjena=-1;
if($_POST)
{
  $keys=array_keys($_POST);
  foreach ($keys as $key => $value) {
    if($_REQUEST[$keys[$key]]=="Delete" || $_REQUEST[$keys[$key]]=="Approve" || $_REQUEST[$keys[$key]]=="Save" || $_REQUEST[$keys[$key]]=="Edit"){
      $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
      $veza->exec("set names utf8");
      $veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $koji_red=intval(explode("_",$keys[$key])[1]);
      $id_zamjena=intval(explode("_",$keys[$key])[2]);
       if($_REQUEST[$keys[$key]]=="Delete"){
         $sql = "DELETE FROM unconfirmedreviews WHERE id = :id";
         $unos = $veza->prepare($sql);
         $unos->execute(array("id"=>$koji_red.""));
       }
        else if($_REQUEST[$keys[$key]]=="Approve"){
          $sql = "INSERT INTO reviews (name,email,title,text,picture1,picture2,picture3)
          VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3)";
          $unos = $veza->prepare($sql);
          $sklj = $veza -> query("SELECT * FROM unconfirmedreviews WHERE id=".$koji_red."");
          $something = $sklj -> fetch();
          $result= $unos->execute(array("name"=>$something['name'],"email"=> $something['email'],"title"=>$something['title'],
          "text"=>$something['text'],"picture1"=>$something['picture1'],"picture2"=>$something['picture2'],"picture3"=>$something['picture3']));
          $sql = "DELETE FROM unconfirmedreviews WHERE id = :id";
          $unos = $veza->prepare($sql);
          $unos->execute(array("id"=>$koji_red.""));
      }
      else if ($_REQUEST[$keys[$key]]=="Save"){
        $sql = "UPDATE unconfirmedreviews SET text= :text WHERE id=:id";
        $unos = $veza->prepare($sql);
        $unos->execute(array("text"=>$_POST['Tekst'],"id"=>$koji_red.""));
      }
      else{
        $red_izmjena=$id_zamjena;
      }
      }}
      }



      /*   $xml=simplexml_load_file("unconfirmedReviews.xml");
         $count = 0;
         $xml1 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><unconfirmedReviews></unconfirmedReviews>');
         $xml1->addAttribute('version', '1.0');
         $revs = $xml->children();
         foreach( $revs as $rev){
           $glupost1=$rev->ID."";
           $glupost2=$koji_red."";
         if ($glupost2 != $glupost1) {
           $review= $xml1->addChild('review');
           $review->addChild('ID', htmlspecialchars($rev->ID));
           $review->addChild('Name', htmlspecialchars($rev->Name));
           $review->addChild('Email', htmlspecialchars($rev->Email));
           $review->addChild('Title', htmlspecialchars($rev->Title));
           $review->addChild('Text', htmlspecialchars($rev->Text));
           $pictures=$review->addChild('Pictures');
           $pics=$rev->Pictures;
           $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
           $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
           $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));

         }}
          $xml1->asXML("unconfirmedReviews.xml");
       }
       else if($_REQUEST[$keys[$key]]=="Approve"){
         $xml=simplexml_load_file("unconfirmedReviews.xml");
         $count = 0;
         $xml1 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><unconfirmedReviews></unconfirmedReviews>');
         $xml1->addAttribute('version', '1.0');
         $revs = $xml->children();
         foreach( $revs as $rev){
           $glupost1=$rev->ID."";
           $glupost2=$koji_red."";
         if ($glupost2 != $glupost1) {
           $review= $xml1->addChild('review');
           $review->addChild('ID', htmlspecialchars($rev->ID));
           $review->addChild('Name', htmlspecialchars($rev->Name));
           $review->addChild('Email', htmlspecialchars($rev->Email));
           $review->addChild('Title',htmlspecialchars( $rev->Title));
           $review->addChild('Text', htmlspecialchars($rev->Text));
           $pictures=$review->addChild('Pictures');
           $pics=$rev->Pictures;
           $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
           $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
           $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));
         }
        else{
          if (file_exists("reviews.xml"))
          {
           $xml2=simplexml_load_file("reviews.xml");
           $review= $xml2->addChild('review');
           $review->addChild('ID', htmlspecialchars($rev->ID));
           $review->addChild('Name', htmlspecialchars($rev->Name));
           $review->addChild('Email',htmlspecialchars( $rev->Email));
           $review->addChild('Title', htmlspecialchars($rev->Title));
           $review->addChild('Text', htmlspecialchars($rev->Text));
           $pictures=$review->addChild('Pictures');
           $pics=$rev->Pictures;
           $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
           $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
           $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));
           $xml2->asXML("reviews.xml");
          }
          else {
            $xml2 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><reviews></reviews>');
            $xml2->addAttribute('version', '1.0');
            $review= $xml2->addChild('review');
            $review->addChild('ID', htmlspecialchars($rev->ID));
            $review->addChild('Name', htmlspecialchars($rev->Name));
            $review->addChild('Email',htmlspecialchars( $rev->Email));
            $review->addChild('Title', htmlspecialchars($rev->Title));
            $review->addChild('Text', htmlspecialchars($rev->Text));
            $pictures=$review->addChild('Pictures');
            $pics=$rev->Pictures;
            $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
            $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
            $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));
            $xml2->asXML("reviews.xml");
          }
       }
     }
       $xml1->asXML("unconfirmedReviews.xml");
}
else if ($_REQUEST[$keys[$key]]=="Save"){
  $xml=simplexml_load_file("unconfirmedReviews.xml");
  $count = 0;
  $xml1 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><unconfirmedReviews></unconfirmedReviews>');
  $xml1->addAttribute('version', '1.0');
  $revs = $xml->children();
  foreach( $revs as $rev){
    $glupost1=$rev->ID."";
    $glupost2=$koji_red."";
  if ($glupost2 != $glupost1) {
    $review= $xml1->addChild('review');
    $review->addChild('ID', htmlspecialchars($rev->ID));
    $review->addChild('Name', htmlspecialchars($rev->Name));
    $review->addChild('Email',htmlspecialchars( $rev->Email));
    $review->addChild('Title', htmlspecialchars($rev->Title));
    $review->addChild('Text', htmlspecialchars($rev->Text));
    $pictures=$review->addChild('Pictures');
    $pics=$rev->Pictures;
    $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
    $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
    $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));

  }
else{
  $review= $xml1->addChild('review');
  $review->addChild('ID', htmlspecialchars($rev->ID));
  $review->addChild('Name', htmlspecialchars($rev->Name));
  $review->addChild('Email',htmlspecialchars( $rev->Email));
  $review->addChild('Title', htmlspecialchars($rev->Title));
  $review->addChild('Text', htmlspecialchars($_POST['Tekst']));
  $pictures=$review->addChild('Pictures');
  $pics=$rev->Pictures;
  $pictures->addChild('Picture1',htmlspecialchars($pics->Picture1));
  $pictures->addChild('Picture2',htmlspecialchars($pics->Picture2));
  $pictures->addChild('Picture3',htmlspecialchars($pics->Picture3));
}
}
   $xml1->asXML("unconfirmedReviews.xml");

    $red_izmjena=-1;
 }*/

 ?>
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
            <form action="unconfirmedReviews.php" method="post">
            <div class="titlerev"><h1>Unconfirmed reviews</h1></div>
            <table>
              <tr>
                <th>
                  Title
                </th>
                <th>
                  Autor
                </th>
                <th>
                  Email
                </th>
                <th colspan=4>
                  Text
                </th>
                <th>
                  Option 1
                </th>
                <th>
                  Option 2
                </th>
                <th>
                  Option 3
                </th>
              </tr>
              <?php
              $broj = 0;
              $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
              $veza->exec("set names utf8");
               $rez = $veza -> query("SELECT id, name, email, title,text  FROM unconfirmedreviews");
               if ($rez!=false)
               {
                 $rezultat=$rez->fetchAll();
                 if($rezultat!=null){
                   foreach ($rezultat as $review) {
                     echo '<tr>';
                     echo  '<td>'.htmlspecialchars($review['title']).'</td>';
                     echo '<td>'.htmlspecialchars($review['name']).'</td>';
                     echo '<td>'.htmlspecialchars($review['email']).'</td>';
                   if($broj==$red_izmjena){
                     echo '<td colspan=4><textarea rows=20 maxlength="4000" name="Tekst">'.htmlspecialchars($review['text']).'</textarea></td>';
                     echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review['id']. '_'.$broj.'"value="Save">';
                   }
                   else {
                     echo '<td colspan=4>'.htmlspecialchars($review['text']).'</td>';
                    echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review['id']. '_'.$broj.'"value="Edit">';
                   }
                   echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review['id']. '_'.$broj.'"value="Delete">';
                   echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review['id']. '_'.$broj.'"value="Approve">';
                  echo "</tr>";
                  $broj++;
                }
              }
              else echo '<h1>Unconfirmed Reviews do not exist';
            }
            else echo '<h1>Unconfirmed Reviews do not exist</h1>';
          /*    if (file_exists("unconfirmedReviews.xml"))
              {
               $xml=simplexml_load_file("unconfirmedReviews.xml");
               $sveRev = $xml->children();
               foreach( $sveRev as $review)
               {
                 echo '<tr>';
                 echo  '<td>'.htmlspecialchars($review->Title).'</td>';
                 echo '<td>'.htmlspecialchars($review->Name).'</td>';
                 echo '<td>'.htmlspecialchars($review->Email).'</td>';
               if($broj==$red_izmjena){
                 echo '<td colspan=4><textarea rows=20 maxlength="4000" name="Tekst">'.htmlspecialchars($review->Text).'</textarea></td>';
                 echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review->ID. '_'.$broj.'"value="Save">';
               }
               else {
                 echo '<td colspan=4>'.htmlspecialchars($review->Text).'</td>';
                echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review->ID. '_'.$broj.'"value="Edit">';
               }
               echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review->ID. '_'.$broj.'"value="Delete">';
               echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$review->ID. '_'.$broj.'"value="Approve">';
              echo "</tr>";
              $broj++;
                 }
               }*/
              ?>
            </table>
            <br>
              </form>
          </div>

        </div>
        <div id="myModal" class="modal" onclick="closeButton()">
            <span class="close" onclick="closeButton()">&times;</span>
            <img class="modal-content" id="modalImage" src="http://www.vishmax.com/en/innovattive-cms/themes/themax-theme-2015/images/no-image-found.gif" alt="Review">
        </div>
      </div>
  </body>
  </html>
