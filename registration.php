<?php

require_once("config.php");
if (!empty($_SESSION["user_id"])) {
    header("location: registration.php");
}

$errors = [];
$isRegistered = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user_name"];
    $email = $_POST["email"];
}

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
    function validateEMAIL($email) {
        $v = "/[a-zA-Z0-9_.+ -]+@[a-zA-Z0-9-]+\.[a-zA-Z]+/";

        return (bool) preg_match($v, $email);
    }

    if (validateEMAIL($email) == false) {
        $errors[] = "Email is not valid";
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE username = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);
    $count = $stmt->fetchColumn();

    if (!empty($count) && $count > 0) {
        $errors[] = "The username or email is busy by another user";
    }
    
    if (empty($errors)) {

            $stmt = $pdo->prepare("INSERT INTO users(`username`, `email`, `password`, `first_name`, `last_name`) VALUES(:username, :email, :password, :first_name, :last_name)");
            $stmt->execute(array(
            "username" => $_POST["user_name"],
            "email" => $_POST["email"], 
            "password" => sha1($_POST["password"].SALT), 
            "first_name" => $_POST["first_name"], 
            "last_name" => $_POST["last_name"]));
            header("location: login.php?registration=1");
            
    }
}

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Astro v5.13.2" />
    <title>registration | guestbook.yan-coder.com</title>

    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">

    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/sign-in/"
    />
    <script src="js/color-modes.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="css/register_login.css" rel="stylesheet" />
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: #0000001a;
        border: solid rgba(0, 0, 0, 0.15);
        border-width: 1px 0;
        box-shadow:
          inset 0 0.5em 1.5em #0000001a,
          inset 0 0.125em 0.5em #00000026;
      }
      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }
      .bi {
        vertical-align: -0.125em;
        fill: currentColor;
      }
      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }
      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
      .bd-mode-toggle .bi {
        width: 1em;
        height: 1em;
      }
      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
      .input {
        border-radius: 6px !important;
      }
    </style>

  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
      <form method="POST">

        <h1 class="h3 mb-3 fw-normal">Register now!</h1>

        <div style="color: red;">
          <?php foreach ($errors as $error) :?>
            <p><?php echo $error; ?></p>
          <?php endforeach; ?>
        </div>

        <div class="form-floating">
          <input
            type="text"
            class="form-control input"
            id="floatingInput"
            placeholder="name@example.com"
            name="user_name"
            required=""
            value="<?php echo (!empty($_POST["user_name"]) ? $_POST["user_name"] : ''); ?>"
          />
          <label for="floatingInput">Username</label>
        </div>

        <div class="form-floating">
          <input
            type="text"
            class="form-control input"
            id="floatingPassword"
            placeholder="Email"
            name="email" 
            required="" 
            value="<?php echo (!empty($_POST["email"]) ? $_POST["email"] : ''); ?>"
          />
          <label for="floatingPassword">Email adress</label>
        </div>

        <div class="form-floating">
          <input
            type="text"
            class="form-control input"
            id="floatingPassword"
            placeholder="last name"
            name="first_name" 
            required="" 
            value="<?php echo (!empty($_POST["first_name"]) ? $_POST["first_name"] : ''); ?>"
          />
          <label for="floatingPassword">First name</label>
        </div>

        <div class="form-floating">
          <input
            type="text"
            class="form-control input"
            id="floatingPassword"
            placeholder="Last name"
            name="last_name" 
            required="" 
            value="<?php echo (!empty($_POST["last_name"]) ? $_POST["last_name"] : ''); ?>"
          />
          <label for="floatingPassword">Last name</label>
        </div>

        <div class="form-floating">
          <input
            type="password"
            class="form-control input"
            id="floatingPassword"
            placeholder="Password"
            name="password" 
            required="" value=""
          />
          <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating">
          <input
            type="password"
            class="form-control input"
            id="floatingPassword"
            placeholder="Password"
            name="confirm_password" 
            required="" 
            value=""
          />
          <label for="floatingPassword">Confirm password</label>
        </div>

        <!-- <div class="form-check text-start my-3">
          <input
            class="form-check-input"
            type="checkbox"
            value="remember-me"
            id="checkDefault"
          />
          <label class="form-check-label" for="checkDefault">
            Remember me
          </label>
        </div> -->

        <input class="btn btn-primary w-100 py-2 submit" type="submit" name="submit" value="Register">

        <a href="login.php">Have an account? Login now!</a>

        <p class="mt-5 mb-3 text-body-secondary">&copy; yan-coder 2025</p>

        <!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=105184923&amp;from=informer" target="_blank" rel="nofollow">     <img src="https://informer.yandex.ru/informer/105184923/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"          style="width:88px; height:31px; border:0;"          alt="Яндекс.Метрика"          title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"         class="ym-advanced-informer" data-cid="105184923" data-lang="ru"/> </a> <!-- /Yandex.Metrika informer -->  <!-- Yandex.Metrika counter --> <script type="text/javascript">     (function(m,e,t,r,i,k,a){         m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};         m[i].l=1*new Date();         for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}         k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)     })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=105184923', 'ym');      ym(105184923, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true}); </script> <noscript><div><img src="https://mc.yandex.ru/watch/105184923" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->   

      </form>
    </main>
    <script
      src="js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
  </body>
</html>
