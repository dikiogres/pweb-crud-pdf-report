<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card border-0 shadow">
            <div class="card-body p-5">
                <h1 class="mb-4 text-center fw-bold">Pendaftaran Siswa Baru</h1>

                <?php if (isset($_GET["status"])) : ?>
                    <div class='alert <?= $_GET["status"] == "success" ? "alert-success" : "alert-danger" ?> alert-dismissible fade show' role='alert'>"
                        <strong>
                            <?php
                            $alertTitle = "Unknown";

                            if ($_GET["status"] == "success")
                                $alertTitle = "Sukses!";
                            else if ($_GET["status"] == "failed")
                                $alertTitle = "Gagal!";
                            else if ($_GET["status"] == "error_image_save")
                                $alertTitle = "Penyimpanan gambar gagal.";

                            echo $alertTitle;
                            ?>
                        </strong>
                        <?php
                        $alertMessage = "Unknown";

                        if ($_GET["status"] == "success")
                            $alertMessage = "Siswa berhasil didaftarkan.";
                        else if ($_GET["status"] == "failed")
                            $alertMessage = "Siswa gagal didaftarkan.";
                        else if ($_GET["status"] == "error_image_save")
                            $alertMessage = "Terjadi kesalahan saat menyimpan data foto.";

                        echo $alertMessage;
                        ?>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                <?php endif ?>
                
                <div class="d-flex gap-4 justify-content-center">
                    <a href="./registration-form.php" class="btn btn-info text-white fw-semibold">Daftar Baru</a>
                    <a href="./student-list.php" class="btn btn-outline-info fw-semibold">Lihat Pendaftar</a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
