<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php
        if (isset($title)) {
            echo $title;
        } else {
            echo "ToDoApp";
        }
    ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (isset($scripts)) {
        foreach ($scripts as $key => $script) {
            echo "<script src=\"$script.js\"></script>";
        }
    }
    if (isset($stylesheets)) {
        foreach ($stylesheets as $key => $stylesheet) {
            echo "<link rel=\"stylesheet\" href=\"../../public/stylesheets/$stylesheet.css\">";
        }
    }
    ?>
</head>
<body>