<?php
$title = "Home Page";
require_once('../App/Views/common/head.php');?>
<body class="bg-primary vh-100">
<?php
if(isset($_SERVER['PHP_AUTH_USER'])){
    echo $_SERVER['PHP_AUTH_USER'];
    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';
    // require_once('../App/Views/partials/ToDoApp.php');
} else {
    require_once('../App/Views/partials/LoginForm.php');
}
require_once('../App/Views/common/footer.php');
?>