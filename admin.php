<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db_name = "data";
$sql = mysqli_connect($host, $user, $pass, $db_name);
if (mysqli_connect_errno()) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}
if (!isset($_COOKIE["session"])) {
    header("Location: logout.php");
}
$username = explode(";", urldecode($_COOKIE["session"]))[0];
$password = explode(";", urldecode($_COOKIE["session"]))[1];
$query = "SELECT `passwd`, `type` FROM `users` WHERE username='${username}'";
$result = mysqli_query($sql, $query);
if (!$result) {
    die(mysqli_error($sql));
}
$result = mysqli_fetch_array($result);
if ($password != $result[0]) {
    header("Location: logout.php");
}
if ($result[1] != "admin") {
    header("Location: menu.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-меню</title>
    <link rel="stylesheet" id="style" href="static/css/menu_white.css">
</head>

<body>
    <div name="container">
        <div class="left">
            <aside style="align-items: center;">
                <button>Пользователи</button>
            </aside>
        </div>
        <div class="right">
            <?php
            $host = "127.0.0.1";
            $user = "root";
            $pass = "";
            $db_name = "data";
            $sql = mysqli_connect($host, $user, $pass, $db_name);
            if (mysqli_connect_errno()) {
                die("Ошибка подключения к базе данных: " . mysqli_connect_error());
            }
            if (!isset($_COOKIE["session"])) {
                header("Location: logout.php");
            }
            if(!$_POST){
                $query = "SELECT * FROM `users`";
                $result = mysqli_query($sql, $query);
                $result = mysqli_fetch_array($result);
                echo("<table style=\"border-width: 1px;\"><tr><td>id</td><td>name</td><td>hash</td><td>group</td></tr>
                <tr><td>".$result[0]."</td><td>".$result[1]."</td><td>".$result[2]."</td><td>".$result[3]."</td></tr>"
                );
                echo("<p style=\"display: inline-block;\">id: ".$result[0]." name:".$result[1]." hash:"."<p style=\"background-color: red; display: inline-block;\">".$result[2]."</p>"."<p style=\"display: inline-block; padding-left: 3px;\">"."group:".$result[3]."</p>");
            }
            ?>
        </div>
    </div>
</body>

</html>