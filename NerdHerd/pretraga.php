<?php
session_start();
 ?>
<?php
$brojac=0;
$output='';
if(isset($_POST['searchVal'])  && !empty(['searchVal'])){
  $output='';
  $searchq=htmlspecialchars($_POST['searchVal']);
  $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
  $searchq='%'.$searchq.'%';
  $veza = new PDO("mysql:dbname=nerdherd;host=localhost;charset=utf8", "spirala4", "spirala4");
  $veza->exec("set names utf8");
   $rez = $veza -> prepare ("SELECT id, name, title FROM reviews WHERE name LIKE :nesto OR title LIKE :jedno LIMIT 10");
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
}
   echo ($output);

/*$output="";
  if(isset($_POST['searchVal'])  && !empty(['searchVal'])){
    $searchq=htmlspecialchars($_POST['searchVal']);
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    if (file_exists("reviews.xml"))
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
        if ($brojac==10) break;
      }
      if ($brojac==0)
        $output='There are no results';
    }
    else  $output='Search is not available';
  }*/
?>
