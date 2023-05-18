<?php

session_start();

# Check if the user is logged in 
if (isset($_SESSION['username'])) {
    
    # database connection file
    require_once "../db.conn.php";

    # Get the logged in user's username from SESSION
    $id = $_SESSION['user_id'];

    $sql = "UPDATE users
            SET last_seen = NOW()
            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

}else {
    header("location: ../../index.php");
    exit;
}