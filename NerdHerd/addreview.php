<?php
session_start();
 ?>
 <?php
 $GLOBALS["IHaveCalledSrandBefore"]=1;
if (!$GLOBALS["IHaveCalledSrandBefore"]++) {
  srand((double) microtime() * 1000000);
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
$posted = false;
$result = false;
 if( $_POST ) {
   define("UPLOAD_DIR", "uploads/");
   $path ="uploads/";
   $path1 ="uploads/";
   $path2 ="uploads/";
   $result = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
        exit;

    }
    $fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
     }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $name);
    if (!$success) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
    }
    chmod(UPLOAD_DIR . $name, 0644);
    $result = true;
    $path .=$name;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile1"])) {
  $result = false;
    $myFile = $_FILES["myFile1"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
    }
    $fileType = exif_imagetype($_FILES["myFile1"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
     }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $name);
    if (!$success) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
    exit;
    }
    chmod(UPLOAD_DIR . $name, 0644);
    $result = true;
    $path1 ="uploads/".$name;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["myFile2"])) {
  $result = false;
    $myFile = $_FILES["myFile2"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
    }
    $fileType = exif_imagetype($_FILES["myFile2"]["tmp_name"]);
    $allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
    if (!in_array($fileType, $allowed)) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
     }
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }
    $success = move_uploaded_file($myFile["tmp_name"],UPLOAD_DIR . $name);
    if (!$success) {
      echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
      exit;
    }
    chmod(UPLOAD_DIR . $name, 0644);
    $result = true;
    $path2 .=$name;
}
   $posted = true;
   $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
   $veza->exec("set names utf8");
   $veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO unconfirmedreviews (name,email,title,text,picture1,picture2,picture3)
   VALUES (:name, :email, :title, :text, :picture1, :picture2, :picture3)";
   $unos = $veza->prepare($sql);
    $result= $unos->execute(array("name"=>$_POST['name'],"email"=> $_POST['email'],"title"=>$_POST['title'],
 "text"=>$_POST['Tekst'],"picture1"=>$path,"picture2"=>$path1,"picture3"=>$path2));

}

/*   if (file_exists("unconfirmedReviews.xml"))
   {
    $xml=simplexml_load_file("unconfirmedReviews.xml");
    $last_id   = count($xml) - 1;
    $etwas = $xml->children();
     $randval = rand(1,255);
    $review= $xml->addChild('review');
    $review->addChild('ID', $randval."");
    $review->addChild('Name', htmlspecialchars($_POST['name']));
    $review->addChild('Email', htmlspecialchars($_POST['email']));
    $review->addChild('Title', htmlspecialchars($_POST['title']));
    $review->addChild('Text', htmlspecialchars($_POST['Tekst']));
    $pictures=$review->addChild('Pictures');
    $pictures->addChild('Picture1',htmlspecialchars($path));
    $pictures->addChild('Picture2',htmlspecialchars($path1));
    $pictures->addChild('Picture3',htmlspecialchars($path2));
    $result= $xml->asXML("unconfirmedReviews.xml");

   }
   else {
     $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><unconfirmedReviews></unconfirmedReviews>');
     $xml->addAttribute('version', '1.0');
     $review= $xml->addChild('review');
     $randval = rand(1,255);
     $review->addChild('ID', $randval."");
     $review->addChild('Name', htmlspecialchars($_POST['name']));
     $review->addChild('Email', htmlspecialchars($_POST['email']));
     $review->addChild('Title', htmlspecialchars($_POST['title']));
     $review->addChild('Text', htmlspecialchars($_POST['Tekst']));
     $pictures=$review->addChild('Pictures');
     $pictures->addChild('Picture1',htmlspecialchars($path));
     $pictures->addChild('Picture2',htmlspecialchars($path1));
     $pictures->addChild('Picture3',htmlspecialchars($path2));
     $result= $xml->asXML("unconfirmedReviews.xml");
   }
 }*/
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
              
              <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
          <?php
    if( $posted ) {
      if( $result )
        echo "<script type='text/javascript'>alert('Your review has been submitted successfully!')</script>";
      else
        echo "<script type='text/javascript'>alert('Your review has not been submitted!')</script>";
    }
  ?>
<div class="glavne">
    <div class="dodrev">
        <form class="forma-unosrev" name="forma-unosrev" action="" method="post" enctype="multipart/form-data" onsubmit="return unosRev()">
            <div class="unosrev">
                <label>Name</label>
                <input type="text" name="name" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Email</label>
                <input type="email" name="email" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Title</label>
                <input type="text" name="title" value="">
                <br>
            </div>
            <div class="unosrev">
                <label>Text</label>
                <textarea rows=10 maxlength="4000" name="Tekst"></textarea>
            </div>
            <div class="unosrev">
                <label>Image</label>
                <input class="picbutton" type="file" name="myFile" required>
                <input class="picbutton" type="file" name="myFile1" required>
                <input class="picbutton" type="file" name="myFile2" required>
            </div>
            <div class="unosrev">
                <ul class="greska"></ul>
            </div>
            <input class="revbutton" type="submit" value="Send">
        </form>
    </div>
    <div class="napomene">
        <h3> *Every review will be revised before publishing. Any writing, sign or visible representation that
          advocates or promotes the communication of which by any person would constitute an offence will be deleted. </h3>
    </div>
</div>

</div>
</div>

</body>

</html>
