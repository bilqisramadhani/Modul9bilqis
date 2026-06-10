<!DOCTYPE html>
<html>
<head><title>Daftar Buku Tamu</title></head>
<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "faruq");
    $hasil  = mysqli_query($conn, "SELECT * FROM bukutamu");
    $jumlah = mysqli_num_rows($hasil);

    echo "<center><h2>Daftar Pengunjung</h2></center>";
    echo "Jumlah pengunjung : $jumlah <br><br>";

    $a = 1;
    while ($baris = mysqli_fetch_array($hasil)) {
        echo $a . ".<br>";
        echo "Nama     : " . $baris[0] . "<br>";
        echo "Email    : " . $baris[1] . "<br>";
        echo "Komentar : " . $baris[2] . "<br>";
        echo "<hr>";
        $a++;
    }
    ?>
    <a href="bukutamu.htm">Tambah Data</a> | <a href="search.htm">Cari Data</a>
</body>
</html>
