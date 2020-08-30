<?php

session_start();

// Remote DB settings
$host = "remotemysql.com";
$username = "jQAuR2WJ0A";
$password = "0wOZt3QKjx";
$dbname = "jQAuR2WJ0A";

// Local DB settings
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "employee";

$mysqli = new mysqli($host, $username, $password, $dbname) or die(mysqli_error($mysqli));

$employee_id = 0;
$name = "";
$kana_name = "";
$sex = 0;
$created = 0;
$updated = 0;

if (isset($_POST["insert"])) {
    $employee_id = $_POST["employee_id"];
    $name = $_POST["name"];
    $kana_name = $_POST["kana_name"];
    $sex = $_POST["sex"];

    if (!is_numeric($employee_id)) {
        $_SESSION["error1"] = "社員番号は数字で入力してください。";
        $_SESSION["msg_type"] = "warning";
        header("location: insert.php");
    } elseif (preg_match('/[^ぁ-んーァ-ヶー]/u',$kana_name)) {
        // 外国人を考慮
        $_SESSION["error2"] = "社員名(かな)には、平仮名もしくはカタカナで入力してください。スペースは要りません。";
        $_SESSION["msg_type"] = "warning";
        header("location: insert.php");
    } else {
        $mysqli->query("INSERT INTO data (employee_id, name, kana_name, sex) VALUES('$employee_id', '$name', '$kana_name', '$sex')") or die($mysqli->error);
        header("location: insert.php");
    }

}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);
    header("location: delete.php");
}

if (isset($_GET["update"])) {
    $id = $_GET["update"];

    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);

    if ($result->num_rows) {
        $row = $result->fetch_array();
        $employee_id = $row["employee_id"];
        $name = $row["name"];
        $kana_name = $row["kana_name"];
        $sex = $row["sex"];
    }
}

if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $employee_id = $_POST["employee_id"];
    $name = $_POST["name"];
    $kana_name = $_POST["kana_name"];
    $sex = $_POST["sex"];

    if (!is_numeric($employee_id)) {
        $_SESSION["error1"] = "編集失敗。社員番号は数字で入力してください。";
        $_SESSION["msg_type"] = "warning";
        header("location: list.php");
    } elseif (preg_match('/[^ぁ-んーァ-ヶー]/u',$kana_name)) {
        // 外国人を考慮
        $_SESSION["error2"] = "編集失敗。社員名(かな)には、平仮名もしくはカタカナで入力してください。スペースは要りません。";
        $_SESSION["msg_type"] = "warning";
        header("location: list.php");
    } else {
        $mysqli -> query("UPDATE data SET employee_id='$employee_id', name='$name', kana_name='$kana_name', sex='$sex' WHERE id=$id") or die($mysqli->error);
        header("location: list.php");    
    }
}

?>