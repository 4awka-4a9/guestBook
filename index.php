<?php

require_once("config.php");
if (empty($_SESSION["user_id"])) {
    header("location: login.php");
}

if (!empty($_POST["comment"])) {
        $stmt = $pdo->prepare("INSERT INTO comments(`user_id`, `comment`) VALUES(:user_id, :comment)");
        $stmt->execute(array("user_id" => $_SESSION["user_id"], "comment" => $_POST["comment"]));
    }   

$stmt = $pdo->prepare("SELECT * FROM comments ORDER BY id DESC");
$stmt->execute();
$comments = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment page</title>
    <style>

        #comments-header{ text-align: center;}
        #comments-form{border: 1px dotted black; width: 50%; padding-left: 20px;}
        #comments-form textarea{width: 70%; min-height: 100px;}
        #comments-panel{border: 1px dashed black; width: 50%; padding-left: 20px; margin-top: 20px;}
        .comment-date{font-style: italic;}

    </style>
</head>
<body>
    
    <div id="comments-header">
        
        <h1>Comments Page</h1>
    
    </div>

    <div id="#comments-form"><h3>Please add your comment</h3>

        <form method="POST" action="index.php">

            <div>

                <label>Comment</label>
                <div>
                    <textarea name="comment"></textarea>
                </div>

            </div>

            <div>

                <br>
                <input type="submit" name="submit" value="Save">

            </div>

        </form>

    </div>  

    <div id="#comments-panel">

        <h3>Comments:</h3>

        <?php foreach ( $comments as $comment ) : ?>
        <p<?php if ($comment["user_id"] == $_SESSION["user_id"]) echo ' style="font-weight: bold;"';?>><?php echo $comment["comment"];?><span class="comment-date">(<?php echo $comment["created_at"];?>)</span></p>
        <?php endforeach; ?>

    </div>

</body>
</html>