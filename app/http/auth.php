<?php
session_start();
#check if username && password,  submitted

if(isset($_POST['username']) &&
   isset($_POST['password'])){

    # database connection file
    require "../db.conn.php";
    

    # get data from POST request and store them in var
    $password = $_POST['password'];
    $username = $_POST['username'];

    # Simple from validation
    if (empty($username)) {
        # error message
        $em = "Username is required";

        # redirect to 'index.php and passing erroer message
        header("location: ../../index.php?error=$em");
        exit;
    }elseif (empty($password)) {
        # error message
        $em = "password is required";

        # redirect to 'index.php and passing erroer message
        header("location: ../../index.php?error=$em");
        exit; 
    } else{
        $sql = "SELECT * FROM
                users WHERE username=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username]);

        # if the username is exist
        if($stmt->rowCount() === 1){

            # fetching user data
            $user = $stmt->fetch();

            # if both username's are strictly equal
            if ($user['username'] === $username){

                # Verify the encrypted password
                if(password_verify($password, $user['password'])){

                    #successfully logged in
                    #create the SESSION
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['user_id'] = $user['user_id'];

                    # redirect to "home.php"
                    header("location: ../../home.php");
                    exit;
                    
                }else{
                    # error message
                    $em = "Incorrect Username or password";

                    # redirect to 'index.php and passing erroer message
                    header("location: ../../index.php?error=$em");
                    exit;
                }
                
            }else{
                # error message
                $em = "Incorrect Username or password";

                # redirect to 'index.php and passing erroer message
                header("location: ../../index.php?error=$em");
                exit; 
            }
        }
    }

} else {
    header("location: ../../index.php");
    exit;
}