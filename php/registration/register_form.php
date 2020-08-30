<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .card {
            width: 35rem;
            height: 31rem;
        }
        .card-title {
            text-align: center;
        }
        form {
            width: 65%;
        }
        form button {
            width: 100%
        }
    </style>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
    </script>
    <title>Document</title>
</head>
<body style="background-color: #F0F0F0">
    <?php require_once 'process.php'; ?>
    <?php if (isset($_SESSION["mail_error"])): ?>
        <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
            <?php 
                echo $_SESSION["mail_error"];
                unset($_SESSION["mail_error"]);
            ?>
        </div>
    <?php elseif (isset($_SESSION["password_error"])): ?>
        <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
            <?php 
                echo $_SESSION["password_error"];
                unset($_SESSION["password_error"]);
            ?>
        </div>
    <?php elseif (isset($_SESSION["username_error"])): ?>
        <div class='alert alert-<?=$_SESSION["msg_type"]?>'>
            <?php 
                echo $_SESSION["username_error"];
                unset($_SESSION["username_error"]);
            ?>
        </div>
    <?php endif; ?>
    <div class='container'>
        <div class='row justify-content-center align-items-center'>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">登録フォーム</h5>
                    <div class='row justify-content-center'>
                        <form action='process.php' method="POST" class="needs-validation" novalidate>
                            <?php if (isset($_GET["username"])): ?>
                                <?php $username = $_GET["username"]; ?>
                                <div class='form-group'>
                                    <input type='text' class='form-control' name='username' value=<?= $username ?> placeholder="ユーザー名" required>
                                    <div class='invalid-feedback'>ユーザー名が未入力です。</div>
                                </div>
                            <?php else: ?>
                                <div class='form-group'>
                                    <input type='text' class='form-control' name='username' placeholder="ユーザー名" required>
                                    <div class='invalid-feedback'>ユーザー名が未入力です。</div>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_GET["email"])): ?>
                                <?php $email = $_GET["email"]; ?>
                                <div class='form-group'>
                                    <input type='text' class='form-control' name='email' value=<?= $email ?> placeholder="メールアドレス" required>
                                    <div class='invalid-feedback'>メールアドレスが未入力です。</div>
                                </div>
                            <?php else: ?>
                                <div class='form-group'>
                                    <input type='text' class='form-control' name='email' placeholder="メールアドレス" required>
                                    <div class='invalid-feedback'>メールアドレスが未入力です。</div>
                                </div>
                            <?php endif; ?>
                            <div class='form-group'>
                                <input type='password' class='form-control' name='password' placeholder="パスワード" required>
                                <div class='invalid-feedback'>パスワードが未入力です。</div>
                            </div>
                            <div class='form-group'>
                                <input type='password' class='form-control' name='password-repeat' placeholder="パスワード再入力" required>
                                <div class='invalid-feedback'>パスワードが未入力です。</div>
                            </div>
                            <button class='btn btn-danger mt-5' type='submit' name='register'>新規登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button class='btn btn-info mt-5' onclick="location.href='login_form.php';">ログイン画面へ</button>
    </div>
</body>
</html>