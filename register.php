<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "db_config.php";

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $reenterPassword = $_POST['reenterPassword'];

    if (empty($username) || empty($password) || empty($reenterPassword)) {
        $errors[] = "Semua kolom wajib diisi.";
    }

    if ($password !== $reenterPassword) {
        $errors[] = "Password tidak cocok.";
    }

    if (empty($errors)) {
        $check_query = "SELECT * FROM users WHERE username = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username sudah digunakan. Silakan gunakan username lain.";
        }

        $check_stmt->close();
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php?success=1");
            exit;
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-gray-100 flex flex-row justify-start items-center px-4 shadow-lg">
        <div class="flex flex-row justify-center items-center">
            <img src="assets/itk.png" alt="ITK" class="w-auto h-28">
            <img src="assets/teknikelektro.png" alt="ITK" class="w-auto h-28">
        </div>
    </header>
    <main class="flex-grow w-full flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md space-y-6">
            <div class="flex flex-col items-center space-y-2">
                <i class="fa-solid fa-user-plus text-5xl text-blue-500"></i>
                <h2 class="text-xl font-bold text-gray-800">Register</h2>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="text-red-500 text-sm text-center">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" id="registrationForm" class="space-y-4">
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="username" name="username" placeholder="Username"
                        class="block border border-gray-300 rounded w-full px-10 py-3 focus:outline-none focus:border-blue-500 transition duration-300"
                        required>
                </div>

                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="password" name="password" placeholder="Password"
                        class="block border border-gray-300 rounded w-full px-10 py-3 focus:outline-none focus:border-blue-500 transition duration-300"
                        required>
                </div>

                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" id="reenterPassword" name="reenterPassword" placeholder="Re-enter Password"
                        class="block border border-gray-300 rounded w-full px-10 py-3 focus:outline-none focus:border-blue-500 transition duration-300"
                        required>
                </div>

                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded w-full transition duration-300">
                    Daftar
                </button>

                <div class="text-center">
                    <a href="login.php"
                        class="text-blue-500 hover:text-blue-600 font-medium text-sm transition duration-300">
                        Sudah punya akun? Masuk di sini
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>