<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clickCounter
 *
 * @author aastle
 */
$aCounter = new counter();
if (!isset($_SESSION['translateCount'])) {
  $_SESSION['translateCount'] = 0;
} else {
  $_SESSION['translateCount']++;
  
  $aCounter->count = $_SESSION['translateCount'];
  
}


$jvalue = json_encode($aCounter);
echo $jvalue;
class counter {
   public  $count = 100;
}
?>
