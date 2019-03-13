<?php
$title = "Home Page";
require_once('../App/Views/common/head.php');
?>
<body class="bg-primary vh-100">
<div class="col-lg-12 h-100 wrapper d-flex flex-column justify-content-center align-items-center">
    <div class="row">
        <h1>Welcome!<br> ToDoApp</h1>
    </div>
    <div class="row">
        <form action="./app" method="POST" autocomplete="off">
            <div class="row d-flex align-items-center justify-content-center">
                <label for="login"></label>
                <input type="text" name="login" id="login" required autocomplete="off" 
                placeholder="Login" class="rounded  my-2">
            </div>
            <div class="row d-flex justify-content-center">
                <label for="password"></label>
                <input type="password" name="password" required autocomplete="off" 
                placeholder="Password" class="rounded my-2">
            </div>
            <div class="row d-flex justify-content-around my-2">
                <input type="submit" value="Login" class="btn btn-success border border-dark text-dark mx-2">
                <a class="btn btn-secondary border border-dark text-dark mx-2" href="./register">Register</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once('../App/Views/common/footer.php');
?>