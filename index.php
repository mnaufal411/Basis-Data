<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Operator Dashboard</title>
</head>
<body>
    <h1>Operator Dashboard</h1>
    <h2>Cari Informasi Alat</h2>
    <input type="text" id="searchEquipment" placeholder="Cari Alat...">
    <button onclick="searchEquipment()">Cari</button>
    <div id="equipmentResults"></div>

    <h2>Cari Informasi Ruang</h2>
    <input type="text" id="searchRoom" placeholder="Cari Ruang...">
    <button onclick="searchRoom()">Cari</button>
    <div id="roomResults"></div>

    <h2>Transaksi Penyewaan</h2>
    <form id="rentalForm">
        <input type="text" id="customerName" placeholder="Nama Pelanggan" required>
        <input type="text" id="customerPhone" placeholder="No HP" required>
        <input type="text" id="rentalRoom" placeholder="Ruangan" required>
        <input type="text" id="rentalEquipment" placeholder="Alat" required>
        <input type="datetime-local" id="startTime" required>
        <input type="datetime-local" id="endTime" required>
        <button type="button" onclick="processRental()">Proses Transaksi</button>
    </form>
    <div id="transactionResult"></div>

    <script>
        function searchEquipment() {
            const keyword = document.getElementById('searchEquipment').value;
            fetch(?action=search&type=equipment&keyword=${keyword})
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('equipmentResults');
                    resultsDiv.innerHTML = data.map(item => <p>${item.name} - ${item.available ? 'Available' : 'Not Available'}</p>).join('');
                });
        }

        function searchRoom() {
            const keyword = document.getElementById('searchRoom').value;
            fetch(?action=search&type=room&keyword=${keyword})
                .then(response => response.json())
                .then(data => {
                    const resultsDiv = document.getElementById('roomResults');
                    resultsDiv.innerHTML = data.map(item => <p>${item.name} - ${item.available ? 'Available' : 'Not Available'}</p>).join('');
                });
        }

        function processRental() {
            const transaction = {
                name: document.getElementById('customerName').value,
                phone: document.getElementById('customerPhone').value,
                room: document.getElementById('rentalRoom').value,
                equipment: document.getElementById('rentalEquipment').value,
                start_time: document.getElementById('startTime').value,
                end_time: document.getElementById('endTime').value
            };

            fetch('?action=transaction', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(transaction)
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('transactionResult').innerText = data.message;
                });
        }
    </script>
</body>
</html>

<?php
$action = $_GET['action'] ?? null;

if ($action === 'search') {
    $dataType = $_GET['type'];
    $keyword = $_GET['keyword'];

    if ($dataType === 'equipment') {
        $data = file_get_contents('data/equipment.json');
    } else if ($dataType === 'room') {
        $data = file_get_contents('data/rooms.json');
    }

    $items = json_decode($data, true);
    $results = array_filter($items, function ($item) use ($keyword) {
        return stripos($item['name'], $keyword) !== false;
    });

    echo json_encode(array_values($results));
    exit;
}

if ($action === 'transaction') {
    $transaction = json_decode(file_get_contents('php://input'), true);
    $transactions = json_decode(file_get_contents('data/transactions.json'), true);

    $transactions[] = $transaction;

    file_put_contents('data/transactions.json', json_encode($transactions));

    echo json_encode(['status' => 'success', 'message' => 'Transaksi berhasil direkam!']);
    exit;
}
?>