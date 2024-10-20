<?php
//Start Session
session_start();

if (isset($_SESSION['user'])) header('location: dashboard.php');

$error_message = '';
if ($_POST){
    //var_dump($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    include('database/connection.php');
    $query = 'SELECT * FROM users WHERE users.email = "' . $username .'" AND users.password = "' . $password . '" limit 1';
    $stmt = $pdo->prepare($query);
    $result = $stmt->execute();
    
    if($stmt->rowCount() > 0){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchAll()[0];
        //$user = $stmt->fetchAll()[0]["email"];
        $_SESSION['user'] = $user;
        //echo $_SESSION['user']["email"];
        //die;
        header("location: dashboard.php");
    }else {
        $error_message = "Username or password is incorrect!";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Login - Inventory Management System</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body id="loginBody" <!--class="container"-- >
    <?php if(!empty($error_message)) { ?>
        <div id='ErrMsg' style="color: red; background: #fff; text-align: center;">
            <p>Error: <?= $error_message ?></p>
        </div>
    <?php }?>

    <div class="loginHeader">
        <h1>IMS</h1>
        <p>Inventory Management System</p>
    </div>
    <div class="loginBody">
        <form action="login.php" method="POST">
            <div class="loginInputContainer">
                <label for="">Username</label>
                <input name="username" placeholder="Username" type="text" />
            </div>
            <div class="loginInputContainer">
                <label for="">Password</label>
                <input name="password" placeholder="Password" type="password"/>
            </div>
            <div class="loginButtonContainer">
                <button>Login </button>
            </div>
        </form>
    </div>
</body>

</html>

<?php
/*--MISDB SQL create table users
CREATE TABLE `imsdb`.`users` (`id` INT NOT NULL AUTO_INCREMENT , 
                            `first_name` VARCHAR(50) NOT NULL , 
                            `last_name` VARCHAR(50) NOT NULL , 
                            `password` VARCHAR(50) NOT NULL , 
                            `email` VARCHAR(50) NOT NULL , 
                            `created_at` DATETIME NOT NULL , 
                            `updated_at` DATETIME NOT NULL , 
                            PRIMARY KEY (`id`)
                            ) ENGINE = InnoDB;

*/
?>