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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">
                <a href="#" class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-green-700 to-blue-700 border border-blue-500 rounded-lg hover:shadow-xl transition duration-100">
                    <i class="fas fa-bolt text-4xl text-blue-500"></i>
                    <span class="text-lg font-semibold">Daya</span>
                    <span class="text-xl font-semibold">2500 W</span>
                </a>
                <a href="#" class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-red-700 to-orange-700 border border-blue-500 rounded-lg hover:shadow-xl transition duration-100">
                    <i class="fas fa-plug text-4xl text-blue-500"></i>
                    <span class="text-lg font-semibold">Status Pengisian</span>
                    <span class="text-xl font-semibold">50%</span>
                </a>
                <a href="#" class="flex flex-col justify-center items-center gap-2 p-6 bg-gradient-to-br from-purple-700 to-cyan-700 border border-blue-500 rounded-lg hover:shadow-xl transition duration-100">
                    <i class="fas fa-battery-half text-4xl text-blue-500"></i>
                    <span class="text-lg font-semibold">Status Baterai Penyimpanan</span>
                    <span class="text-xl font-semibold">Normal</span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>