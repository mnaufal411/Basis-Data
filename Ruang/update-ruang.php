<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE rooms SET name='$name', capacity='$capacity' WHERE id=$id";

    if (mysqli_query($db, $sql)) {
        echo "Ruang berhasil diperbarui.";
    } else {
        echo "Kesalahan: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>

<form method="POST">
    ID: <input type="text" name="id" required><br>
    Nama Ruang: <input type="text" name="name" required><br>
    Kapasitas: <input type="number" name="capacity" min="7" max="20" required><br>
    <input type="submit" value="Perbarui Ruang">
</form>
