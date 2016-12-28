<?php

$output="";
  if(isset($_POST['searchVal'])  && !empty(['searchVal'])){
    $searchq=$_POST['searchVal'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
    if (file_exists("unconfirmedReviews.xml"))
    {
      $xml=simplexml_load_file("unconfirmedReviews.xml");
      $sviRevs = $xml->children();
      $brojac=0;
      foreach( $sviRevs as $review)
      {
        if (stripos($review->Title,$searchq)!==false || stripos($review->Name,$searchq)!==false)
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
    }
echo ($output);

?>
