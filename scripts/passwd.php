<?php
session_start();

if($_SESSION)
{
    include("db-connection.php");
}
else
{
    header("Location: index.php");
}

$user = $_SESSION["session_user"];

if(!empty($_SESSION['session_rights']) == 1)
{


}
else
{
    $Sql = "SELECT * FROM interessenten WHERE Benutzername = '$user'";

    $query = mysqli_query($connection, $Sql);
    $result = mysqli_fetch_assoc($query);

    $oldpasswdHash = $result['Passwort'];
    $oldpasswd = $_POST['oldpasswd'];

    $newpasswd = $_POST['newpasswd'];
    $hashedPW = password_hash($newpasswd, PASSWORD_DEFAULT);

    // echo $oldpasswdHash."<br>";
    // echo $oldpasswd."<br>";
    // echo $newpasswd."<br>";
    // echo $hashedPW."<br>";

    $password_match = password_verify($oldpasswd, $oldpasswdHash);

    if(password_verify($oldpasswd, $oldpasswdHash))
    {
        $Sql2 = "UPDATE interessenten SET Passwort='$hashedPW' WHERE Benutzername = '$user'";
        $result = mysqli_query($connection,$Sql2);
        if(mysqli_affected_rows($connection) > 0)
        {
            echo "Passwort erfolgreich geändert!";
        }
    }
    else
    {
            echo "Passwort wurde nicht geändert, versuchen Sie es erneut!";
    }
}

?>