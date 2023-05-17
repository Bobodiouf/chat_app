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
    <title>Chat App - Sign Up</title>
</head>

<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 p-5 shadow rounded">
        <form method="Post" 
            action="app/http/signup.php"
            enctype="multipart/form-data">
            <div class="d-flex
                        justify-content-center
                        align-items-center
                        flex-column">
                <img src="img/logo.png" 
                     class="w-25">
                <h3 class="display-4 fs-1 
                           text-center">
                           Sign Up  </h3>
            </div> 
            <?php if (isset($_GET['error'])): ?>          
            <div class="alert alert-warning" role="alert">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
            <?php endif ?>
            <?php if(isset($_GET['name'])){
                $name = htmlspecialchars($_GET['name']);
            } else $name =''; ?>
            <?php if(isset($_GET['username'])){
                $username = htmlspecialchars($_GET['username']);
            } else $username =''; ?>
            <div class="form-group mb-3">
                <label class="form-label">
                       User name</label>
                <input type="text" 
                       class="form-control"
                       value="<?= $username ?>"
                       name="username">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">
                       Name</label>
                <input type="text" 
                       class="form-control"
                       value="<?= $name ?>"
                       name="name">
            </div>
            <div class="form-group mb-3">
                <label class="form-label">
                       Password</label>
                <input type="password" 
                       class="form-control"
                       name="password">
            </div>            
            <div class="form-group mb-3">
                <label class="form-label">
                       Profile Picture</label>
                <input type="file" 
                       class="form-control"
                       name="p_p">
            </div>

            <button type="submit" 
                    class="btn btn-primary">
                    Sign up</button>
            <a href="index.php">Login</a>
        </form>
    </div>
</body>

</html>
<?php else: ?>
<?php header("location:home.php"); exit ?>
<?php endif ?>