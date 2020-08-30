<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>社員データ</title>
</head>
<body>
    <?php

    $query = "SELECT * FROM data WHERE ";

    $index = 0;

    $mysqli = new mysqli('localhost', 'root', '', 'employee') or die(mysqli_error($mysqli));

    if (!empty($_POST["employee_id"])) {
        $employee_id = $_POST["employee_id"];
        $query = $query."employee_id=$employee_id";
        $index = $index + 1;
    }

    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
        if ($index > 0) {
            $query = $query." && name LIKE '%".$name."%'";
        } else {
            $query = $query."name LIKE '%".$name."%'";
        }
        $index = $index + 1;
    }

    if (!empty($_POST["kana_name"])) {
        $kana_name = $_POST["kana_name"];
        if ($index > 0) {
            $query = $query." && kana_name LIKE '%".$kana_name."%'";
        } else {
            $query = $query."kana_name LIKE '%".$kana_name."%'";
        }
        $index = $index + 1;
    }

    if (isset($_POST["sex"])) {
        $sex = $_POST["sex"];
        if ($sex != '9') {
            if ($index > 0) {
                $query = $query." && sex=$sex";
            } else {
                $query = $query."sex=$sex";
            }
            $index = $index + 1; 
        }
    }
    if ($index > 0) {
        $result = $mysqli->query($query) or die($mysqli->error);
    }

    ?>
    
    <?php if ($index > 0): ?>
        <div class='container'>
            <h3 class="my-3">検索結果</h3>
            <div class='row justify-content-center'>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th scope="col">社員番号</th>
                            <th scope="col">社員名</th>
                            <th scope="col">社員名 かな</th>
                            <th scope="col">性別</th>
                            <th scope="col">登録日</th>
                            <th scope="col">更新日</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["employee_id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["kana_name"]; ?></td>
                            <?php if ($row["sex"] == 1): ?>
                                <td>男性</td>
                            <?php elseif ($row["sex"] == 2): ?>
                                <td>女性</td>
                            <?php else: ?>
                                <td>不明</td>
                            <?php endif; ?>
                            <td><?php echo $row["created"]; ?></td>
                            <td><?php echo $row["updated"]; ?></td>
                        </tr>
                    <? endwhile ?>
                </table>
            </div>
            <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">一覧に戻る</button>
            <button class='btn btn-success mt-5 ml-2' onclick="location.href='search_form.php';">検索画面に戻る</button>
        </div>
    <?php else: ?>
        <div class='container'>
            <h3 class="mt-3">少なくとも一つの項目は選択してください！</h3>
            <button class='btn btn-info mt-5' onclick="location.href='search_form.php';">戻る</button>
        </div>
    <?php endif; ?>
</body>
</html>