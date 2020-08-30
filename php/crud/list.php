<?php session_start(); ?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <style>
        body {
            font-family: "Noto Sans JP";
        }
        nav form {
            position: absolute;
            right: 20px;
        }
        .nav-link {
            cursor: pointer;
        }
    </style>
    <title>社員データ</title>
</head>
<body>
    <?php if (isset($_SESSION["id"])): ?>
        <?php

        // pagination
        $limit = 10;
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $start = ($page - 1) * $limit;

        // Local DB settings
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "employee";

        // Remote DB settings
        // $host = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "employee";

        $mysqli = new mysqli($host, $username, $password, $dbname) or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data ORDER BY kana_name LIMIT $start, $limit") or die($mysqli->error);

        // count the number of employees
        $resultNum = $mysqli->query("SELECT count(id) AS id FROM data") or die($mysqli->error);
        $employees = $resultNum->fetch_all(MYSQLI_ASSOC);
        $total = $employees[0]["id"];

        // the pages we need
        $pages = ceil($total / $limit);

        // previous and next page
        $prev = $page - 1;
        $next = $page + 1;

        ?>
        <?php if (isset($_SESSION["error1"])): ?>
            <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
                <?php 
                    echo $_SESSION["error1"];
                    unset($_SESSION["error1"]);
                ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION["error2"])): ?>
            <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
                <?php 
                    echo $_SESSION["error2"];
                    unset($_SESSION["error2"]);
                ?>
            </div>
        <?php endif; ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <img width="70" src='./img/logo.png' alt=''>
            <div class="navbar-brand ml-2">社員リスト</div>
            <div class="navbar-nav">
                <a class="nav-link" onclick="location.href='insert_form.php';">追加</a>
                <a class="nav-link" onclick="location.href='../search/search_form.php';">検索</a>
                <a class="nav-link" onclick="location.href='../file_upload/upload_list.php';">社内アルバム</a>
                <a class="nav-link" onclick="location.href='../file_upload/upload_form.php';">アップロード</a>
            </div>
            
            <form method="POST" action="../registration/process.php">
                <button type="submit" class="btn btn-outline-secondary ml-2" name="logout">ログアウト</button>
            </form>

        </nav>
        <div class='container'>                
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
                            <th scope="col">編集</th>
                            <th scope="col">削除</th>
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
                            <td>
                                <a href="update_form.php?update=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">編集</a>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                    削除
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">本当に削除してよろしいですか？</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            削除した場合、復元できません。
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">削除</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php $prev < 1 ? disabled : NULL ?>">
                        <a class="page-link" href="list.php?page=<?= $prev; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for($i = 1; $i <= $pages; $i++): ?>
                        <li class="page-item">
                            <a class="page-link" href="list.php?page=<?= $i; ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?php $next > $pages ? disabled : NULL ?>">
                        <a class="page-link" href="list.php?page=<?= $next; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php else: ?>
        <div class='container'>
            <h3 class="my-4" style="text-align: center">ログインしてください！</h3>
            <button class='btn btn-info mt-5' onclick="location.href='../registration/login_form.php';">ログイン画面へ</button>
        </div>
    <?php endif; ?>
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>