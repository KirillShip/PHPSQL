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
                <input type="password" name="password" class="input"><br>
                <a href="register.php">Зарегестрироваться</a><br><br>
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
</html>
<?php
    if($_POST != null){
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
        $query = "SELECT `password` FROM `users` WHERE username='${username}'";
        $result = mysqli_query($sql, $query);
        if(!$result){
            die(mysqli_error($sql));
        }
        $pass = mysqli_fetch_array($result);
        if(password_verify($password, $pass)){
            setcookie("session", "${username}".";"."${password}", time() + 2 * 24 * 60 * 60);
            header("Location: menu.php");
        }
        else{
            header("Location: login.php");
        }
    }    
?>
