<?php
$icalString = file_get_contents("Warriors(starttime).ics");
// echo "<pre>";
// echo $icalString;
// echo "</pre>";

$icalDate = explode("+", $icalString);
// echo "<pre>";
// print_r($icalDate);
// echo "</pre>";

for($i=0;$i<count($icalDate);$i++){
    if($i%3==2){
        $icalTime[$icalDate[$i-1]]=$icalDate[$i];
    }
}
echo "<pre>";
print_r($icalTime);
echo "</pre>";

// $value = "2022-11-18 03:00";
// $value2 = date("H:i",strtotime("$value +8 hours"));
// echo $value2;

// 轉成台灣的時間+8小時
foreach($icalTime as $key => $value){
    $icalTaiwantime[$key]=date("H:i",strtotime("$key.$value+8 hours"));
}

echo "<pre>";
print_r($icalTaiwantime);
echo "</pre>";

?>