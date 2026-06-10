<!DOCTYPE html>
<html>
<head><title>Koneksi Database MySQL</title></head>
<body>
    <h1>Koneksi database dengan mysqli_fetch_assoc</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "faruq")
        or die("koneksi gagal");

    $hasil = mysqli_query($conn, "SELECT * FROM liga");

    while ($row = mysqli_fetch_assoc($hasil)) {
        echo "Liga " . $row["negara"];
        echo " mempunyai " . $row["champion"];
        echo " wakil di liga champion <br>";
    }
    ?>
</body>
</html>
