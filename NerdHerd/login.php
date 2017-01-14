<?php
$db_server= getenv('NHERD_SERVICE_HOST');
$db_username=getenv('MYSQL_USER');
$db_pw = getenv('MYSQL_PASSWORD');
$db = getenv('MYSQL_DATABASE');

?>
<?php
session_start();
if(isset($_POST['action']) && $_POST['action']==="Login"){
/*  if (file_exists("users.xml"))
  {
    $xml=simplexml_load_file("users.xml");
    $usern=$xml->Username."";
    $passn=$xml->Password."";
    $poslaniUser=htmlspecialchars($_POST['username'])."";
    $poslaniPass=htmlspecialchars($_POST['password'])."";

    if($usern===$poslaniUser){
      if($passn===md5($poslaniPass)){
        $_SESSION['user']=$_POST['username'];
        header('Location: ' . "index.php");
        die();
      }
      else echo "Wrong password";
    }
  }*/
  $poslaniUser=htmlspecialchars($_POST['username'])."";
  $poslaniPass=htmlspecialchars($_POST['password'])."";
      $veza = new PDO("mysql:dbname=".$db.";host=".$db_server, $db_username, $db_pw);
      $veza->exec("set names utf8");
      $upit = $veza ->query("SELECT id, username, password, button from users where username='".$poslaniUser."'");
      $rezultat = $upit -> fetch();
      if($rezultat==NULL) print "Username does not exist";
      else{
              if($rezultat['password']==md5($poslaniPass)){
                $_SESSION['user']=$_POST['username'];
                $_SESSION['button']=$rezultat['button']."";
                header('Location: ' . "index.php", true, 303);
                die();
              }
              else print "Pogresan password";
          }
      }

if(isset($_GET['action']) && $_GET['action']==="logout"){
  session_destroy();
  header('Location: ' . "index.php", true, 303);
  die();
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

              <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">
          <div class="glavne">
              <h1>Login</h1>
              <form class="forma-login" action="login.php" method="post" onsubmit="return unosLog()">

                <div class="unos">
                  <label>Username:</label>
                  <input id="ime_polje" type="text" name="username" value="" required><br>
                </div>

                <div class="unos">
                  <label>Password:</label>
                  <input id="mail_polje" type="password" name="password" value="" required><br>
                </div>
                  <br>
                  <div class="unoslog">
                      <ul class="greska"></ul>
                  </div>
                <input class="dugme" type="submit" name="action" value="Login">
                <br>
              </form>
                <br>
                </div>
                    </div>
                  </div>
            </body>
            </html>
