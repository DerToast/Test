<?php
    if (!isset($_SESSION)) {
        die("not allowed");
    }
    include('db-connection.php');
    $userBereich = $_SESSION['session_bereich'];

    function getMakler()
    {
        $sql = "SELECT * FROM makler";
        $result = mysqli_query($connection, $sql);
    }

    function getInteressenten()
    {
        $sql2 = "SELECT * FROM interessenten";
        $result2 = mysqli_query($connection, $sql);
    }
?>