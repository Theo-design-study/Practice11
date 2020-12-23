<?php
$target_dir = "public/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "svg") {
    echo "Sorry, only JPG, JPEG, PNG, GIF and SVG files are allowed.<br>";
    $uploadOk = 0;
}

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if (!$check) {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

require_once 'include/db.php';
$stmt = $conn->prepare('SELECT id FROM users WHERE login = ?;');
$stmt->bind_param('s', $_POST['login']);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
if (!is_array($row)) {
    echo "No such user.<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $stmt = $conn->prepare('UPDATE users SET img = ? WHERE login = ?;');
        $stmt->bind_param('ss', $file_name, $_POST['login']);
        $stmt->execute();
        header('location: index.php');
    } else {
        echo "Sorry, there was an error uploading your file.<br>";
    }
}
