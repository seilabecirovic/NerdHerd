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
if($_GET)
{
  $keys=array_keys($_GET);
  foreach ($keys as $key => $value) {
    if($_REQUEST[$keys[$key]]=="Delete" || $_REQUEST[$keys[$key]]=="Approve"){
      $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
      $veza->exec("set names utf8");
      $veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $koji_red=intval(explode("_",$keys[$key])[1]);
       if($_REQUEST[$keys[$key]]=="Delete"){
         $sql = "DELETE FROM uncomments WHERE id = :id";
         $unos = $veza->prepare($sql);
        $unos->execute(array("id"=>$koji_red.""));
       }
       if($_REQUEST[$keys[$key]]=="Approve"){
         $sql = "INSERT INTO comments (reviID,name,quality,text)
         VALUES (:reviID, :name, :quality, :text)";
         $sklj = $veza -> query("SELECT * FROM uncomments WHERE id=".$koji_red."");
         $something = $sklj -> fetch();
         $unos = $veza->prepare($sql);
         $unos->execute(array("reviID"=>$something['revID'],"name"=>$something['name'],"quality"=>$something['quality'],
       "text"=>$something['text']));
       $sql = "DELETE FROM uncomments WHERE id = :id";
       $unos = $veza->prepare($sql);
       $unos->execute(array("id"=>$koji_red.""));
     }}
   }
 }

      /*   $xml=simplexml_load_file("uncomments.xml");
         $count = 0;
         $xml1 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><comments></comments>');
         $xml1->addAttribute('version', '1.0');
         $koments = $xml->children();
         foreach( $koments as $koment){
           $glupost1=$koment->ID."";
           $glupost2=$koji_red."";
         if ($glupost2 != $glupost1) {
           $comment= $xml1->addChild('comment');
           $comment->addChild('ID', htmlspecialchars($koment->ID));
           $comment->addChild('RevID',htmlspecialchars($koment->RevID));
           $comment->addChild('Name', htmlspecialchars($koment->Name));
           $comment->addChild('Quality', htmlspecialchars($koment->Quality));
           $comment->addChild('Text', htmlspecialchars($koment->Text));
         }}
          $xml1->asXML("uncomments.xml");
       }
       if($_REQUEST[$keys[$key]]=="Approve"){
        $xml=simplexml_load_file("uncomments.xml");
         $count = 0;
         $xml1 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><comments></comments>');
         $xml1->addAttribute('version', '1.0');
         $koments = $xml->children();
         foreach( $koments as $koment){
           $glupost1=$koment->ID."";
           $glupost2=$koji_red."";
         if ($glupost2 != $glupost1) {
           $comment= $xml1->addChild('comment');
           $comment->addChild('ID', htmlspecialchars($koment->ID));
           $comment->addChild('RevID',htmlspecialchars($koment->RevID));
           $comment->addChild('Name', htmlspecialchars($koment->Name));
           $comment->addChild('Quality', htmlspecialchars($koment->Quality));
           $comment->addChild('Text', htmlspecialchars($koment->Text));
         }
          else{
          if (file_exists("comments.xml"))
          {
           $xml2=simplexml_load_file("comments.xml");
           $comment= $xml2->addChild('comment');
           $comment->addChild('ID', htmlspecialchars($koment->ID));
           $comment->addChild('RevID',htmlspecialchars($koment->RevID));
           $comment->addChild('Name', htmlspecialchars($koment->Name));
           $comment->addChild('Quality', htmlspecialchars($koment->Quality));
           $comment->addChild('Text', htmlspecialchars($koment->Text));
           $xml2->asXML("comments.xml");
          }
          else {
            $xml2 = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><comments></comments>');
            $xml2->addAttribute('version', '1.0');
            $comment= $xml2->addChild('comment');
            $comment->addChild('ID', htmlspecialchars($koment->ID));
            $comment->addChild('RevID',htmlspecialchars($koment->RevID));
            $comment->addChild('Name', htmlspecialchars($koment->Name));
            $comment->addChild('Quality', htmlspecialchars($koment->Quality));
            $comment->addChild('Text', htmlspecialchars($koment->Text));
            $xml2->asXML("comments.xml");
          }}
        }
          $xml1->asXML("uncomments.xml");
       }
}
}
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
            <form action="unconfirmedComments.php" method="get">
            <div class="titlerev"><h1>Unconfirmed comments</h1></div>
            <table>
              <tr>
                <th>
                  Name
                </th>
                <th>
                  Quality
                </th>
                <th>
                  Text
                </th>
                <th>
                  Option 1
                </th>
                <th>
                  Option 2
                </th>
              </tr>
              <?php
              $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
              $veza->exec("set names utf8");
               $rez = $veza -> query("SELECT id, name, quality,text  FROM uncomments");
               if ($rez!=false)
               {
                 $rezultat=$rez->fetchAll();
                 if($rezultat!=null){
                   foreach ($rezultat as $koment) {
                     echo '<tr>';
                     echo  '<td>'.htmlspecialchars($koment['name']).'</td>';
                     echo '<td>'.htmlspecialchars($koment['quality'])."".'</td>';
                     echo '<td>'.htmlspecialchars($koment['text']).'</td>';
                     echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$koment['id']. '"value="Delete">';
                     echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$koment['id'].'"value="Approve">';
                     echo "</tr>";
                     }
                   }
                   else echo '<h1>Unconfirmed comments do not exist';
                 }
                 else echo '<h1>Unconfirmed comments do not exist';

          /*    if (file_exists("uncomments.xml"))
              {
               $xml=simplexml_load_file("uncomments.xml");
               $koments = $xml->children();
               foreach( $koments as $koment)
               {

                 echo '<tr>';
                 echo  '<td>'.htmlspecialchars($koment->Name).'</td>';
                 echo '<td>'.htmlspecialchars($koment->Quality)."".'</td>';
                 echo '<td>'.htmlspecialchars($koment->Text).'</td>';
                 echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$koment->ID. '"value="Delete">';
                 echo '<td><input class="komentbutton" type="submit" name="Opcija_'.$koment->ID.'"value="Approve">';
                 echo "</tr>";
                 }
               }*/
               ?>
            </table>
            <br>
              </form>
          </div>

        </div>
      </div>
  </body>
  </html>
