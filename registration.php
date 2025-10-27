<?php

require_once("config.php");
if (!empty($_SESSION["iser_id"])) {
    header("location: registration.php");
}

$errors = [];
$isRegistered = 0;

if (!empty($_GET["registration"])) {
    $isRegistered = 1;
}

if (!empty($_POST)) {
    if (empty($_POST["user_name"])) {
        $errors[] = "Please enter user name";
    }
    if (empty($_POST["email"])) {
        $errors[] = "Please enter email";
    }
    if (empty($_POST["first_name"])) {
        $errors[] = "Please enter first Name";
    }
    if (empty($_POST["last_name"])) {
        $errors[] = "Please enter last Name";
    }
    if (empty($_POST["password"])) {
        $errors[] = "Please enter password";
    }
    if (empty($_POST["confirm_password"])) {
        $errors[] = "Please confirm password";
    }

    if (strlen($_POST["user_name"]) > 100) {
        $errors[] = "User name if too long";   
    }
    if (strlen($_POST["first_name"]) > 80) {
        $errors[] = "First name is too long";
    }
    if (strlen($_POST["last_name"]) > 100) {
        $errors[] = "Last name if too long";
    }
    if (strlen($_POST["password"]) < 6) {
        $errors[] = "Password is too short";
    }
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        $errors[] = "Your confirm password is not match password";
    }
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users(`username`, `email`, `password`, `first_name`, `last_name`) VALUES(:username, :email, :password, :first_name, :last_name)");
        $stmt->execute(array(
            "username" => $_POST["user_name"],
            "email" => $_POST["email"], 
            "password" => sha1($_POST["password"].SALT), 
            "first_name" => $_POST["first_name"], 
            "last_name" => $_POST["last_name"]));
        header("location: /gostewaya_kniga/login.php?registration=1");
    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <title>Guest Book</title>

</head>
<body>
    <?php if (!empty($isRegistered)) :?>
        <h2>Registered! Use your data to log in</h2>
    <?php endif;?>
    <h1>Registration Page</h1>

    <div>

        <form method="POST" action="/gostewaya_kniga/registration.php">

            <div style="color: red;">
                <?php foreach ($errors as $error) :?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>

            <div>
                <label>User Name:</label>
                <div>
                    <input type="text" name="user_name" required="" value="<?php echo (!empty($_POST["user_name"]) ? $_POST["user_name"] : ''); ?>">
                </div>
            </div>

            <div>
                <label>Email:</label>
                <div>
                    <input type="text" name="email" required="" value="<?php echo (!empty($_POST["email"]) ? $_POST["email"] : ''); ?>">
                </div>
            </div>

            <div>
                <label>First Name:</label>
                <div>
                    <input type="text" name="first_name" required="" value="<?php echo (!empty($_POST["first_name"]) ? $_POST["first_name"] : ''); ?>">
                </div>
            </div>

            <div>
                <label>Last Name:</label>
                <div>
                    <input type="text" name="last_name" required="" value="<?php echo (!empty($_POST["last_name"]) ? $_POST["last_name"] : ''); ?>">
                </div>
            </div>

            <div>
                <label>Password:</label>
                <div>
                    <input type="password" name="password" required="" value="">
                </div>
            </div>

            <div>
                <label>Confirm Password:</label>
                <div>
                    <input type="password" name="confirm_password" required="" value="<?php echo (!empty($_POST["user_name"]) ? $_POST["user_name"] : ''); ?>">
                </div>
            </div>

            <div>
                <br>
                <input type="submit" name="submit" value="Register">
            </div>

        </form>

    </div>

</body>
</html>