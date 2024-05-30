<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($db, $sql)) {
        echo "Pengguna berhasil dihapus.";
    } else {
        echo "Kesalahan: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>

<form method="POST">
    ID: <input type="text" name="id" required><br>
    <input type="submit" value="Hapus Pengguna">
</form>
