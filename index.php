<?php
    foreach($_COOKIE as $key => $value) {
        if($key == "session" & $value != null) {
            header("Location: menu.php");
        }
    }
    header("Location: register.php");
?>