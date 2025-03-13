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
    <title>Monitoring</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-gray-100 flex flex-row justify-between items-center px-4">
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
        <h1 class="text-2xl font-bold text-gray-800 text-center w-full">MONITORING</h1>
        <div class="w-full border-t border-gray-300 my-4"></div>
        <div class="flex flex-row justify-center items-center gap-4">
            <a href="#" class="border border-gray-300 rounded-lg p-4 w-40 h-40 flex flex-col justify-center items-center text-center text-gray-700 hover:bg-blue-50 transition duration-300">
                <i class="fa-solid fa-bolt text-3xl text-yellow-500 mb-2"></i>
                DAYA
            </a>
            <a href="#" class="border border-gray-300 rounded-lg p-4 w-40 h-40 flex flex-col justify-center items-center text-center text-gray-700 hover:bg-blue-50 transition duration-300">
                <i class="fa-solid fa-plug text-3xl text-green-500 mb-2"></i>
                STATUS PENGISIAN
            </a>
            <a href="#" class="border border-gray-300 rounded-lg p-4 w-40 h-40 flex flex-col justify-center items-center text-center text-gray-700 hover:bg-blue-50 transition duration-300">
                <i class="fa-solid fa-battery-full text-3xl text-blue-500 mb-2"></i>
                STATUS BATTERY PENYIMPANAN
            </a>
        </div>
    </div>

</body>

</html>