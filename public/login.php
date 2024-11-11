<?php require_once "../templates/header.php";  ?>

<?php 

if(isset($_POST['login'])){
    login();
}

?>

<div id="container" class="container mt-sm-5">
    <main class="form-signin col-sm-4 m-auto">
        <form action="login.php" method="post">
            <div id="sign_in" class="sign-in">
                <div>
                    <h3>Login</h3>
                </div>
                <div class="form-group">
                    <label for="username" class="form-label mt-2 required">Username</label>
                    <input type="text" id="username" name="username" required="required" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label mt-2 required">Password</label>
                    <input type="password" id="password" name="password" required="required" class="form-control mb-2">
                </div>
            </div>
            <input type="submit" name="login" class="btn btn-primary mt-2" value="Sign in">
        </form>
        <?php
        if (isset($_GET['msg'])) {
            echo "<br>";
            echo "<div class='alert alert-danger' role='alert'>
                    Invalid login credentials.
                </div>";
        }
        ?>
    </main>
</div>

<?php require_once "../templates/footer.php" ?>