<?php
include 'config.php';

$sql = "SELECT * FROM rooms";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"]. " - Nama: " . $row["name"]. " - Kapasitas: " . $row["capacity"]. "<br>";
    }
} else {
    echo "Tidak ada hasil.";
}
?>
