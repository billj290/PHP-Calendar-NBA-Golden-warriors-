<?php
//讀入賽程,變成字串.
$icalString = file_get_contents("Golden State Warriors - Warriors.ics");
echo $warriorString;
//將賽程用"BEGIN:"分開, 變成VEVENT 及 VALARM的陣列.
//  $icsData = explode("BEGIN:VEVENT", $icalString);
// echo "<pre>";
// print_r($icsData);
// echo "</pre>";

// $icsDates = array();
// foreach ( $icsData as $key => $value ) {
//     $icsDatesMeta [$key] = explode ( "\n", $value );
// }
// echo "<pre>";
// print_r($icsData);
// echo "</pre>";
// for($i=0;$i<189;$i++){
//  if(strstr($icsData[$i],"Knicks")){
//     $a[]=$icsData[$i];
//  }
// }
//  print_r($a);
// foreach($a as $key => $value){
//     $b[]=explode(".",$a[$key]);
// }
// echo $a[0];
// echo "<pre>";
// print_r($b);
// echo "</pre>";
// foreach($b as $key => $value){
//     foreach($b[$key] as $key2 => $value2)
//     {
//     $c[$key][]=explode(":",$b[$key][$key2]);
//     }
// }
// echo "<pre>";
// print_r($c);
// echo "</pre>";
// for($i=0;$i<3;$i++){
//     echo $c[$i][1][1];
//     echo "<hr>";
// }
?>