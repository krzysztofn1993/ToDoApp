<?php
session_start();
require("../src/head.php");
require("../vendor/autoload.php");
use src\Controller\DBController;
?>

<body>
<section class="wrapper">
    <form class="form" action="/Projects/ToDoApp/src/add.php" method="post">
        <div class="form__input">
            <label for="todo">What you have to do? </label>
            <input type="text" id="todo" name="task" required autofocus>
        </div>
        <button class="form__button" type="submit" value="add" name="submit">Add</button>
    </form>
<?php

$controller = new DBController();
$result = $controller->askForTasks();
if(!empty($result)) {
    echo "<ul class='task'>";
    foreach ($result as $key => $value) {
        echo "<div class='task__row'><li class='task__element'><span class='task__id'>" . $value['id'] .
         "</span>" . ". " . ucfirst($value['task']) . "</li>" . "<a class='task__delete' href='../src/add.php?id=" . $value['id'] .
        "'>x</a></div>";
    }
    echo "</ul>";
}
?>
</section>
</body>
<?php
require("../src/footer.php"); 
?>






