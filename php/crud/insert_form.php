<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
    <title>追加ページ</title>
</head>
<body style="background-color: #F0F0F0">

    <div class='container'>
        <div class='row justify-content-center'>
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title mb-4" style="text-align: center">追加フォーム</h5>
                    <div class='row justify-content-center'>
                        <form action='process.php' method="POST" class="needs-validation" novalidate>
                            <div class='form-group'>
                                <input type='text' class='form-control' name='employee_id' placeholder="社員番号" required>
                                <div class='invalid-feedback'>社員番号が未入力です。</div>
                            </div>
                            <div class='form-group'>
                                <input type='text' class='form-control' name='name' placeholder="社員名" required>
                                <div class='invalid-feedback'>社員名が未入力です。</div>
                            </div>
                            <div class='form-group'>
                                <input type='text' class='form-control' name='kana_name' placeholder="社員名(かな)" required>
                                <div class='invalid-feedback'>社員名(かな)が未入力です。</div>
                            </div>
                            <div class='form-group'>
                                <select class="form-control custom-select" name="sex">
                                    <option value='1'>男性</option>
                                    <option value='2'>女性</option>
                                    <option value='0'>選択しない</option>
                                </select>
                            </div>
                            <button class='btn btn-primary mt-3' style="width: 100%" type='submit' name='insert'>追加</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <button class='btn btn-info mt-5' onclick="location.href='list.php';">戻る</button>
    </div>
</body>
</html>