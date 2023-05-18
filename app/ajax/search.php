<?php

session_start();

# Check if the user is logged in 
if (isset($_SESSION['username'])) {
    
   # check if the is submitting 
   if(isset($_SESSION['username'])){

    # database connection file
    require_once "../db.conn.php";

    # creating simple search algorithm :)
    $key = "%{$_POST['key']}%";

    $sql = "SELECT * FROM users
            WHERE username
            LIKE ? OR name LIKE ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key, $key]);


?>

    <?php if($stmt->rowCount() > 0): 
        $users = $stmt->fetchAll();
        foreach ($users as  $user):
            if($user['user_id'] == $_SESSION['user_id']) continue;?>
        <li class="list-group-item">
            <a href="chat.php?user=<?= $user['username'] ?>" class="d-flex 
                    justify-content-center align-items-center p-2">
                <div class="d-flex align-items-center">
                    <img src="uploads/<?= $user['p_p'] ?>"
                        class="w-10 rounded-circle">
                    <h3 class="fs-xs m-2"><?= $user['name'] ?></h3>
                </div>                
            </a>
        </li>
        <?php endforeach ?>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            <i class="bi bi-person-fill-slash d-block fs-big"></i>
            The user "<?=  htmlspecialchars($_POST['key'])?>" is not found.
        </div>
    <?php endif ?>
<?php        
}

}else {
    header("location: ../../index.php");
    exit;
}