<?php
function getUser($username, $conn): array{
    $sql = "SELECT * FROM users
            WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
        return $user;
    }else{
        $user = [];
        return $user;
    }
}