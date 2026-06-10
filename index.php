<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #333; }
        input[type=text], select { padding: 5px; margin: 5px 0; }
        input[type=submit] { padding: 5px 15px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type=submit]:hover { background: #45a049; }
        .hapus-btn { background: #e74c3c !important; }
        hr { border: 1px solid #ccc; margin: 20px 0; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #4CAF50; color: white; }
        img { width: 80px; height: 80px; object-fit: cover; }
        .msg-success { color: green; font-weight: bold; }
        .msg-error { color: red; font-weight: bold; }
    </style>
</head>
<body>

<?php
$conn = mysqli_connect("localhost", "root", "", "faruq");
$msg  = "";

// ===== PROSES TAMBAH =====
if (isset($_POST['tambah'])) {
    $nrp    = $_POST['nrp'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $id_jur = $_POST['id_jur'];
    $foto   = "";

    // Upload foto
    if (!empty($_FILES['foto']['name'])) {
        $target = "uploads/" . basename($_FILES['foto']['name']);
        if (!is_dir("uploads")) mkdir("uploads");
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = $target;
        }
    }

    $sql = "INSERT INTO mahasiswa (NRP, Nama, Alamat, Foto, ID_Jur)
            VALUES ('$nrp', '$nama', '$alamat', '$foto', '$id_jur')";
    if (mysqli_query($conn, $sql)) {
        $msg = "<p class='msg-success'>Data berhasil ditambahkan!</p>";
    } else {
        $msg = "<p class='msg-error'>Gagal: " . mysqli_error($conn) . "</p>";
    }
}

// ===== PROSES DELETE =====
if (isset($_POST['hapus'])) {
    $nrp = $_POST['nrp_hapus'];
    $sql = "DELETE FROM mahasiswa WHERE NRP='$nrp'";
    if (mysqli_query($conn, $sql)) {
        $msg = "<p class='msg-success'>Data NRP $nrp berhasil dihapus!</p>";
    } else {
        $msg = "<p class='msg-error'>Gagal: " . mysqli_error($conn) . "</p>";
    }
}

echo $msg;

// Ambil data jurusan untuk dropdown
$jur_result = mysqli_query($conn, "SELECT * FROM jurusan");
?>

<!-- ===== FORM TAMBAH ===== -->
<h2>TAMBAH DATA</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    NRP    : <input type="text" name="nrp" required><br>
    Nama   : <input type="text" name="nama" required><br>
    Alamat : <input type="text" name="alamat"><br>
    Foto   : <input type="file" name="foto"><br>
    Jurusan:
    <select name="id_jur">
        <?php
        mysqli_data_seek($jur_result, 0);
        while ($jur = mysqli_fetch_assoc($jur_result)) {
            echo "<option value='{$jur['ID_Jur']}'>{$jur['Nama']}</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" name="tambah" value="Tambah">
</form>

<hr>

<!-- ===== FORM SEARCH ===== -->
<h2>SEARCH DATA</h2>
<form action="index.php" method="get">
    Nama : <input type="text" name="cari">
    <input type="submit" value="Cari Data">
</form>

<?php
if (isset($_GET['cari']) && $_GET['cari'] != '') {
    $cari = $_GET['cari'];
    $sql  = "SELECT m.NRP, m.Nama, m.Foto, j.Nama AS Jurusan
             FROM mahasiswa m
             JOIN jurusan j ON m.ID_Jur = j.ID_Jur
             WHERE m.Nama LIKE '%$cari%'";
    $hasil = mysqli_query($conn, $sql);
    $jml   = mysqli_num_rows($hasil);
    echo "<br>Ditemukan: $jml data<br>";
    if ($jml > 0) {
        echo "<table>
                <tr>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Jurusan</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($hasil)) {
            $foto = $row['Foto'] ? "<img src='{$row['Foto']}'>" : "Tidak ada foto";
            echo "<tr>
                    <td>{$row['NRP']}</td>
                    <td>{$row['Nama']}</td>
                    <td>$foto</td>
                    <td>{$row['Jurusan']}</td>
                  </tr>";
        }
        echo "</table>";
    }
}
?>

<hr>

<!-- ===== FORM HAPUS ===== -->
<h2>HAPUS DATA</h2>
<form action="index.php" method="post">
    NRP : <input type="text" name="nrp_hapus">
    <input type="submit" name="hapus" value="Hapus Data" class="hapus-btn">
</form>

<hr>

<!-- ===== TAMPIL SEMUA DATA ===== -->
<h2>SEMUA DATA MAHASISWA</h2>
<?php
$sql   = "SELECT m.NRP, m.Nama, m.Alamat, m.Foto, j.Nama AS Jurusan
          FROM mahasiswa m
          JOIN jurusan j ON m.ID_Jur = j.ID_Jur";
$hasil = mysqli_query($conn, $sql);
$jml   = mysqli_num_rows($hasil);
echo "Total: $jml mahasiswa<br>";
echo "<table>
        <tr>
            <th>NRP</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Foto</th>
            <th>Jurusan</th>
        </tr>";
while ($row = mysqli_fetch_assoc($hasil)) {
    $foto = $row['Foto'] ? "<img src='{$row['Foto']}'>" : "-";
    echo "<tr>
            <td>{$row['NRP']}</td>
            <td>{$row['Nama']}</td>
            <td>{$row['Alamat']}</td>
            <td>$foto</td>
            <td>{$row['Jurusan']}</td>
          </tr>";
}
echo "</table>";
?>

</body>
</html>
