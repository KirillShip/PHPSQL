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
$query = "SELECT passwd FROM `users` WHERE username='${username}'";
$result = mysqli_query($sql, $query);
if (!$result) {
  die(mysqli_error($sql));
}
$pass = mysqli_fetch_array($result);
if ($password != $pass[0]) {
  header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Basic site</title>
</head>

<body>
  <div name="container">
    <header>
      <nav>
        <ul>
          <!--<li>
            <img class="header-button" id="themeButton" src="static/img/sun.png" height="80%" />
          </li>
          Не работает
          -->
          <?php
          $username = explode(";", urldecode($_COOKIE["session"]))[0];
          if ($username == "admin") {
            echo ('
              <li>
                <a class="header-button" id="adminButton" href="admin.php">Админ-меню</a>
              </li>
            ');
          }

          ?>
          <li>
            <a class="header-button" id="logoutButton" href="logout.php">Выйти</a>
          </li>
        </ul>
      </nav>
    </header>
  </div>
  <div class="global-container">
    <div class="left">
      <?php
      $host = "127.0.0.1";
      $user = "root";
      $pass = "";
      $db_name = "data";
      $sql = mysqli_connect($host, $user, $pass, $db_name);
      if (!$sql) {
        die(mysqli_connect_error());
      }
      $query = "SELECT MAX(`id`) FROM `games`";
      $result = mysqli_query($sql, $query);
      if (!$result) {
        die(mysqli_error($sql));
      }
      $result = mysqli_fetch_array($result);
      $counter = 0;
      while ($counter < $result[0]) {
        $query = "SELECT `img`, `name` FROM `games` WHERE id=${counter}";
        $result1 = mysqli_query($sql, $query);
        $result1 = mysqli_fetch_array($result1);

        $html_code = "
        <div class=\"game\">
          <img src=\"" . $result1[0] . "\">
            <div>
              <p>" . $result1[1] . "</p>
            </div>
        </div>";
        echo $html_code;


        $counter = $counter + 1;
      }
      ?>
    </div>

    <div class="right">
      <h2>Фильтры поиска</h2>
    </div>

  </div>
  <script src="static/js/menu.js"></script>
  <script src="static/js/theme.js"></script>
  <link rel="stylesheet" id="style" href="static/css/menu_white.css">
</body>

</html>