function logout() {
    window.location.href = "logout.php";
}

function changeTheme() {
    if (dark) {
        document.getElementById("style").setAttribute("href", "static/css/menu_white.css");
        document.getElementById("themeButton").setAttribute("src", "static/img/sun.png");
    } else {
        document.getElementById("style").setAttribute("href", "static/css/menu_dark.css");
        document.getElementById("themeButton").setAttribute("src", "static/img/moon.png");
    }
    dark = !dark;
}
var logoutButton = document.getElementById("logoutButton");
var changeThemeButton = document.getElementById("themeButton");
var dark = false

logoutButton.addEventListener("click", logout);
changeThemeButton.addEventListener("click", changeTheme)