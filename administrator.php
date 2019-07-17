<?php
    session_start();
    if (isset($_SESSION['session_rights']) && $_SESSION['session_rights'] == 1) {
        header("Location: admin-home.php");
    }
    else
    {
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/main.css" />
</head>
<body>

    <section>
        <div class="card">
            <form action="scripts/administrator.php" method="POST">
                <h2>Anmelden</h2>
                <input type="text" name="username" placeholder="Benutzername" />
                <br>
                <input type="password" name="password" placeholder="Passwort" />
                <br>
                <input type="submit" name="submit" />
            </form>
        </div>
    </section>

    <?php
    
    if(isset($_GET['error']) && $_GET['error'] == 001)
    {
        echo "<h3>Error username or password invalid!</h3>";
    }
    ?>

    <a href="index.php">User-login</a>

</body>
</html>