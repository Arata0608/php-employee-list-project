<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>追加完了</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION["error1"])): ?>
        <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
            <?php 
                echo $_SESSION["error1"];
                unset($_SESSION["error1"]);
            ?>
        </div>
        <div class='container'>
            <h3>新規登録に失敗しました</h3>
            <button class='btn btn-info mt-5' onclick="location.href='insert_form.php';">社員追加欄に戻る</button>
        </div>
    <?php elseif (isset($_SESSION["error2"])): ?>
        <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
            <?php 
                echo $_SESSION["error2"];
                unset($_SESSION["error2"]);
            ?>
        </div>
        <div class='container'>
            <h3>新規登録に失敗しました</h3>
            <button class='btn btn-info mt-5' onclick="location.href='insert_form.php';">社員追加欄に戻る</button>
        </div>
    <?php else: ?>
        <div class='container'>
            <h3>追加完了しました！</h3>
            <button class='btn btn-info mt-5' onclick="location.href='list.php';">戻る</button>
        </div>
    <?php endif ?>
</body>
</html>