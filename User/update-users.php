<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id";

    if (mysqli_query($db, $sql)) {
        echo "Pengguna berhasil diperbarui.";
    } else {
        echo "Kesalahan: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>

<form method="POST">
    ID: <input type="text" name="id" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role">
        <option value="admin">Admin</option>
        <option value="operator">Operator</option>
    </select><br>
    <input type="submit" value="Perbarui Pengguna">
</form>
