<?php 
    if(isset($_COOKIE['session'])){
        $host = "127.0.0.1";
        $user = "root";
        $pass = "";
        $db_name = "data";
        $sql = mysqli_connect($host, $user, $pass, $db_name);
        if(!$sql) {
          die(mysqli_connect_error());
        }
        $username = explode(";", urldecode($_COOKIE["session"]))[0];
        $password = explode(";", urldecode($_COOKIE["session"]))[1];
        $query = "SELECT passwd FROM `users` WHERE username='${username}'";
        $result = mysqli_query($sql, $query);
        if(!$result){
          die(mysqli_error($sql));
        }
        $pass = mysqli_fetch_array($result);
        echo(3);
        if($password != $pass[0]){
            header("Location: logout.php");
        }
        else{
            header("Location: menu.php");
        }
    }
    else{
      header("Location: logout.php");
    }
?>