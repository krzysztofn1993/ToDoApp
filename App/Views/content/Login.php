<?php
$title = "Login Page";
require_once('../App/Views/common/head.php');
echo "<link rel=\"stylesheet\" href=/stylesheets/main.css>";
?>
</head>
<body>
    <form action="/app" method="POST" autocomplete="off">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required autocomplete="off">
        <label for="password">Password:</label>
        <input type="password" name="password" required autocomplete="off">
        <button type="submit">Log In</button>
    </form>
<p>If you dont have account <a href="/register">register here</a></p>    
<?php
require_once('../App/Views/common/footer.php');
?>
