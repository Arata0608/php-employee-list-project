<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class='container'>
        <div class="mt-3">
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <input type="file" name="file">
                <button class="btn btn-outline-secondary" type="submit" name="upload">アップロード</button>
            </form>
        </div>
        <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
    </div>
</body>
</html>