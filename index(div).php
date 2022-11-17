<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆div</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css
">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js
">
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>

<body>
    <?php
    //以下製作欲導入的球隊賽程陣列.
    $icalString = file_get_contents("Golden State Warriors - Warriors.ics"); //將原本資料來源讀入PHP成為字串.
    $icsData = explode("+", $icalString); //將原本字串的文件用"+"炸開成為陣列.
    foreach ($icsData as $value) {
        $icsDataclean[] = $value;
    }

    for ($i = 0; $i < count($icsDataclean); $i++) {    //將$icsData陣列的鍵設定為新陣列的鍵,再將$icsData陣列的值設定為新陣列的值.
        if ($i % 2 == 0 && $i != 0) {
            $gameSchedule[trim($icsDataclean[$i - 1])] = "$icsDataclean[$i]";
        }
    }
    // echo "<pre>";
    // print_r($gameSchedule);
    // echo "</pre>";

    //以下製作欲導入的球隊比賽開始時間, 最後改成鍵=賽程年月日*值=比賽幾點開始(美國時間)
    $icalString = file_get_contents("Warriors(starttime).ics");
    $icalDate = explode("+", $icalString);
    for($i=0;$i<count($icalDate);$i++){
        if($i%3==2){
            $icalTime[$icalDate[$i-1]]=$icalDate[$i];
        }
    }
    //轉換成台灣時間:
    foreach($icalTime as $key => $value){
        $icalTaiwantime[$key]=date("H:i",strtotime("$key.$value+8 hours"));
    }


    $cal = [];  //設立一個空陣列來裝要輸出的年月日

    $month = (isset($_GET['m'])) ? $_GET['m'] : date('n');
    $year = (isset($_GET['y'])) ? $_GET['y'] : date('Y');

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

    $firstDay = $year . '-' . $month . '-1';
    $firstDayweek = date('N', strtotime($firstDay));
    $monthDays = date('t', strtotime($firstDay));
    $lastDay = $year . '-' . $month . '-' . $monthDays;
    $spaceDays = $firstDayweek - 1;
    $weeks = ceil(($monthDays + $spaceDays) / 7);
    $spaceDaysrare = $weeks * 7 - $monthDays - $spaceDays;
    //以下製作該月日期的陣列.
    for ($i = 0; $i < $spaceDays; $i++) {
        $cal[] = '';
    }
    for ($i = 0; $i < $monthDays; $i++) {
        $cal[] = date('Y-m-d', strtotime("+$i days", strtotime($firstDay)));
    }
    for ($i = 0; $i < $spaceDaysrare; $i++) {
        $cal[] = '';
    }


    ?>
    <div class="header">
        <div class="pic">
            <img src="./warriors.png" alt="">
        </div>
        <div class="atag">
            <a href="?y=<?= $year; ?>&m=<?= $prevMonth; ?>" style="text-decoration:none; color:rgb(0, 67, 137)">上個月</a>
            <br>
            <a href="" style="text-decoration:none; color:rgb(0, 67, 137)"><?= $year; ?>年<?= $month; ?>月</a>
            <br>
            <a href="?y=<?= $year; ?>&m=<?= $nextMonth; ?>" style="text-decoration:none; color:rgb(0, 67, 137)">下個月</a>
            <br>
            <div class="box">
                <p>play at home</p>
            </div>
        </div>
    </div>

    <div class="section">
        <aside class="aside">
            <?php
            echo date('F Y', strtotime($firstDay));
            ?>
        </aside>
        <div class="tittle">
            <div class="weekday">
                <div>MON</div>
                <div>TUE</div>
                <div>WED</div>
                <div>THU</div>
                <div>FRI</div>
                <div>SAT</div>
                <div>SUN</div>
            </div>
            <div class="cal">
                <?php
                foreach ($cal as $i => $day) {
                    if ($day != "") {
                        $show = explode("-", $day)[2];
                    } else {
                        $show = "";
                    }

                    if (array_key_exists($day, $gameSchedule) && false !== (strpos($gameSchedule[$day], "vs."))) {
                        echo "<div class='date' style='background-color:rgb(255,197,45)'>";
                        echo $show;
                        echo "<div>開賽時間:{$icalTaiwantime[$day]}<br>{$gameSchedule[$day]}</div>";
                        echo "</div>";
                    } elseif (array_key_exists($day, $gameSchedule)) {
                        echo "<div class='date'>";
                        echo $show;
                        echo "<button type='button' class='btn btn-secondary' data-bs-toggle='popover' title='gogogo' >
                        開賽時間:{$icalTaiwantime[$day]}<br>{$gameSchedule[$day]}</button>";
                        // echo "<div>{$gameSchedule[$day]}</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='date'>$show</div>";
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <!-- <footer class="footer">
        footer
    </footer> -->
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
</body>

</html>