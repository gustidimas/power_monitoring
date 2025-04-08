<?php

// Memulai sesi jika belum ada, maka akan langsung ke login
session_start();
require 'db_config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Perintah SQL untuk mengambil semua data
$history_sql = "SELECT * FROM power_data ORDER BY timestamp DESC";
$history_result = $conn->query($history_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>
        setTimeout(() => {
            window.location.reload();
        }, 10000);
    </script>
</head>

<body class="w-full min-h-screen flex overflow-x-hidden">
    <div class="flex w-full h-full">

        <!-- Navigasi -->
        <aside class="w-64 min-h-screen bg-blue-100 text-gray-500 flex flex-col p-4">
            <h2 class="text-xl font-bold mb-6 text-black text-center">CSH</h2>
            <nav class="flex flex-col gap-2">
                <a href="index.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Dashboard</a>
                <a href="history.php" class="bg-blue-500 text-white hover p-2 rounded">Riwayat</a>
                <a href="account.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Akun</a>
                <a href="logout.php" class="bg-red-500 text-white p-2 rounded mt-auto text-center">Keluar</a>
            </nav>
        </aside>
        <main class="w-full flex-grow bg-gray-100 px-4 py-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-blue-800">TABEL RIWAYAT <span class="text-sm font-normal text-gray-500">Terakhir diperbarui: <?= $data['timestamp']; ?> | Sekarang: <?= date("Y-m-d H:i:s"); ?></span></h1>
                </div>
            </div>

            <!-- Tabel Riwayat -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-200 text-gray-700 font-semibold">
                        <tr>
                            <th class="py-2 px-4">No</th>
                            <th class="py-2 px-4">Voltage (V)</th>
                            <th class="py-2 px-4">Power (W)</th>
                            <th class="py-2 px-4">Battery Status</th>
                            <th class="py-2 px-4">Battery Level (%)</th>
                            <th class="py-2 px-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <?php if ($history_result && $history_result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while ($row = $history_result->fetch_assoc()): ?>
                                <tr>
                                    <td class="py-2 px-4"><?= $no++; ?></td>
                                    <td class="py-2 px-4"><?= $row['voltage']; ?></td>
                                    <td class="py-2 px-4"><?= $row['power']; ?></td>
                                    <td class="py-2 px-4"><?= ucfirst($row['battery_status']); ?></td>
                                    <td class="py-2 px-4"><?= $row['battery_level']; ?>%</td>
                                    <td class="py-2 px-4"><?= $row['timestamp']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">Tidak ada data tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
    </main>
    </div>
</body>

</html>