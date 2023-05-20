<?php
session_start();
if (isset($_SESSION['username'])) :
    require_once "app/db.conn.php";
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Chat App</title>
    </head>

    <body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
        <div class="w-400 p-5 shadow rounded">
            <a href="home.php" class="fs-4 link-dark">&#8592;</a>
            <div class="d-flex align-items-center">
                <img src="uploads/user_default.png" class="w-15 rounded-circle">
                <h3 class="display-4 fs-sm m-2">
                    name<br>
                    <div class="d-flex align-items-center" title="online">
                        <div class="online"></div>
                        <small class="d-block p-1">Online</small>
                    </div>
                </h3>
            </div>
            <div class="shadow p-4 rounded d-flex flex-column mt-2 h-50 w-100 chat-box">
                <p class="rtext align-self-end border rounded p-2 mb-1">
                    Hello, there
                </p>
            </div>
    </body>

    </html>

<?php else : ?>
    <?php header("location:home.php");
    exit ?>
<?php endif ?>