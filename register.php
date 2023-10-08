<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="static/css/basic_white.css">
    </head>
    <body>
        <div class="container">
            <form method="post">
                <h1>Регистрация</h1>
                <p>Имя пользователя</p>
                <input type="text" name="username" class="input"><br><br>
                <p>Пароль</p>
                <input type="password" name="password" class="input"><br>
                <a href="login.php">Войти</a><br><br>
                <button type="submit">Зарегестрироваться</button>
            </form>
        </div>
    </body>
</html>
<?php
    if($_POST != null) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db_name = "FirstDB";
        $sql = mysqli_connect($host, $user, $pass, $db_name);
        if(!$sql) {
            die(mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($sql, $_POST["username"]);
        $password = mysqli_real_escape_string($sql, $_POST["password"]);
        $password = hash("sha256", $password);

        $query = "SELECT * FROM `users` WHERE `username`='${username}'";
        $result = mysqli_query($sql, $query);
        $result = mysqli_fetch_array($result);
        if($result) {
            header("Location: register.php");
        }
        else{
            $query = "INSERT INTO `users`(`id`, `username`, `password`) VALUES (NULL,'${username}','${password}')";
            $result = mysqli_query($sql, $query);
            if(!$result){
                die(mysqli_error($sql));
            }
            setcookie("session", "${username}".";"."${password}", time() + 2 * 24 * 60 * 60);
            header("Location: menu.php");
        }
    }
?>