<?php

// Memulai sesi jika belum ada, maka akan langsung ke login
session_start();
require 'db_config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Menyimpan username loggedin sementara
$username = htmlspecialchars($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="w-full min-h-screen flex overflow-x-hidden">
    <div class="flex w-full">
        <!-- Navigasi -->
        <aside class="w-64 min-h-screen bg-blue-100 text-gray-500 flex flex-col p-4">
            <h2 class="text-xl font-bold mb-6 text-black text-center">CSH</h2>
            <nav class="flex flex-col gap-2">
                <a href="index.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Dashboard</a>
                <a href="history.php" class="hover:bg-blue-400 hover:text-white p-2 rounded">Riwayat</a>
                <a href="account.php" class="bg-blue-500 text-white hover p-2 rounded">Akun</a>
                <a href="logout.php" class="bg-red-500 text-white p-2 rounded mt-auto text-center">Keluar</a>
            </nav>
        </aside>
        <main class="w-full flex-grow bg-gray-100 px-4 py-6">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-blue-800">AKUN</h1>
                </div>

                <!-- Data user loggedin -->
                <div class="flex flex-col justify-center items-center">
                    <i class="fas fa-user-circle text-9xl text-blue-400 mb-2"></i>
                    <p class="text-lg font-semibold text-gray-700"><?= $username; ?></p>
                </div>
            </div>
        </main>
    </div>
</body>

</html>