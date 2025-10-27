<?php

require_once("config.php");
if (!empty($_SESSION["user_id"])) {
    header("location: index.php");
}

$errors = [];
if (!empty($_POST)) {
    
    if (empty($_POST["user_name"])) {
        $errors[""] = "Please enter Username or Email";
    }
    if (empty($_POST["password"])) {
        $errors[""] = "Please enter Password";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = :username or email = :username) and password = :password");
        $stmt->execute(array("username" => $_POST["user_name"], "password" => sha1($_POST["password"].SALT)));
        $id = $stmt->fetchColumn();
        if (!empty($id)) {
            $_SESSION["user_id"] = $id;
            header("location: index.php");
        }
        else {
            $errors[] = "Please enter valid credentails";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log In Page</title>
</head>
<body>
    
<h1>Log in page</h1>

    <div>

        <form method="POST">

            <div style="color: red;">
                <?php foreach ($errors as $error) :?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>

            <div>
                <label>User Name / Email:</label>
                <div>
                    <input type="text" name="user_name" required="" value="<?php echo (!empty($_POST["user_name"]) ? $_POST["user_name"] : ''); ?>">
                </div>
            </div>

            <div>
                <label>Password:</label>
                <div>
                    <input type="password" name="password" required="" value="">
                </div>
            </div>

            <div>
                <br>
                <input type="submit" name="submit" value="Log in">
            </div>

        </form>

    </div>
        
</body>
</html>