<?php

    if($_SESSION['session_rights'] == 1)
        {

        }
        else
        {
            header("Location: index.php");
        }

    session_start();
    include('inactivity.php');
    include('db-connection.php');

    if(isset($_POST['submit']))
    {
        $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $plz = mysqli_real_escape_string($connection, $_POST['PLZ']);
        $bereich = mysqli_real_escape_string($connection, $_POST['bereich']);

        $hashedPW = password_hash($password, PASSWORD_DEFAULT);
        $datetime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO interessenten(ID, Vorname, Nachname, PLZ, Benutzername, Passwort, Anmeldezeit, Bereich_ID) VALUES ('', '$firstname', '$lastname', '$plz', '$username', '$hashedPW', '$datetime', '$bereich')";
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