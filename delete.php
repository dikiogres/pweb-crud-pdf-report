<?php
include("./config.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $sql = $pdo->prepare("SELECT photo FROM registrations WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        $data = $sql->fetch();

        $sql = $pdo->prepare("DELETE FROM registrations WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute();

        if (is_file("images/" . $data['photo']))
            unlink("images/" . $data['photo']);

        header("Location: ./student-list.php?status=success");
    } catch (Exception $e) {
        header("Location: ./student-list.php?status=failed");
    }
} else {
    die("Data unknown.");
}