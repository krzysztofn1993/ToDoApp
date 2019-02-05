<?php

use src\Controller\Controller;

require("../vendor/autoload.php");
require("../src/head.php");
?>

<body>
<section class="wrapper">
    <form  class="form" action="" method="post">
        <label for="todo">What you have to do? </label>
        <input type="text" id="todo" name="task" required>
        <button type="submit" name="submit">Add</button>
    </form>
</section>

<?php
$control = new Controller();
if (isset($_POST["submit"])) {
    $control->addTask($_POST["task"]);
}
?>
</body>
<!-- <?php require("../src/footer.php") ?> -->






