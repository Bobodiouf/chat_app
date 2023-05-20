<?php
session_start();
if (isset($_SESSION['username'])) :
    require_once "app/db.conn.php";

    require_once "app/helpers/user.php";

    require_once "app/helpers/timeAgo.php";
    
    if (!isset($_GET['user'])) {
        header("Location: home.php");
        exit;
    }

    $chatWith = getUser($_GET['user'], $conn);

    if (empty($chatWith)) {
        header("Location: home.php");
        exit;
    }
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
                <img src="uploads/<?= $chatWith['p_p'] ?>" class="w-15 rounded-circle">
                <h3 class="display-4 fs-sm m-2">
                    <?= $chatWith['name'] ?><br>
                    <div class="d-flex align-items-center" title="online">
                        <?php if (last_seen($chatWith['last_seen']) == "Active"): ?>
                        <div class="online"></div>
                        <small class="d-block p-1">Online</small>
                        <?php else: ?>
                        <small class="d-block p-1">
                            Last seen
                            <?= last_seen($chatWith['last_seen']) ?><br>
                        </small>
                        <?php endif ?>
                    </div>
                </h3>
            </div>
            <div id="chatBox" class="shadow p-4 rounded d-flex flex-column mt-4 w-100 chat-box">
                <p class="rtext align-self-end border rounded p-2 mb-1">
                    Hello, there
                    <small class="d-block">12:00</small>
                </p>

                <p class="ltext border rounded p-2 mb-1">
                    Hello
                    <small class="d-block">12:00</small>
                </p>

                <p class="rtext align-self-end border rounded p-2 mb-1">
                    Hello, there
                    <small class="d-block">12:00</small>
                </p>

                <p class="ltext border rounded p-2 mb-1">
                    Hello
                    <small class="d-block">12:00</small>
                </p>

                <p class="rtext align-self-end border rounded p-2 mb-1">
                    Hello, there
                    <small class="d-block">12:00</small>
                </p>

                <p class="ltext border rounded p-2 mb-1">
                    Hello
                    <small class="d-block">12:00</small>
                </p>

                <p class="rtext align-self-end border rounded p-2 mb-1">
                    Hello, there
                    <small class="d-block">12:00</small>
                </p>

                <p class="ltext border rounded p-2 mb-1">
                    Hello
                    <small class="d-block">12:00</small>
                </p>
            </div>
            <div class="input-group mb-3">
                <textarea cols="3" class="form-control "></textarea>
                <button class="btn btn-primary">
                    <i class="bi bi-send"></i>
                </button>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
        <script>
            var scrollDown = function(){
                let chatBox = document.getElementById('chatBox'); 
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            scrollDown();
            $(document).ready(function() {

                
            });
        </script>

    </body>

    </html>

<?php else : ?>
    <?php header("location:home.php");
    exit ?>
<?php endif ?>