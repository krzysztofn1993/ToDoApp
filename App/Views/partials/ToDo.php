<?php require_once('../App/Views/common/header.php')?>
<div class="d-flex flex-column container container-fluid justify-content-center my-5 col-lg-7
    col-md-8">
    <form action="Home/addTask" method="POST">
            <div class="input-group mb-3">
                <input type="text" name="task" class="form-control" 
                placeholder="What you have to do.." aria-label="Recipient's username" 
                aria-describedby="button-addon2" autocomplete="off">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit" id="button-addon2">Add</button>
                </div>
        </div>
    </form>
    <?php
    if (!empty($tasks)) {
        $iteration = count($tasks) - 1;
        $length = $iteration;
        echo '<ul class="list-group container my-4 tasks">';
        foreach ($tasks as $task) {
            echo '<li class="row tasks__positions align-items-start my-2" data-id="'. ($length - $iteration) . '">' .
            '<div class="tasks__text col-lg-11 col-10 align-self-center">' . ucfirst($tasks[$iteration]['TASK']) . '</div>' .
            '<div class="col-lg-1 col-2 px-0 d-flex justify-content-end">' .
            '<a href="#" class="btn btn-success tasks__done mx-1 my-1" tabindex="0"></span><i class="far fa-check-square">' . 
            '</i></a></div></li>';
            $iteration--;
        }
        echo '</ul>';
    }
    ?>
</div>
<script src="scripts/addTaskAjax.js"></script>