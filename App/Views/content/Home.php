<?php
$title = "Home Page";
require_once('../App/Views/common/head.php');
?>

<body class="bg-primary vh-100">
    <?php
    if (isset($_SESSION['U_ID'])) {
        require_once('../App/Views/partials/ToDo.php');
    } else {
        require_once('../App/Views/partials/LoginForm.php');
    }
    require_once('../App/Views/common/footer.php');
    ?>