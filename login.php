<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="static/css/basic_white.css">
    </head>
    <body>
        
        <div class="container">
            <form method="post">
                <h1>Вход</h1>
                <p>Имя пользователя</p>
                <input type="text" name="username" class="input"><br><br>
                <p>Пароль</p>
                <input type="password" name="password" aut="current-password" class="input"><br>
                <a href="register.php">Зарегестрироваться</a><br><br>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
</html>
<?php
    if(isset($_COOKIE['session'])){
        setcookie('session', '', 1, '/');
        unset($_COOKIE['session']);
    }
    if($_POST != null){
        $host = "127.0.0.1";
        $user = "root";
        $pass = "";
        $db_name = "data";
        $sql = mysqli_connect($host, $user, $pass, $db_name);
        if(!$sql) {
            die(mysqli_connect_error());
        }

        $username = mysqli_real_escape_string($sql, $_POST["username"]);
        $password = mysqli_real_escape_string($sql, $_POST["password"]);
        $query = "SELECT * FROM `users` WHERE username='${username}'";
        $result = mysqli_query($sql, $query);
        if(!$result){
            die(mysqli_error($sql));
        }
        $pass = mysqli_fetch_array($result);
        if(password_verify($password, $pass["passwd"])){
            setcookie("session", "${username}".";".$pass["passwd"], time() + 2 * 24 * 60 * 60, "/");
            header("Location: menu.php");
        }
        else{
            header("Location: login.php");
        }
    }    
?>
