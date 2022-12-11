<?php
include("./config.php");

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $nis = $_POST["nis"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];
    $photo_name = $_FILES["photo"]["name"];
    $temp_save = $_FILES["photo"]["tmp_name"];

    $sql = null;

    if (empty($photo_name)) {
        $sql = $pdo->prepare("UPDATE registrations SET nis=:nis, name=:name, gender=:gender, phone_number=:phone_number, address=:address WHERE id=:id");
        $sql->bindParam(':nis', $nis);
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':phone_number', $phone_number);
        $sql->bindParam(':address', $address);
        $sql->bindParam(':id', $id);
    } else {
        $new_photo_name = date('dmYHis') . $photo_name;
        $save_path = "images/" . $new_photo_name;

        if (!move_uploaded_file($temp_save, $save_path)) {
            header("Location: ./index.php?status=error_image_save");
            return;
        }

        $sql = $pdo->prepare("SELECT photo FROM registrations WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $data = $sql->fetch();

        if (is_file("images/" . $data['photo']))
            unlink("images/" . $data['photo']);

        $sql = $pdo->prepare("UPDATE registrations SET nis=:nis, name=:name, gender=:gender, phone_number=:phone_number, address=:address, photo=:photo WHERE id=:id");
        $sql->bindParam(':nis', $nis);
        $sql->bindParam(':name', $name);
        $sql->bindParam('gender', $gender);
        $sql->bindParam(':phone_number', $phone_number);
        $sql->bindParam(':address', $address);
        $sql->bindParam(':photo', $new_photo_name);
        $sql->bindParam(':id', $id);
    }

    $execute = $sql->execute();

    if ($execute) {
        header("Location: ./student-list.php?status=success_edit");
    } else {
        header("Location: ./index.php?status=failed_edit");
    }
} else {
    die("Access denied.");
}