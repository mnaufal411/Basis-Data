<?php
include 'config.php';

$sql = "SELECT * FROM users";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"]. " - Username: " . $row["username"]. " - Peran: " . $row["role"]. "<br>";
    }
} else {
    echo "Tidak ada hasil.";
}
?>
