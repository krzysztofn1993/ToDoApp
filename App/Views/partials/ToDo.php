<?php require_once('../App/Views/common/header.php')?>
<div class="d-flex flex-column container container-fluid justify-content-center my-5 col-lg-7
col-md-8">
    <form action="Home/addTask" method="POST">
            <div class="input-group mb-3">
                <input type="text" name="task" class="form-control" 
                placeholder="What you have to do.." aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                <button class="btn btn-success" type="submit" id="button-addon2">Add</button>
            </div>
        </div>
    </form>
    <?php
    if (!empty($tasks)) {
        
        echo '<ul class="list-group container my-4 tasks">';
        foreach ($tasks as $task) {
            echo '<li class="list-group-item row my-1 tasks__position">' .
                    '<div class="col-lg-12">' .
                        ucfirst($task['TASK']) .
                    '</div>' . 
                    '<div class="done">' .
                    '<label for="done"></label>' .
                    '<input type="checkbox" name="done" id="done">' .
                    '</div>' .
                    '<div class="delete">' .
                    '<label for="delete"></label>' .
                    '<input type="checkbox" name="delete" id="delete">' .
                    '</div>';
        }
        echo '</ul>';
    }
    ?>
    
</div>