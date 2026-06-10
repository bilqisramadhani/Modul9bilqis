<!DOCTYPE html>
<html>
<head><title>Koneksi Database MySQL</title></head>
<body>
    <h1>Koneksi database dengan mysqli_fetch_array</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "faruq")
        or die("koneksi gagal");

    $hasil = mysqli_query($conn, "SELECT * FROM liga");

    while ($row = mysqli_fetch_array($hasil)) {
        echo "Liga " . $row["negara"];   // array asosiatif
        echo " mempunyai " . $row[2];   // array numeris
        echo " wakil di liga champion <br>";
    }
    ?>
</body>
</html>
