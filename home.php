<?php
session_start();
if (isset($_SESSION['username'])):
require_once "app/db.conn.php";
require_once "app/helpers/user.php";
require_once "app/helpers/conversations.php";
require_once "app/helpers/timeAgo.php";

# Getting User data
$user = getUser($_SESSION['username'], $conn);

# Getting User Conversations
$conversations = getConversations($user['user_id'], $conn);
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
</head>
<body class="d-flex
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
                       id="searchText"
                       class="form-control">
                <button class="btn btn-primary"
                        id="searchBtn">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <ul id="chatList"
                class="list-group mvh-50 overflow-auto">
                <?php if(!empty($conversations)): ?>
                    <?php foreach($conversations as $conversation): ?>
                    <li class="list-group-item">
                        <a href="chat.php?user=<?= $conversation['username'] ?>" class="d-flex 
                                justify-content-center align-items-center p-2">
                            <div class="d-flex align-items-center">
                                <img src="uploads/<?= $conversation['p_p'] ?>"
                                    class="w-10 rounded-circle">
                                <h3 class="fs-xs m-2"><?= $conversation['name'] ?></h3>
                            </div>
                            <?php if(last_seen($conversation['last_seen'])): ?>
                            <div title="online">
                                <div class="online"></div>
                            </div>
                            <?php endif ?>
                        </a>
                    </li>
                    <?php endforeach ?>
                <?php else: ?>
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-wechat d-block fs-big"></i>
                        No messages yet, start the conversation
                    </div>
                <?php endif ?>
            </ul>
        </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script>
    $(document).ready(function(){

        // Search
        $("#searchText").on("input", function(){
            var searchText = $(this).val();
            if(searchText == "") return;

            $.post('app/ajax/search.php',
                   {
                    key: searchText
                   },
                   function(data, status){
                        $("#chatList").html(data);
               });
        });

        // Search using the Button
        $("#searchBtn").on("click", function(){
            var searchText = $("#searchText").val();
            if(searchText == "") return;
            
            $.post('app/ajax/search.php',
                   {
                    key: searchText
                   },
                   function(data, status){
                        $("#chatList").html(data);
               });
        });



        // Auto update last seen for logged in user
        let lastSeenUpdate = function(){
            $.get("app/ajax/update_last_seen.php");
        }
        lastSeenUpdate();

        // Auto update last seen every 5 sec
        setInterval(lastSeenUpdate, 5000);

    });
</script>
</body>
</html>
<?php else: ?>
<?php header("location:index.php"); exit ?>
<?php endif ?>