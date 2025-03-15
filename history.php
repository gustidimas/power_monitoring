<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<style>
    .background1 {
        background-image: url('assets/gedungITK.jpeg');
        background-size: cover;
        background-position: bottom;
        background-repeat: no-repeat;
        height: 100%;
        width: 100%;
    }
</style>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-zinc-50 border-b border-blue-100 flex flex-row justify-between items-center px-4">
        <div class="flex flex-row justify-center items-center">
            <img src="assets/itk.png" alt="ITK" class="w-auto h-28">
            <img src="assets/teknikelektro.png" alt="ITK" class="w-auto h-28">
        </div>
        <div class="flex flex-row justify-center items-center gap-4  text-gray-700">
            <a href="index.php" class="flex flex-row justify-center items-center gap-1 hover:text-black">
                <i class="fas fa-home"></i>
                <p>Beranda</p>
            </a>
            <a href="monitoring.php" class="flex flex-row justify-center items-center gap-1 hover:text-black">
                <i class="fas fa-tachometer-alt"></i>
                <p>Monitoring</p>
            </a>
            <a href="history.php" class="flex flex-row justify-center items-center gap-1 hover:text-black">
                <i class="fas fa-history"></i>
                <p>History</p>
            </a>
            <a href="logout.php" class="flex flex-row justify-center items-center gap-1 hover:text-black">
                <i class="fas fa-sign-out-alt"></i>
                <p>Keluar</p>
            </a>
        </div>
    </header>
    <div class="w-full flex-grow grid grid-cols-1 grid-rows-3 items-center">
        <div class="background1"></div>
        <div class="w-full h-full flex row-start-2 row-end-4 flex-col justify-start items-center bg-zinc-50 p-8 rounded-lg shadow-md gap-6">
            <h1 class="text-2xl font-bold text-gray-800">Monitoring Energi</h1>
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Username
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Waktu Pengisian
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Daya yang Dihasilkan
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">john_doe</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2023-10-15</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">14:30</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">1200 Watt</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">jane_smith</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2023-10-16</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">09:45</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">1500 Watt</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>