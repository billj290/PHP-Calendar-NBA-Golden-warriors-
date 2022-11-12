<?php
//將原本資料來源讀入PHP成為字串.
$icalString = file_get_contents("Golden State Warriors - Warriors.ics");
// echo $icalString;

//將原本字串的文件用"+"炸開成為陣列.
$icsData = explode("+", $icalString);
// echo "<pre>";
// print_r($icsData);
// echo "</pre>";

for($i=0;$i<count($icsData);$i++){
    if($i%2==0 && $i !=0){
        $game[$icsData[$i-1]]= "$icsData[$i]";
    }
}
// echo "<pre>";
// print_r($game);
// echo "</pre>";
// 用"="在炸開一次
foreach ($icsData as $key => $value) {
    $icsData2[] = explode("=", $value);
}

// echo "<pre>";
// print_r($icsData2);
// echo "</pre>";

// 二維陣列改為一維陣列法一
// for ($i = 0; $i < count($icsData2); $i++) {
//     foreach ($icsData2[$i] as $key => $value) {
//         $icsData3[] = $value;
//     }
// }
// 二維陣列改為一維法二
foreach($icsData2 as $value){
    foreach($value as $value2){
    $icsData3[] = $value2;
    }
} 
// echo "<pre>";
// print_r($icsData3);
// echo "</pre>";

foreach ($icsData3 as $key => $value) {
    if ($key % 4 == 2) {
        $icsData4[] = explode(" ", $value);
    } else {
        $icsData4[] = $value;
    }
}
// echo "<pre>";
// print_r($icsData4);
// echo "</pre>";

foreach ($icsData4 as $key => $value) {
    if (is_array($icsData4[$key])) {
        foreach ($value as $key2 => $value2) {
            $icsData5[] = $value2;
        }
    } else {
        $icsData5[] = $value;
    }
}
// echo "<pre>";
// print_r($icsData5);
// echo "</pre>";

$array1 = array("2022-11-06" ,"2022-11-07 ","2022-11-08","2022-11-09");
$array2 = array("2022-11-06", "2022-11-06","1vs2" ,"2022-11-07","2022-11-07",
"1vs3","2022-11-08","2022-11-08","1vs4");

// foreach($array2 as $key2 => $value2){
//     foreach($array1 as $key => $value){
//         if($key2%3==0 && $value == $value2){
//             echo $array2[$key2+2];
//             echo"<br>";
//         }
//     }
// }

// if(in_array("1",$array1)){
//     echo "找到";
// } else {
//     echo "沒找到";
// }

// foreach($array1 as $key => $value){
//     if(strpos($value, "11")){
//         echo "35";
//     }else{
//     echo "false";
// }
// }
// echo count($icsData5);
// foreach ($icsData5 as $key => $value) {
//     if($key<736){
//         $gameTimekey = 2 * (1 + (4 * $key));
//     }
// }

// foreach($icsData5 as $key => $value){
//     $icsData6=["2022-07-09" => "Warriors at Knicks (NBA Summer League)"];
//     if($key%5==2 && $key<286){
//         $icsData6[]=[$value => $icsData5[$key+3]];
//         echo "<pre>";
//         print_r($icsData6);
//         echo "</pre>";
//     }
// }
// echo "<pre>";
// print_r($icsData6);
// echo "</pre>";

// $icsData7 = array_combine($icsData3, $icsData3);
// echo "<pre>";
// print_r($icsData3);
// echo "</pre>";

// $icsData8 = [];
// foreach($icsData3 as $key => $value){
//     if($key%2==0 && $key%4==2){
//         $icsData8[$icsData3[$key]]=array_push($icsData3, $key%2==0 && $key%4==0);
// }
// }
// echo "<pre>";
// print_r($icsData8);
// echo "</pre>";

$a = ['2022-11-01'=>'warriors vs. knicks', '2022-11-02'=>'warriors at knicks'];
foreach($a as $key => $value)
if(strpos($a[$key],'vs.')){
    echo "home";
}else{
    echo "away";
}