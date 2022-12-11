<?php
include("./config.php");

if (!isset($_GET["id"])) {
    header("Location: student-list.php?status=not_found");
}

$id = $_GET["id"];

$sql = $pdo->prepare("SELECT * FROM registrations WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->execute();
$student = $sql->fetch();

if (!$student) {
    header("Location: student-list.php?status=not_found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card border-0 shadow">
            <div class="card-body p-5">
                <h1 class="mb-4 fw-bold px-md-5">Pembaruan data siswa</h1>
                <form action="./edit-process.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $student['id'] ?>">
                    <div class="mb-3 row">
                        <label for="nis" class="col-md-2 col-form-label">NIS</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nis" name="nis" value="<?= $student['nis'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $student['name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="address" class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md-10">
                            <textarea class="form-control" id="address" name="address" rows="3"><?= $student['address'] ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-md-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-md-10 d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="Laki-laki" <?= $student['gender'] == 'Laki-laki' ? 'checked' : '' ?>> <label class="form-check-label" for="gender1">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="Perempuan" <?= $student['gender'] == 'Perempuan' ? 'checked' : '' ?>> <label class="form-check-label" for="gender2">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="phone_number" class="col-md-2 col-form-label">Telepon</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $student['phone_number'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="photo" class="col-md-2 col-form-label">Foto</label>
                        <div class="col-md-10">
                            <input class="form-control" type="file" id="photo" name="photo">
                        </div>
                    </div>
                    <input type="submit" name="update" value="Perbarui data" href="./registation-form.php" class="btn btn-info text-white fw-semibold"></input>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>