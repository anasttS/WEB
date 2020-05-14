<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta charset="UTF-8">
    <title> BrainFuck </title>
    <style type="text/css">
        .form {
            justify-content: center;
            margin-left: 10%;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div>
    <form action="index.php" method="get" class="form">
        <p><label>
                <input name="string" placeholder="Enter string" value="
                <?php
                if (isset($_COOKIE["string"])) {
                    echo $_COOKIE['string'];
                }

                if (isset($_SESSION["str"]))
                    echo $_SESSION["str"];
                ?>">

            </label></p>
        <p><label>
                <input type="submit" name="send" value="Send"/>
            </label></p>
    </form>
</div>
</body>
</html>