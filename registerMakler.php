<?php
    session_start();

    if($_SESSION['session_rights'] == 1)
    {

    }
    else
    {
        header("Location: index.php");
    }

    
    include('scripts/inactivity.php');
    include('scripts/db-connection.php');

    if(isset($_POST['submit']) && isset($_GET['register']))
    {
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $admin = mysqli_real_escape_string($connection, !empty($_POST['admin']));
        $bereich = mysqli_real_escape_string($connection, $_POST['bereich']);

        $admin = ($admin == "on") ? $admin = "1" : $admin = "0";

        $hashedPW = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INT makler(ID, Vorname, Nachname, Benutzername, Passwort, `Admin-Rechte`, Bereich_ID) VALUES ('', '$firstname', '$lastname', '$username', '$hashedPW', '$admin', '$bereich')";
        if(mysqli_query($connection, $sql))
        {
            header('Location: home-admin.php');
            exit();
        }
        else
        {
            echo "Überprüfen Sie die Eingabe!";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AddUser</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/register.css" />
    <script src="main.js"></script>
</head>
<body>
    <section>
        <div class="card">
            <form action="registerMakler.php?register=1" method="POST">
                <h2>Neuen Benutzer hinzufügen</h2>
                <input type="text" placeholder="Vorname" name="firstname" required value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>"/>
                <br>
                <input type="text" placeholder="Nachname" name="lastname" required value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>"/>
                <br>
                <input type="text" placeholder="Benutzername" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>"/>
                <br>
                <input type="password" placeholder="Passwort" name="password" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>"/> 
                <br>
                Admin-Rechte: <input type="checkbox" name="admin" <?php echo isset($_POST['admin']) ? "checked" : ""; ?>/>
                <br>
                <select name="bereich">
                    <option value="1" <?php echo (isset($_POST['bereich']) && $_POST['bereich'] == 1) ? "selected" : ''; ?>>Häuser</option>
                    <option value="2" <?php echo (isset($_POST['bereich']) && $_POST['bereich'] == 2) ? "selected" : ''; ?>>Wohnungen</option>
                    <option value="3" <?php echo (isset($_POST['bereich']) && $_POST['bereich'] == 3) ? "selected" : ''; ?>>Grundstücke</option>
                </select>
                <br>
                <input type="submit" name="submit" />
            </form>
        </div>
    </section>
</body>
</html>