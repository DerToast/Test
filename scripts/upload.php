<?php

$target_dir = "../files/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$files = array("Haus1.pdf","Haus2.pdf","Grund1.pdf","Grund2.pdf","Wohnung1.pdf","Wohnung2.pdf");

$uploadOk = 1;
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$imageFileType = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]);

if(isset($_POST["submit"])) {
    if($imageFileType != "application/pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    if(!in_array($_FILES["fileToUpload"]["name"], $files))
    {
        echo "Sorry, only Files with the correct name are valid.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
         echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
                echo "Sorry, there was an error uploading your file.";
    }
}
}
?>

<form action="../home.php" method="POST">
            <input type="submit" name="back" value="Back" />
</form>