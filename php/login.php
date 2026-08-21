<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/color.css">
        <title>就労移行支援事業所ABC ポータルサイト</title>
    </head>
    <body>
        <header>
        </header>
        <main>
            <div class="head">
                <img src="../logo.png" alt="ABC">
                <h1>ポータルサイト</h1>
            </div>
            <div class="form_zone">
                <form action="" method="POST">
                    <label for="userid">ユーザーid：</label>
                    <input id="userid" name="userid">
                    <label for="gmail">Gメールアドレス：</label>
                    <input id="gmail" name="gmail">
                    <button type="submit">決定</button>
                </form>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(isset($_POST['userid'])){
                            if(isset($_POST['gmail'])){
                                $json_file_path = '../assets/api/users.json'; // JSONファイルへのパス
                                $json_string = file_get_contents($json_file_path);
                                $json_string = mb_convert_encoding($json_string, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
                                $data = json_decode($json_string,true);

                                for ($i = 0; $i < count($data); $i++) {
                                    if($data) {
                                        if(
                                            htmlspecialchars($_POST['userid']) == $data[$i]['userid'] &&
                                            htmlspecialchars($_POST['gmail']) == $data[$i]['gmail']
                                        ){
                                            $_SESSION['userid'] = htmlspecialchars($_POST['userid']);
                                            $_SESSION['gmail'] = htmlspecialchars($_POST['gmail']);
                                            $_SESSION['birth_m'] = $data[$i]['birth_m'];
                                            $_SESSION['birth_d'] = $data[$i]['birth_d'];
                                            header('location:../index.php');
                                        }else{
                                            echo '<span class="error">
                                            ユーザID・Gメールアドレスの照合が出来ません。<br>
                                            ユーザID・Gメールアドレスのどちらかまたは両方が間違っています。もう一度やり直してください。
                                            </span>';
                                        }
                                    }
                                }
                            }else{
                                echo '<span class="error">Gメールアドレスを入力してください</span>';
                            }
                        }else{
                            if(isset($_POST['password'])){
                                echo '<span class="error">ユーザIDを入力してください</span>';
                            }else{
                                echo '<span class="error">ユーザID・Gメールアドレスを入力してください</span>';
                            }
                        }
                    }
                ?>
            </div>

        </main>
        <footer>

        </footer>
    </body>
</html>