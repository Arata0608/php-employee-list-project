<?php
$images = array ();

$images01 = array();
$images02 = array();
$images03 = array();

// albumフォルダをオープンにする
// $handleにディレクトリハンドルが入っている
// opendir(フォルダ名)⇒戻り値ディレクトリハンドル
if ($handle = opendir ( '../../uploads' )) {
// readdir(ディレクトリハンドル)⇒指定したディレクトリのファイル一覧を取得する
// ファイル名をどんどん取得する
    while ( $entry = readdir ( $handle ) ) {
        // 現在のディレクトリの.or..を除いた全てのファイル名リストを
        // $imagesに格納している
        if ($entry != "." && $entry != "..") {
// $entry⇒readdirで取得したファイル名が沢山格納されている。
// それを$images配列に格納。
            $images [] = $entry;
        }
    }
    for ($i = 0; $i < count($images); $i=$i+3) {
        array_push($images01, $images[$i]);
        if ($i + 1 < count($images)) {
            array_push($images02, $images[$i+1]);
        }
        if ($i + 2 < count($images)) {
            array_push($images03, $images[$i+2]);
        }
    }
    // ディレクトリハンドルをクローズする
    closedir ( $handle );
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <style>
        h1 {
            font-family: "M PLUS Rounded 1c";
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .row .column {
            flex: 33.3%;
            width: auto;
            overflow: hidden; 
            padding: 0 4px;;
            height: 100%
        }
        .row .column img {
            width: 100%;
            height: 100%;
            margin-top: 2%;
            cursor: pointer;
            filter: grayscale(1) brightness(0.5);
            border-radius: 5px;
            transition: 0.3s linear;
        }
        .row .column img:hover {
            filter: grayscale(0) brightness(1);
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class='container-fluid'>
        <h1 class='text-center p-2'>社内アルバム</h1>
        <button class='btn btn-info mt-3' onclick="location.href='../crud/list.php';">戻る</button>
        <div class='row'>
            <div class='column'>
                <?php if (count ($images01) > 0): ?>
                    <?php for ($i = 0; $i < count($images01); $i++): ?>
                        <?php echo '<img src="../../uploads/'.$images01[$i].'" '."/>"; ?>
                    <?php endfor; ?>
                <?php else: ?>
                    <?php echo '<p class="textstyle">画像はまだありません。</p>'; ?>
                <?php endif; ?>
            </div>
            <div class='column'>
                <?php if (count ($images02) > 0): ?>
                    <?php for ($i = 0; $i < count($images02); $i++): ?>
                        <?php echo '<img src="../../uploads/'.$images02[$i].'" '."/>"; ?>
                    <?php endfor; ?>
                <?php else: ?>
                    <?php echo '<p class="textstyle">画像はまだありません。</p>'; ?>
                <?php endif; ?>
            </div>
            <div class='column'>
                <?php if (count ($images03) > 0): ?>
                    <?php for ($i = 0; $i < count($images03); $i++): ?>
                        <?php echo '<img src="../../uploads/'.$images03[$i].'" '."/>"; ?>
                    <?php endfor; ?>
                <?php else: ?>
                    <?php echo '<p class="textstyle">画像はまだありません。</p>'; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>