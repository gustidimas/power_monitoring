<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

$sql = "SELECT * FROM power_data ORDER BY timestamp DESC LIMIT 1";
$result = $conn->query($sql);

$history_sql = "SELECT * FROM power_data ORDER BY timestamp DESC";
$history_result = $conn->query($history_sql);

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$paginated_sql = "SELECT * FROM power_data ORDER BY timestamp DESC LIMIT $limit OFFSET $offset";
$paginated_result = $conn->query($paginated_sql);

$total_sql = "SELECT COUNT(*) as total FROM power_data";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$data = [
    'voltage' => '-',
    'power' => '-',
    'battery_status' => '-',
    'battery_level' => '-',
    'timestamp' => '-'
];

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Monitoring</title>
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
                <a href="index.php" class="bg-blue-500 text-white hover p-2 rounded">Dashboard</a>
                <a href="history.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Riwayat</a>
                <a href="account.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Akun</a>
                <a href="logout.php" class="bg-red-500 text-white p-2 rounded mt-auto text-center">Keluar</a>
            </nav>
        </aside>
        <main class="w-full flex-grow bg-gray-100">
            <!-- Gambar -->
            <div class="h-64 w-full bg-cover bg-left bg-no-repeat" style="background-image: url('assets/charging-car.jpg');"></div>

            <div class="max-w-6xl mx-auto px-4 py-6">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-blue-800">CHARGING STATION HYBRID | <span class="text-sky-500">CSH</span></h1>
                </div>

                <!-- Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">
                    <!-- Voltage -->
                    <div class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-green-700 to-blue-700 border border-blue-500 rounded-lg">
                        <i class="fas fa-bolt text-4xl text-blue-300"></i>
                        <span class="text-lg font-semibold">Voltage</span>
                        <span class="text-xl font-semibold"><?= $data['voltage']; ?> V</span>
                    </div>

                    <!-- Power -->
                    <div class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-green-700 to-blue-700 border border-blue-500 rounded-lg">
                        <i class="fas fa-bolt text-4xl text-blue-300"></i>
                        <span class="text-lg font-semibold">Daya</span>
                        <span class="text-xl font-semibold"><?= $data['power']; ?> W</span>
                    </div>

                    <!-- Battery Status -->
                    <div class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-red-700 to-orange-700 border border-blue-500 rounded-lg">
                        <i class="fas fa-plug text-4xl text-blue-300"></i>
                        <span class="text-lg font-semibold">Status Pengisian</span>
                        <span class="text-xl font-semibold"><?= ucfirst($data['battery_status']); ?></span>
                    </div>

                    <!-- Battery Level -->
                    <div class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-purple-700 to-cyan-700 border border-blue-500 rounded-lg">
                        <i class="fas fa-battery-half text-4xl text-blue-300"></i>
                        <span class="text-lg font-semibold">Level Baterai</span>
                        <span class="text-xl font-semibold"><?= $data['battery_level']; ?>%</span>
                    </div>
                </div>

                <!-- Tanggal update terakhir -->
                <p class="text-sm text-gray-500 mt-4 text-center">
                    Terakhir diperbarui: <?= $data['timestamp']; ?> | Sekarang: <?= date("Y-m-d H:i:s"); ?>
                </p>

                <hr class="w-full border-t border-gray-300 my-6">

                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-blue-800">TABEL RIWAYAT <span class="text-sm text-gray-500 hover:underline"><a href="history.php">Lihat semua</a></span></h1>
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
                            <?php if ($paginated_result && $paginated_result->num_rows > 0): ?>
                                <?php $no = $offset + 1; ?>
                                <?php while ($row = $paginated_result->fetch_assoc()): ?>
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

                <div class="flex justify-center mt-4 space-x-2">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?= $i; ?>" class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>