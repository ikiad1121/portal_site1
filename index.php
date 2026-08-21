<?php
    session_start();
    date_default_timezone_set('Asia/Tokyo');

    $name = '';
    $date_y = date("Y");
    $date_m = date("m");
    $date_m1 = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $date_m2 = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $date_d = date("d");
    $date_w = date("w");
    $date_w1 = array('日', '月', '火', '水', '木', '金', '土');
    $date_w2 = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

    if((($date_y % 4) == 0 && ($date_y % 100) != 0)||($date_y % 400) == 0){
        $date_m_arr = $date_m2;
    }else{
        $date_m_arr = $date_m1;
    }

    if($_SESSION['userid'] && $_SESSION['gmail']){
        $json_file_path = 'assets/api/users.json'; // JSONファイルへのパス
        $json_string = file_get_contents($json_file_path);
        $json_string = mb_convert_encoding($json_string, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $data = json_decode($json_string,true);

        for ($i = 0; $i < count($data); $i++) {
            if($data) {
                if(
                    $_SESSION['userid'] == $data[$i]['userid'] &&
                    $_SESSION['gmail'] == $data[$i]['gmail']
                ){
                    $name = $data[$i]['firstname1'].' '.$data[$i]['lastname1'];
                }
            }
        }
    }else{
        header('location:php/login.php');
    }

    

    

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/color.css">
        <title><?php echo $name ?>さん ポータルサイト</title>
    </head>
    <body>
        <header>
            <div class="head">
                <img src="logo.png" alt="ABC">
                <h1>利用者ポータルサイト</h1>
            </div>
            <div class="head_right">
                <a href="php/logout.php" class="logout red_back red_text ov_600">ログアウト</a>
                <div id="cover_btn">
                    <a class="cover_btn" onclick="cover(0)">
                        <div class="cover_btn_line cover_btn_line1"></div>
                        <div class="cover_btn_line cover_btn_line2"></div>
                    </a>
                </div>
            </div>
        </header>
        <div id="cover" class="cover_close2"></div>
        <main>
            <!-- メイン項目 -->
            <section>
                <h2>
                    ようこそ、<?php echo $name ?>さん。<br>
                    今日は、
                    <span><?php echo $date_y ?></span>年
                    <span><?php echo $date_m ?></span>月
                    <span><?php echo $date_d ?></span>日
                    <span><?php echo $date_w1[date("w")] ?></span>曜日
                    です。
                </h2>
                <div class="row_list">
                    <div class="list_block red_back">
                        <img src="assets/image/no_photo1.png" class="list_block_img" alt="シフト提出">
                        <p class="list_block_txt">
                            1. <a>シフト提出</a>
                        </p>
                    </div>
                    <div class="list_block yellow_back">
                        <img src="assets/image/no_photo1.png" class="list_block_img" alt="面談予約">
                        <p class="list_block_txt">
                            2. <a>面談予約</a>
                        </p>
                    </div>
                    <div class="list_block green_back">
                        <img src="assets/image/no_photo1.png" class="list_block_img" alt="作品添削依頼">
                        <p class="list_block_txt">
                            3. <a>作品添削依頼</a>
                        </p>
                    </div>
                    <div class="list_block blue_back">
                        <img src="assets/image/no_photo1.png" class="list_block_img" alt="応募書類添削依頼">
                        <p class="list_block_txt">
                            4. <a>応募書類添削依頼</a>
                        </p>
                    </div>
                </div>
            </section>
            <!-- メッセージ -->
            <section>
                <div class="message">
                    <div class="message_main">
                        <p><?php echo $date_y ?>.<?php echo $date_m ?>.<?php echo $date_d ?> (<?php echo $date_w2[$date_w] ?>)</p>
                        <p>
                            <?php
                                //伝えたい内容は日によって異なるため、日ごとにメッセージに変化を加えている。
                                $message = '';
                                switch ($date_d) {
                                    case 1:                                    
                                    case 2:
                                    case 3:
                                    case 4:
                                    case 5:
                                    case 6:
                                    case 7:
                                    case 8:
                                    case 9:
                                        switch ($date_m) {
                                            case 1:
                                                $message = $message.$date_y.'年になりました。新年あけましておめでとうございます。
                                                今年も就労移行支援事業所キャリスタ梅田をどうぞよろしくお願いいたします。<br>
                                                先月の振り返り面談が出来ていない方、
                                                順次、振り返り面談を行いますのでもうしばらくお待ちください。<br>';
                                                break;
                                            default:
                                                $message = $message.$date_m.'月になりました。先月の振り返り面談が出来ていない方、
                                                順次、振り返り面談を行いますのでもうしばらくお待ちください。<br>';
                                                break;
                                        }
                                        break;
                                    case 10:
                                    case 11:
                                    case 12:
                                    case 13:
                                        $message = $message.'シフト提出期間になりました。シフト提出の期限は今月15日までとなっております。作成したシフトはお早めに提出してください。提出の際はLINEか直接、「提出しました」の報告をお願いいたします。<br>';
                                        break;
                                    case 14:
                                        $message = $message.'シフト提出期間となっております。シフト提出の期限は明日までとなっております。作成したシフトはお早めに提出してください。提出の際はLINEか直接、「提出しました」の報告をお願いいたします。<br>';
                                        break;
                                    case 15:
                                        $message = $message.'シフト提出期間となっております。シフト提出の期限は本日までとなっております。作成したシフトはお早めに提出してください。提出の際はLINEか直接、「提出しました」の報告をお願いいたします。<br>';
                                        break;
                                    case 21:
                                    case 22:
                                    case 23:
                                    case 24:
                                    case 25:
                                    case 26:
                                    case 27:
                                    case 28:
                                    case 29:
                                    case 30:
                                    case 31:
                                        $message = '只今、振り返り期間となっております。
                                        順次、振り返り面談を行います。<br>';
                                        break;
                                }
                                switch ($date_w) {
                                    case 5:
                                        $message = $message.'お弁当の注文がまだの方は明日が締め切りとなっております。
                                        お弁当の支給を希望されている方は、お弁当の注文を忘れずに。<br>';
                                        break;
                                    case 6:
                                        $message = $message.'お弁当の注文がまだの方は今日が締め切りとなっております。
                                        お弁当の支給を希望されている方は、お弁当の注文を忘れずに。<br>';
                                        break;
                                }
                                switch ($date_m) {
                                    case 1:
                                        $message = $message.'寒い日が続くかと思います、体調管理にはくれぐれも気を付けて。';
                                        break;
                                    case 2:
                                        $message = $message.'寒い日がまだまだ続くかと思います、体調管理にはくれぐれも気を付けて。';
                                        break;
                                    case 3:
                                        $message = $message.'3月は門出の季節となっております。';
                                        break;
                                    case 5:
                                        $message = $message.'徐々に暑くなってきました。体調管理にはくれぐれも気を付けて。';
                                        break;
                                    case 8:
                                        $message = $message.'暑い日が続くかと思います、体調管理にはくれぐれも気を付けて。';
                                        break;
                                    case 9:
                                        $message = $message.'暑い日がまだまだ続くかと思います、体調管理にはくれぐれも気を付けて。';
                                        break;
                                    case 11:
                                        $message = $message.'徐々に寒くなってきました。体調管理にはくれぐれも気を付けて。';
                                        break;
                                }
                                echo $message;
                            ?>
                        </p>
                    </div>
                </div>
            </section>
            <!-- お知らせ -->
            <section>
                <div class="news">
                    <p class="news_head">
                        お知らせ
                    </p>
                    <ul class="news_list">
                        <li>
                            2026.8.10 
                            <span class="news_rec">就活</span>
                            「合同面接会」の予約が始まっています。
                        </li>
                    </ul>
                </div>
            </section>
            <section>
                <div class="foot_row">
                    <!-- カレンダー -->
                    <div class="calender">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan='7'>
                                        <?php echo $date_y ?>年<?php echo $date_m ?>月
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php 
                                    $d1 = 1;
                                    $firster = date('w', strtotime($date_y.'-'.$date_m.'-01'));
                                    for($d3 = 0; $d3 < 7; $d3++){
                                        echo '<td class="cal_mas';
                                        if($date_d == $d1){
                                            echo ' yellow_text yellow_back';
                                        }else{
                                            switch($d3){
                                                case 0:
                                                    echo ' red_text red_back';
                                                    break;
                                                case 6:
                                                    echo ' blue_text blue_back';
                                                    break;
                                            }
                                        }
                                        echo '">'.$date_w1[$d3].'</td>';
                                    }
                                    echo '</tr><tr>';
                                    for($d2 = 0; $d2 < 6; $d2++){
                                        for($d3 = 0; $d3 < 7; $d3++){
                                            if($d3 == $firster && $d1 == 1){
                                                echo '<td class="cal_mas';
                                                if($date_d == $d1){
                                                    echo ' yellow_text yellow_back';
                                                }else{
                                                    switch($d3){
                                                        case 0:
                                                            echo ' red_text red_back';
                                                            break;
                                                        case 6:
                                                            echo ' blue_text blue_back';
                                                            break;
                                                    }
                                                }
                                                echo '">'.$d1.'</td>';
                                                $d1 = 2;
                                            }else{
                                                if($d1 <= $date_m_arr[($date_m - 1)] && $d1 > 1){
                                                    echo '<td class="cal_mas';
                                                    if($date_d == $d1){
                                                        echo ' yellow_text yellow_back';
                                                    }else{
                                                        switch($d3){
                                                            case 0:
                                                                echo ' red_text red_back';
                                                                break;
                                                            case 6:
                                                                echo ' blue_text blue_back';
                                                                break;
                                                        }
                                                    }
                                                    echo '">'.$d1.'</td>';
                                                    $d1 += 1;
                                                }else{
                                                    echo '<td class="cal_mas';
                                                    if($date_d == $d1){
                                                        echo ' yellow_text yellow_back';
                                                    }else{
                                                        switch($d3){
                                                            case 0:
                                                                echo ' red_text red_back';
                                                                break;
                                                            case 6:
                                                                echo ' blue_text blue_back';
                                                                break;
                                                        }
                                                    }
                                                    echo '"></td>';
                                                }
                                            }

                                            if($d3 == 6){
                                                echo '</tr><tr>';
                                            }
                                        }
                                    }
                                ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- あなた宛ての通知 --->
                    <div class="notice">
                        <?php 
                            /*
                            ここでは外部api(SQL)を活用し、宛先とログイン名義の照合を行って
                            「作品添削依頼」「応募書類添削依頼」に対する返答を表示する予定である。
                            */
                            echo '<p class="no_notice">現在、あなた宛てのお知らせはございません。</p>';
                        ?>
                    </div>
                    <!-- 星占い --->
                    <div class="mikuji">
                        <?php
                            $zodiac = '';
                            $zodiacs1 = array(
                                [
                                    'name'=>'やぎ座', 'first_m'=>'12', 'first_d'=>'22', 'last_m'=>'1', 'last_d'=>'19'
                                ],
                                [
                                    'name'=>'みずがめ座', 'first_m'=>'1', 'first_d'=>'20', 'last_m'=>'2', 'last_d'=>'18'
                                ],
                                [
                                    'name'=>'うお座', 'first_m'=>'2', 'first_d'=>'19', 'last_m'=>'3', 'last_d'=>'20'
                                ],
                                [
                                    'name'=>'おひつじ座', 'first_m'=>'3', 'first_d'=>'21', 'last_m'=>'4',  'last_d'=>'19'
                                ],
                                [
                                    'name'=>'おうし座', 'first_m'=>'4', 'first_d'=>'20', 'last_m'=>'5', 'last_d'=>'20'
                                ],
                                [
                                    'name'=>'ふたご座', 'first_m'=>'5', 'first_d'=>'21', 'last_m'=>'6', 'last_d'=>'21'
                                ],
                                [
                                    'name'=>'かに座', 'first_m'=>'6', 'first_d'=>'22', 'last_m'=>'7', 'last_d'=>'22'
                                ],
                                [
                                    'name'=>'おうし座', 'first_m'=>'7', 'first_d'=>'23', 'last_m'=>'8', 'last_d'=>'22'
                                ],
                                [
                                    'name'=>'おとめ座', 'first_m'=>'8', 'first_d'=>'23', 'last_m'=>'9', 'last_d'=>'22'
                                ],
                                [
                                    'name'=>'てんびん座', 'first_m'=>'9', 'first_d'=>'23', 'last_m'=>'10', 'last_d'=>'23'
                                ],
                                [
                                    'name'=>'さそり座', 'first_m'=>'10', 'first_d'=>'25', 'last_m'=>'11', 'last_d'=>'22'
                                ],
                                [
                                    'name'=>'いて座', 'first_m'=>'11', 'first_d'=>'23', 'last_m'=>'12', 'last_d'=>'21'
                                ]
                            );
                            $zodiacs2 = array();
                            for($d4 = 0; $d4 < 12; $d4++){
                                array_push($zodiacs2 , $zodiacs1[$d4]['name']);
                                if(
                                    (($zodiacs1[$d4]['first_m'] == $_SESSION['birth_m']) &&
                                    (intval($zodiacs1[$d4]['first_d']) < intval($_SESSION['birth_d']))) ||
                                    (($zodiacs1[$d4]['last_m'] == $_SESSION['birth_m']) &&
                                    (intval($zodiacs1[$d4]['first_d']) > intval($_SESSION['birth_d'])))
                                ){
                                    $zodiac = $zodiacs1[$d4]['name'];
                                }
                            }
                            $seed = (int)date('Ymd');
                            srand($seed);
                            shuffle($zodiacs2);
                            echo '<script>console.log("1:'.$zodiacs2[0].' - 12:'.$zodiacs2[11].'");</script>';
                        ?>
                        <div>
                            <p>
                                あなたの星座である <span class="tx_20"><?php
                                    echo $zodiac;
                                ?></span> の運勢順位は…？
                            </p>
                            <p>
                            <span class="tx_24<?php
                                $d = 0;
                                for($d4 = 0; $d4 < 12; $d4++){
                                    if($zodiac == $zodiacs2[$d4]){
                                        $d = $d4 + 1;
                                        switch($d){
                                            case 1:
                                            case 2:
                                            case 3:
                                            case 12:
                                                echo ' blue_text';
                                                break;
                                            default:
                                                break;
                                        }
                                        
                                    }
                                }
                            ?>"><?php echo $d; ?>位</span>
                            </p>
                            <p>
                                注意深く物事を見てみることがヒント。
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>

        </footer>
        <script src="js/script.js"></script>
    </body>
</html>