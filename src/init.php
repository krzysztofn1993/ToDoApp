<?php

use src\Controller\Controller;

require("../vendor/autoload.php");

?>

<body>
<section class="wrapper">
    <form class="form" action="/Projects/ToDoApp/src/add.php" method="post">
        <label for="todo">What you have to do? </label>
        <input type="text" id="todo" name="task" required>
        <button type="submit" value="add" name="submit">Add</button>
    </form>
</section>
<?php

$controller = new Controller();
$result = $controller->askForTasks();
foreach ($result as $key => $value) {
    echo "<p>" . $value['id'] . ". " . $value['task'] . "</p>";
}
?>
</body>
<?php
// require("../src/footer.php"); 
?>






