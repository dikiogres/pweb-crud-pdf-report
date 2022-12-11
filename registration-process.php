<?php
include("./config.php");

if (isset($_POST["regist"])) {
    $nis = $_POST["nis"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];
    $photo_name = $_FILES["photo"]["name"];
    $temp_save = $_FILES["photo"]["tmp_name"];

    $new_photo_name = date('dmYHis') . $photo_name;
    $save_path = "images/" . $new_photo_name;

    if (move_uploaded_file($temp_save, $save_path)) {
        $sql = $pdo->prepare("INSERT INTO registrations(nis, name, gender, phone_number, address, photo) VALUES(:nis,:name,:gender,:phone_number,:address,:photo)");
        $sql->bindParam(':nis', $nis);
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':phone_number', $phone_number);
        $sql->bindParam(':address', $address);
        $sql->bindParam(':photo', $new_photo_name);
        $sql->execute();

        if ($sql) {
            header("Location: ./index.php?status=success");
        } else {
            header("Location: ./index.php?status=failed");
        }
    } else {
        header("Location: ./index.php?status=error_image_save");
    }
} else {
    die("Access denied.");
}