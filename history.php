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

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-blue-50 border-b border-blue-100 flex flex-row justify-between items-center px-4">
        <div class="flex flex-row justify-center items-center">
            <img src="assets/itk.png" alt="ITK" class="w-auto h-28">
            <img src="assets/teknikelektro.png" alt="ITK" class="w-auto h-28">
        </div>
        <div class="flex flex-row justify-center items-center gap-4 text-gray-700">
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
    <div class="flex flex-col justify-center items-center flex-grow space-y-4">
        <h1 class="text-2xl font-bold text-gray-800 text-center w-full">HISTORY</h1>
        <div class="w-full border-t border-gray-300 my-4"></div>
        <div class="flex flex-col justify-center items-center w-full gap-4">
            <div class="overflow-x-auto w-full">
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
    </div>

</body>

</html>