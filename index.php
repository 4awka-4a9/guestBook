<?php

require_once("config.php");
if (empty($_SESSION["user_id"])) {
    header("location: login.php");
}

if (!empty($_POST["comment"])) {
        $stmt = $pdo->prepare("INSERT INTO comments(`user_id`, `comment`) VALUES(:user_id, :comment)");
        $stmt->execute(array("user_id" => $_SESSION["user_id"], "comment" => $_POST["comment"]));
    }   

$stmt = $pdo->prepare("SELECT * FROM `comments` LEFT JOIN users ON user_id=users.id");
$stmt->execute();
$comments = $stmt->fetchAll();

?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="guestbook" />
    <meta
      name="author"
      content="yan-coder"
    />
    <meta name="generator" content="Astro v5.13.2" />
    <title>home | guestbook.yan-coder.com</title>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">

    <link
      rel="canonical"
      href="https://getbootstrap.com/docs/5.3/examples/pricing/"
    />
    <script src="js/color-modes.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="css/main.css" rel="stylesheet" />
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
      #comments-header{ text-align: center;}
      #comments-form{border: 1px dotted black; width: 50%; padding-left: 20px;}
      #comments-form textarea{width: 70%; min-height: 100px;}
      #comments-panel{border: 1px dashed black; width: 50%; padding-left: 20px; margin-top: 20px;}
      .comment-date{font-style: italic;}
      
      .card {
        margin-top: 10px;
        margin-bottom: 10px;
      }

      .textarea {
        resize: none;
      }

      .commentsTitle {
        margin: 10px;
      }

    </style>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=105184923', 'ym');

        ym(105184923, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/105184923" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

  </head>
  <body>

    <div class="container py-3">
      <header>
        <div
          class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"
        >
          <a
            href="#"
            class="d-flex align-items-center link-body-emphasis text-decoration-none"
          >
            <span class="fs-4">Guest Book</span>
          </a>
          <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <a
              class="btn btn-outline-secondary me-3 py-2 link-body-emphasis text-decoration-none"
              href="#"
              >Home</a
            >
            <a
              class="btn  btn-outline-secondary me-3 py-2 link-body-emphasis text-decoration-none"
              href="logout.php"
              >Log out</a
            >
          </nav>
        </div>
      </header>
      <main>
        
        <div id="#comments-form"><h3>Please add your comment</h3>

        <form method="POST" action="index.php">

            <div>

                <label>Comment</label>
                <div>
                    <textarea class="form-control textarea" name="comment"></textarea>
                </div>

            </div>

            <div>

                <br>
                <input class="btn btn-outline-secondary"type="submit" name="submit" value="Save">

            </div>

        </form>

        </div>  

        <div id="#comments-panel">

          <h3 class="commentsTitle">Comments:</h3>

            <?php foreach ( $comments as $comment ) : ?>

            <?php

            $comment["comment"] = htmlspecialchars($comment["comment"]);

            $comment["comment"] = preg_replace('~https?://[^\s]+|www\.[^\s]+~i', '<a href="$0">$0</a>', $comment["comment"]);
            
            $commentTemplate = <<<TXT
            <div class="card">
              <div class="card-header">
            {$comment["username"]}
              </div>
              <div class="card-body">
                <figure>
                  <blockquote class="blockquote">
                    <p><pre>{$comment["comment"]}</pre></p>
                  </blockquote>
                  <figcaption class="blockquote-footer">
                      {$comment["created_at"]}
                  </figcaption>
                </figure>
              </div>
            </div>
            TXT;
            
            ?>

            <?php echo $commentTemplate;?>
            <?php endforeach; ?>

        </div>

      </main>
      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <small class="d-block mb-3 text-body-secondary"
              >&copy; yan-coder 2025</small
            >
          </div>
          <div class="col-6 col-md">
            <h5><a class="btn  btn-outline-secondary me-3 py-2 link-body-emphasis text-decoration-none" href="#">Home</a></h5>
          </div>
        </div>
      </footer>
    </div>
    <script
      src="js/bootstrap.bundle.min.js"
      class="astro-vvvwv3sm"
    ></script>
  </body>
</html>
