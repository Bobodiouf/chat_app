<?php
session_start();
if (isset($_SESSION['username'])):
require_once "app/db.conn.php";
require_once "app/helpers/user.php";
require_once "app/helpers/conversations.php";

# Getting User data
$user = getUser($_SESSION['username'], $conn);
var_dump($user['user_id']);
# Getting User Conversations
$user_id = is_int($user['user_id']);
$conversation = getUser($user_id, $conn);
 var_dump($conversation);
 die();
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
    <title>Chat App - Home</title>
</head><body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 p-5 shadow rounded">
        <div>
            <div class="d-flex 
                        mb-3 p-3 bg-light 
                        justify-content-between 
                        align-items-center">
                <div class="d-flex 
                            align-items-center">
                    <img src="uploads/<?= $user['p_p'] ?>"
                    class="w-25 rounded-circle"> 
                    <h3 class="fs-xs m-2"><?= $user['name'] ?></h3>   
                </div>
                <a href="logout.php" class="btn btn-dark">Logout</a>
            </div>

            <div class="input-group mb-3">
                <input type="text" name=""
                       placeholder="Search..."
                       class="form-control">
                <button class="btn btn-primary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <ul class="list-group mvh-50 overflow-auto">
            <li class="list-group-item">
                    <a href="chat.php" class="d-flex 
                            justify-content-center align-items-center p-2">
                        <div class="d-flex align-items-center">
                            <img src="uploads/user_default.png"
                                 class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2">Name</h3>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="chat.php" class="d-flex 
                            justify-content-center align-items-between p-2">
                        <div class="d-flex align-items-center">
                            <img src="uploads/user_default.png"
                                 class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2">Name</h3>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="chat.php" class="d-flex 
                            justify-content-center align-items-between p-2">
                        <div class="d-flex align-items-center">
                            <img src="uploads/user_default.png"
                                 class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2">Name</h3>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="chat.php" class="d-flex 
                            justify-content-center align-items-between p-2">
                        <div class="d-flex align-items-center">
                            <img src="uploads/user_default.png"
                                 class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2">Name</h3>
                        </div>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="chat.php" class="d-flex 
                            justify-content-center align-items-between p-2">
                        <div class="d-flex align-items-center">
                            <img src="uploads/user_default.png"
                                 class="w-10 rounded-circle">
                            <h3 class="fs-xs m-2">Name</h3>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
</body>
</html>
<?php else: ?>
<?php header("location:index.php"); exit ?>
<?php endif ?>