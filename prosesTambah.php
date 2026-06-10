<!DOCTYPE html>
<html>
<head><title>Simpan Buku Tamu</title></head>
<body>
    <h1>Simpan Buku Tamu MySQL</h1>
    <?php
    $nama     = $_POST["nama"];
    $email    = $_POST["email"];
    $komentar = $_POST["komentar"];

    $conn = mysqli_connect("localhost", "root", "", "faruq")
        or die("koneksi gagal");

    echo "Nama     : $nama <br>";
    echo "Email    : $email <br>";
    echo "Komentar : $komentar <br>";

    $sqlstr = "INSERT INTO bukutamu (nama, email, komentar)
               VALUES ('$nama', '$email', '$komentar')";
    $hasil = mysqli_query($conn, $sqlstr);

    if ($hasil) {
        echo "Simpan bukutamu berhasil dilakukan";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
    ?>
    <br><a href="bukutamu.htm">Kembali</a> | <a href="view.php">Lihat Data</a>
</body>
</html>
