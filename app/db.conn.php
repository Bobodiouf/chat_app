 <?php

# Server name
$sName = "127.0.0.1";
# User name
$uName = "root";
# Password 
$password = "Ismael-123";

#database name
$db_name = "chat_app_db";

#Creating database connection
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name",
                     $uName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch(PDOException $e) {
    echo "Connexion Failed : ". $e->getMessage();
}