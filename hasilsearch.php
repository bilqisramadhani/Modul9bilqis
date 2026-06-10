<!DOCTYPE html>
<html>
<head><title>Hasil Pencarian</title></head>
<body>
    <h1>Hasil Pencarian</h1>
    <?php
    $kolom = $_POST['kolom'];
    $cari  = $_POST['cari'];

    $conn = mysqli_connect("localhost", "root", "", "faruq");

    $hasil  = mysqli_query($conn, "SELECT * FROM bukutamu WHERE $kolom LIKE '%$cari%'");
    $jumlah = mysqli_num_rows($hasil);

    echo "Ditemukan: $jumlah data<br><br>";

    while ($baris = mysqli_fetch_array($hasil)) {
        echo "Nama     : " . $baris[0] . "<br>";
        echo "Email    : " . $baris[1] . "<br>";
        echo "Komentar : " . $baris[2] . "<br>";
        echo "<hr>";
    }
    ?>
    <a href="search.htm">Cari Lagi</a> | <a href="view.php">Lihat Semua</a>
</body>
</html>
