<?php
    foreach($_COOKIE as $key => $value) {
        if(!$key == "session" & !$value != null) {
            header("Location: register.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="static/css/menu.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li>
          <button class="logout-button" id="logout-button">Выход</button>
        </li>
      </ul>
    </nav>
  </header>
  <script>
        function logout() {
          window.location.href = "logout.php";
        }
        var logoutButton = document.getElementById("logout-button");
    
        logoutButton.addEventListener("click", logout);
    </script>
</body>
</html>