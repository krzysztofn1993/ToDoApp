<?php
use src\Controller\Controller;
unset($_POST["task"]);
require("../vendor/autoload.php");
require("../src/head.php");
?>
<body>
<section class="wrapper">
    <form  class="form" action="" method="post">
        <label for="todo">What you have to do? </label>
        <input type="text" id="todo" name="task" required>
        <button type="submit">Add</button>
    </form>
</section>
<?php
$control = new Controller();
$control->invoke($_POST["task"] ?? null);
var_dump($_POST["task"]);
?>
</body>
<!-- <?php require("../src/footer.php") ?> -->






