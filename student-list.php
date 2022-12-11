<?php include("./config.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <style>
        .student-img {
            max-height: 200px;
        }
    </style>
</head>

<body>
    <main class="container vh-100 py-5">
        <h1 class="mb-5 text-center fw-bold">Siswa yang sudah mendaftar</h1>

        <?php if (isset($_GET["status"])) : ?>
            <div class='alert 
                <?php
                $alertColor = 'alert-warning';

                if ($_GET["status"] == "success" || $_GET["status"] == "success_edit")
                    $alertColor = 'alert-success';
                else if ($_GET["status"] == "failed" || $_GET["status"] == "failed_edit")
                    $alertColor = 'alert-danger';
                else if ($_GET["status"] == "not_found")
                    $alertColor = 'alert-warning';

                echo $alertColor
                ?> 
                alert-dismissible fade show' role='alert'>"
                <strong>
                    <?php
                    $alertTitle = "Unknown";

                    if ($_GET["status"] == "success" || $_GET["status"] ==  "success_edit")
                        $alertTitle = "Berhasil!";
                    else if ($_GET["status"] == "failed" || $_GET["status"] == "not_found"  || $_GET["status"] == "failed_edit")
                        $alertTitle = "Gagal!";

                    echo $alertTitle;
                    ?>
                </strong>
                <?php
                $alertMessage = "Unknown";

                if ($_GET["status"] == "success")
                    $alertMessage = "Data berhasil dihapus.";
                else if ($_GET["status"] ==  "success_edit")
                    $alertMessage = "Data berhasil diubah.";
                else if ($_GET["status"] == "failed")
                    $alertMessage = "Terjadi kesalahan saat menghapus data.";
                else if ($_GET["status"] == "not_found")
                    $alertMessage = "Data tidak ditemukan.";
                else if ($_GET["status"] == "failed_edit")
                    $alertMessage = "terjadi kesalahan saat mengubah data.";

                echo $alertMessage;
                ?>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif ?>

        <div class="d-flex justify-content-between align-items-center">
            <a href="./registration-form.php" class="btn btn-info mb-3 text-white fw-semibold">Daftar Baru</a>
            <a href="./create-pdf-report.php" class="btn btn-outline-info mb-3 text-info fw-semibold">Cetak PDF</a>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-hover table-bordered">
                <thead class="table-info">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Foto</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $pdo->prepare("SELECT * FROM registrations");
                    $sql->execute();

                    $loop = 0;
                    while ($student = $sql->fetch()) {
                        $loop++;

                        echo "<tr>";
                        echo "<th scope='row'>" . $loop . "</th>";
                        echo "<td>";
                        echo "<img src='images/" . $student["photo"] . "' alt='Foto' width='200' class='student-img mx-auto d-block'> ";
                        echo "</td>";
                        echo "<td>" . $student["nis"] . "</td>";
                        echo "<td>" . $student["name"] . "</td>";
                        echo "<td>" . $student["gender"] . "</td>";
                        echo "<td>" . $student["phone_number"] . "</td>";
                        echo "<td>" . $student["address"] . "</td>";
                        echo "<td>";
                        echo "<a href='./edit-form.php?id=" . $student["id"] . "' class='btn btn-outline-info me-1 me-md-3 fw-semibold'>Edit</a>";
                        echo "<a href='./delete.php?id=" . $student["id"] . "' class='btn btn-outline-danger fw-semibold'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                    <p>Total: <?= $loop ?></p>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>