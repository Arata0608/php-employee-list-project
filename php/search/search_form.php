<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>追加ページ</title>
</head>
<body style="background-color: #F0F0F0">
    <div class='container'>
        <div class='row justify-content-center'>
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="text-align: center">検索画面</h5>
                    <div class='row justify-content-center'>
                        <form action='search.php' method="POST">
                            <div class='form-group'>
                                <input type='text' class='form-control' name='employee_id' placeholder="社員番号">
                            </div>
                            <div class='form-group'>
                                <input type='text' class='form-control' name='name' placeholder="社員名">
                            </div>
                            <div class='form-group'>
                                <input type='text' class='form-control' name='kana_name' placeholder="社員名(かな)">
                            </div>
                            <div class='form-group'>
                                <select class="form-control custom-select" name="sex">
                                    <option value='9'>---</option>
                                    <option value='1'>男性</option>
                                    <option value='2'>女性</option>
                                    <option value='0'>選択しない</option>
                                </select>
                            </div>
                            <button class='btn btn-success mt-3' action="search.php" style="width: 100%" type='submit' name='search'>検索</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
    </div>
</body>
</html>