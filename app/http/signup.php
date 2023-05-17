<?php

#check if username, password, name submitted

if(isset($_POST['username']) &&
   isset($_POST['password']) &&
   isset($_POST['name'])){

    # database connection file
    require "../db.conn.php";
    

    # get data from POST request and store them in var
    $name = $_POST['name'];
    $passord = $_POST['password'];
    $username = $_POST['username'];

    # making URL data format
    $data = 'name='.$name.'&username='.$username;

    # simple from Validation
    if(empty($name)) {
        # error message
        $em = "Name is required";

        # redirect to 'singup.php and passing erroer message
        header("location: ../../signup.php?error=$em&$data");
        exit;
    } else if(empty($username)) {
        # error message
        $em = "Username is required";

        # redirect to 'singup.php and passing erroer message
        header("location: ../../signup.php?error=$em&$data");
        exit;
    } else if(empty($passord)) {
        # error message
        $em = "Password is required";

        # redirect to 'singup.php and passing erroer message
        header("location: ../../signup.php?error=$em&$data");
        exit;
    } else {
        $sql = "SELECT username
                FROM users
                Where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $em = "The username ($username) is taken";
            header("location: ../../signup.php?error=$em&$data");
            exit;
        } else {
            # Profil Picture Uploading
            if(isset($_FILES['p_p'])) {
                #get data and store them in var
                $img_name = $_FILES['p_p']['name'];
                $tmp_name = $_FILES['p_p']['tmp_name'];
                $error = $_FILES['p_p']['error']; 

                #if there is not error occurred while uploading
                if($error === 0){

                    # get image extension store it in var 
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

                    # convert the image extension into lower case and store it in var
                    $img_ex_lc = strtolower($img_ex);

                    # creating arrary that stores allowed to upload image extension
                    $allowed_exs = array("jpg", "jpeg", "png");

                    # check if the image extension is present in $allowed_exs array
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        
                        # renaming the image with user's username like : username.img_ex_lc
                        $new_img_name = $username. '.' .$img_ex_lc;

                        # creating upload path on root directory
                        $img_upload_path = '../../uploads/'.$new_img_name;

                        #move uploaded image to .upload folder
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }else {
                        $em = "You can't upload files of this type";
                        header("location: ../../signup.php?error=$em&$data");
                        exit;
                    }
                }else {
                    $em = "Unknown error occurred !";
                    header("location: ../../signup.php?error=$em&$data");
                    exit;
                }
            }

            // password hashing 
            $passord = password_hash($passord, PASSWORD_DEFAULT);

            # if the user upload Profile picture
            if(isset($new_img_name)){
            
                # inserting data into database
                $sql = 'INSERT INTO users
                        (name, username, password, p_p)
                        VALUES (?,?,?,?)';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$name, $username, $passord, $new_img_name]);
            }else{

                # inserting data into database
                $sql = 'INSERT INTO users
                (name, username, password)
                VALUES (?,?,?)';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $username, $passord]);
            }

            # success message
            $sm = "Account created successfully";
            header("location: ../../index.php?success=$sm");
            exit;
        }
    }
} else {
    header("location: ../../signup.php");
    exit;
}