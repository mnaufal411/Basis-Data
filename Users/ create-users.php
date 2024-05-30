if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Validasi peran
    if ($role !== 'admin' && $role !== 'operator') {
        die("Peran tidak valid.");
    }

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if (mysqli_query($db, $sql)) {
        echo "Pengguna baru berhasil dibuat.";
    } else {
        echo "Kesalahan: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role">
        <option value="admin">Admin</option>
        <option value="operator">Operator</option>
    </select><br>
    <input type="submit" value="Buat Pengguna">
</form>
