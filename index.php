<?php
session_start();
if (!isset($_SESSION['username'])):
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Chat App - Login</title>
</head>

<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 p-5 shadow rounded">
        <form method="POST" action="app/http/auth.php">
            <div class="d-flex
                        justify-content-center
                        align-items-center
                        flex-column">
                <img src="img/logo.png" 
                     class="w-25">
                <h3 class="display-4 fs-1 
                           text-center">
                           LOGIN </h3>
            </div>
            <?php if (isset($_GET['error'])): ?>          
            <div class="alert alert-warning" role="alert">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
            <?php endif ?>           
            <?php if (isset($_GET['success'])): ?>          
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($_GET['success']) ?>
            </div>
            <?php endif ?>

            <div class="form-group mb-3">
                <label class="form-label">
                       User name</label>
                <input type="text"
                       name="username"
                       class="form-control">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">
                       Password</label>
                <input type="password"
                       name="password"
                       class="form-control">
            </div>
            
            <button type="submit" 
                    class="btn btn-primary">
                    LOGIN</button>
            <a href="signup.php">Sign up</a>
        </form>
    </div>
</body>

</html>
<?php else: ?>
<?php header("location:home.php"); exit ?>
<?php endif ?>