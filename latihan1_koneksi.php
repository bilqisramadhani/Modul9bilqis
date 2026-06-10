<!DOCTYPE html>
<html>
<head>
    <title>Koneksi Database MySQL</title>
</head>
<body>
    <h1>Demo koneksi database MySQL</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "faruq");
    if ($conn) {
        echo "OK - Koneksi berhasil!";
    } else {
        echo "Server not connected: " . mysqli_connect_error();
    }
    ?>
</body>
</html>
