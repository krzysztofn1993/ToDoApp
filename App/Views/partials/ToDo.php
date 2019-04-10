<?php require_once('../App/Views/common/header.php')?>
<div class="d-flex flex-column container container-fluid justify-content-center my-5 col-lg-7
    col-md-8">
    <form action="Home/addTask" method="POST">
            <div class="input-group mb-3">
                <input type="text" name="task" class="form-control" 
                placeholder="What you have to do.." aria-label="Recipient's username" 
                aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" id="button-addon2">Add</button>
                </div>
        </div>
    </form>
    <?php
    if (!empty($tasks)) {
        
        echo '<ul class="list-group container flex-column-reverse my-4 tasks">';
        foreach ($tasks as $task) {
        echo '<li class="row tasks__positions align-items-center my-2">' .
            '<div class="tasks__text col-lg-11 col-10 py-1">' . ucfirst($task['TASK']) . '</div>' .
            '<div class="col-lg-1 col-2 px-0 d-flex justify-content-end align-items-start">' .
            '<button class="btn btn-success tasks__done mx-1"></span><i class="far fa-check-square">' . 
            '</i></button></div></li>';
        }
        echo '</ul>';
    }
    ?>
</div>