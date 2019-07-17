<?php 
    session_start();
    
    if(isset($_POST['submit']))
    {
        include('db-connection.php');

        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

            $sql = "SELECT * FROM interessenten WHERE Benutzername = '$username'";
            $result = mysqli_query($connection, $sql);
            $rowCount = mysqli_num_rows($result);

            if($rowCount < 1)
            {
                header("Location: ../index.php?error=001");
                exit();
            }
            else
            {
                if($row = mysqli_fetch_assoc($result))
                {
                    $hashedPW = password_verify($password, $row['Passwort']);

                    if($hashedPW == false)
                    {
                        header("Location: ../index.php");
                        exit();
                    }
                    else
                    {
                        $_SESSION['session_id'] = $row['ID'];
                        $_SESSION['session_user'] = $row['Benutzername'];
                        $_SESSION['session_vorname'] = $row['Vorname'];
                        $_SESSION['session_bereich'] = $row['Bereich_ID'];
                        $_SESSION['session_typ'] = "interessent";
                        $_SESSION['last_login_timestamp'] = time();

                        header("Location: ../home.php");
                        exit();
                    }
                }
            }
        }
?>