<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="#">
  <title>萬年曆作業</title>
  <style>
    /*請在這裹撰寫你的CSS*/
    * {
      margin: 0px auto;
      width: 90%;
      font-family: Arial, Helvetica, sans-serif;
      height: 95%;
    }

    .top {
      height: 20%;
      background-color: lightblue;
      margin-top: 20px;
    }

    .atag {
      float: left;
      width: 89%;
      height: 30%;
      background-color: lightcoral;

    }

    .aside {
      float: left;
      width: 10%;
      height: 80%;
      background-color: lightpink;
    }

    table {
      border-collapse: collapse;
      clear: both;
      table-layout: fixed;

    }

    .content {
      float: left;
      width: 89%;
      height: 49.5%;
      background-color: lightslategray;
    }

    body>*,
    thead,
    td {
      border: 1px solid #ccc;
    }
    thead {
      border-style: none;
    }
  </style>
</head>

<body>
  <?php
  /*請在這裹撰寫你的萬年曆程式碼*/
  $cal = [];
  //isset判斷如果$_GET有抓到值就用,沒抓到就改用date()抓的值
  $month = (isset($_GET['m'])) ? $_GET['m'] : date("n");
  $year = (isset($_GET['y'])) ? $_GET['y'] : date("Y");
  
  //月跟年的條件判斷式, 避免$_GET抓'm'時一直加或一直減
  if ($month > 12) {
    $month = 1;
    $year = $year + 1;
  }
  if ($month < 1) {
    $month = 12;
    $nextMonth = 1;
    $year = $year - 1;
  }

  $nextMonth = $month + 1;
  $prevMonth = $month - 1;

  //echo $nextMonth;
  //echo "<br>";
  //echo $prevMonth;
  /*算出該月的第一天是禮拜幾, 月曆第一周前面有幾個空格, 
該月最後一號就可得知該月有幾天, 算出該月有幾周要畫在月曆上,
要用ceil無條件進位*/

  $firstDay = $year . '-' . $month . '-1';
  $firstdayWeek = date('N', strtotime($firstDay));
  $monthDays = date('t', strtotime($firstDay));
  $lastDay = $year . '-' . $month . '-' . $monthDays;
  $spaceDays = $firstdayWeek - 1;
  $week = ceil(($monthDays + $spaceDays) / 7);
  $spaceDays2 = $week * 7 - $monthDays;
  //先把第一周的空格加進陣列
  for ($i = 0; $i < $spaceDays; $i++) {
    $cal[] = '';
  }
  //然後把該月的幾號加入陣列
  for ($i = 0; $i < $monthDays; $i++) {
    $cal[] = date('Y-m-d', strtotime("+$i days", strtotime($firstDay)));
  }

  for ($i = 0; $i < ($spaceDays2 - 1); $i++) {
    $cal[] = '';
  }

  //從這邊開始引入比賽日程 $icsData3含有開始時間與結束時間跟賽程
  $icalString = file_get_contents("Golden State Warriors - Warriors.ics");
  $icsData = explode("+", $icalString);
  foreach ($icsData as $key => $value) {
    $icsData2[] = explode("=", $value);
  }
  for($i = 0;$i < count($icsData2); $i++){
    if($i%3==1 | $i%3==2){foreach($icsData2[$i] as $key => $value){
        $icsData3[] = explode(" ", $value);}
    }else{
        $icsData3[] = $icsData2[$i];
    }
}
// for($i=0; $i<count($icsData3); $i++){
//   for($j=0; $j<count($icsData3[$i]);$j++){
//  $key = array_search("$icsData3[$i][$j]",$calFull);
//   }
//    echo $key;
// }
// echo "<pre>";
// echo count($icsData3);
// echo "</pre>";
  ?>
  <!-- 利用a tag建立上個月以及下個月的超連結, 
連結內要設定$year以及$month的變數,問號要
記得變數才能被GET -->
  <header class="top">top</header>
  <aside class="aside">aside</aside>
  <div class="atag">
    <a href="?y=<?= $year; ?>&m=<?= $prevMonth; ?>">上個月</a>
    <H1><?= $year; ?>年<?= $month; ?>月</H1>
    <a href="?y=<?= $year; ?>&m=<?= $nextMonth; ?>">下個月</a>
  </div>
  <!-- 列印Table,陣列$i從0開始, 所以對7取餘數,
代表第八天要列印新一週的tr,日數放入td,$i對6取餘數
也就是0~6等於列印了7天, 要用</tr>關掉 -->
  <section class="content">
    <table>
      <thead>
        <tr>
          <td scope="row">Mon</th>
          <td scope="row">Tue</th>
          <td scope="row">Wed</th>
          <td scope="row">Thu</th>
          <td scope="row">Fri</th>
          <td scope="row">Sat</th>
          <td scope="row">Sun</th>
        </tr>
      </thead>
      <?php
      $event = "Warriors at Spurs";
      

      echo "<tbody>";
      foreach ($cal as $i => $day) {
        if ($i % 7 == 0) {
          echo "<tr>";
        }
        echo "<td>$day<br>$event</td>";
        
        if ($i % 7 == 6) {
          echo "</tr>";
        }
      }
      echo "</tbody>";
      ?>
    </table>
  </section>

</body>

</html>