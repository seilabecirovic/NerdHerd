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
              
              <li class="icon"> <a href="javascript:void(0);" onclick="DDFunkcija()">&#9776;</a>
            </ul>
        </div>
        <div id="polje">

<div class="glavne">
    <div class="omeni">
        <h1>About</h1>
        <br>
        <p>After a long day at work, one must find a way to relax. Be it with books, movies, TV shows, music and video games, we all relax in our own way. It is quite hard to find a good show, book or a movie. This website will provide you with spoiler-free
            reviews of each of the listed items. Based on the reviews, you can form your own opinion whether to watch something.
        </p>
        <br>
        <p>
            NerdHerd is a website created for the lack of one place for all the reviews. Opening a different web pages for different things can be quite tiresome. That is why we at NerdHerd want to provide you with hand-picked reviews about entertainment media. Feel
            free to add your own reviews, by which you will expand our little community.
        </p>
    </div>
</div>
</div>
</div>

</body>

</html>
