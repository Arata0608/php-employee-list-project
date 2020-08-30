<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>追加完了</title>
</head>
<body>
    <?php if (isset($_POST["upload"])): ?>
        <?php
            $file = $_FILES["file"];
    
            $file_name = $_FILES["file"]["name"];
            $file_tmp_name = $_FILES["file"]["tmp_name"];
            $file_size = $_FILES["file"]["size"];
            $file_error = $_FILES["file"]["error"];
            $file_type = $_FILES["file"]["type"];
        
            $file_ext = explode(".", $file_name);
            $file_actual_ext = strtolower(end($file_ext));
        
            $allowed = array("jpg", "jpeg", "png");    
        ?>
        <?php if (in_array($file_actual_ext, $allowed)): ?>
            <?php if ($file_error == 0): ?>
                <?php if ($file_size < 1000000): ?>
                    <?php 
                        $file_name_new = uniqid('', true).".".$file_actual_ext;

                        $file_destination = '../../uploads/'.$file_name_new;
        
                        move_uploaded_file($file_tmp_name, $file_destination);
                    ?>
                    <div class='container'>
                        <h3 class="my-4" style="text-align: center"><?php echo $file_name; ?>のアップロードに成功しました！</h3>
                        <div class="card bg-dark text-white" style="width: 30%; margin: 0 auto">
                            <img src="<?= $file_destination ?>" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <h5 class="card-title"><?php echo $file_name; ?></h5>
                            </div>
                        </div>
                        <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
                    </div>
                <?php else: ?>
                    <div class='contaienr'>
                        <h3 class="mt-3">ファイルサイズが大きすぎます!</h3>
                        <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class='container'>
                    <h3 class="mt-3">ファイルアップロード中にエラーが発生しました!</h3>
                    <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class='container'>
                <h3 class="mt-3">jpg, png以外は対応していません!</h3>
                <button class='btn btn-info mt-5' onclick="location.href='../crud/list.php';">戻る</button>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>