<?php

session_start();

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

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $pwd_repeat = $_POST["password-repeat"];
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["mail_error"] = "メールアドレスが正しい形式ではありません。";
        $_SESSION["msg_type"] = "warning";
        header("location: register_form.php?username=".$username);
        exit();
    } elseif ($pwd !== $pwd_repeat) {
        $_SESSION["password_error"] = "パスワードが不一致です。";
        $_SESSION["msg_type"] = "warning";
        header("location: register_form.php?username=".$username."&email=".$email);
        exit();
    } else {
        $sql = "SELECT username FROM login WHERE username=?";
        $statement = mysqli_stmt_init($mysqli);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("location: register_form.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);

            if ($resultCheck > 0) {
                $_SESSION["username_error"] = "ユーザー名が既に使用されています。";
                $_SESSION["msg_type"] = "warning";
                header("location: register_form.php?email=".$email);
                exit();    
            } else {
                $sql = "INSERT INTO login (username, email, pwd) VALUES (?, ?, ?)";
                $statement = mysqli_stmt_init($mysqli);
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("location: register_form.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($statement);
                    header("location: register_judge.php");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($statement);
    mysqli_close($mysqli);
}

if (isset($_POST["login"])) {
    $username_or_name = $_POST["username"];
    $pwd = $_POST["password"];

    $sql = "SELECT * FROM login WHERE username=? OR email=?;";
    $statement = mysqli_stmt_init($mysqli);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: login_form.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, "ss", $username_or_name, $username_or_name);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        if ($row = mysqli_fetch_assoc($result)) {
            $pwdCheck = password_verify($pwd, $row["pwd"]);
            if ($pwdCheck == false) {
                $_SESSION["login_error"] = "パスワードが間違っています。";
                $_SESSION["msg_type"] = "warning";
                header("location: login_form.php?username=".$username_or_name);
                exit();
            } elseif ($pwdCheck == true) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                header("location: ../crud/list.php");
                exit();
            } else {
                $_SESSION["login_error"] = "パスワードが間違っています。";
                $_SESSION["msg_type"] = "warning";
                header("location: login_form.php?username=".$username_or_name);
                exit();
            }
        } else {
            header("location: register_form.php?error=nouser");
            exit();
        }
    }
}
if (isset($_POST["logout"])) {
    unset($_SESSION["id"]);
    session_destroy();
    header("location: login_form.php");
}
?>