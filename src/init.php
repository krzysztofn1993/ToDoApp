<?php

require("../vendor/autoload.php");
require("../src/head.php");
?>
<body>
<section class="wrapper">
    <form  class="form" action="" method="post">
        <label for="todo">What you have to do? </label>
        <input type="text" id="todo" required>
        <button type="submit">Add</button>
    </form>
</section>
<?php
use src\Controller\Controller;
$control = new Controller();
?>
</body>
<!-- <?php require("../src/footer.php") ?> -->






