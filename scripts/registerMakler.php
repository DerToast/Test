<?php
    session_start();

    if($_SESSION['session_rights'] == 1)
    {

    }
    else
    {
        header("Location: index.php");
    }

    
    include('inactivity.php');
    include('db-connection.php');

    if(isset($_POST['submit']))
    {
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $admin = mysqli_real_escape_string($connection, $_POST['admin']);
        $bereich = mysqli_real_escape_string($connection, $_POST['bereich']);

        if($admin == "on")
        {
        $admin = 1;
        }

        $hashedPW = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO makler(ID, Vorname, Nachname, Benutzername, Passwort, `Admin-Rechte`, Bereich_ID) VALUES ('', '$firstname', '$lastname', '$username', '$hashedPW', '$admin', '$bereich')";
        if(mysqli_query($connection, $sql))
        {
            header('Location: ../home-admin.php');
            exit();
        }
        else
        {
            header('Location: ../error.html');
            exit();
        }
    } 
?>