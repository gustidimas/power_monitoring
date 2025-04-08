<?php

// Mengambil error jika terjadi kesalahan
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memulai sesi jika sudah ada, maka akan langsung ke dashboard
session_start();
require 'db_config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

// Jika terjadi error, akan tersimpan sementara
$errors = [];

// Jika berhasil registrasi akan muncul pesan
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = "Registrasi berhasil. Silahkan masuk!";
}

// Mengirim data username dan password untuk kebutuhan login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit;
    }

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Password salah!";
        }
    } else {
        $errors[] = "Username tidak ditemukan. Coba lagi!";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Monitoring</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <main class="w-full flex-grow grid grid-cols-1 md:grid-cols-2 items-center">
        <div class="h-full w-full flex flex-row justify-center items-center">
            <div class="bg-white rounded-lg shadow-xl p-8 w-full max-w-md space-y-6">
                <div class="flex flex-col items-center space-y-2">
                    <i class="fa-solid fa-plug-circle-check text-5xl text-blue-500"></i>
                    <h2 class="text-xl font-bold text-gray-800">Login</h2>
                    <p class="text-gray-500">Masukkan user dan password untuk masuk.</p>
                </div>

                <!-- Menampilkan pesan -->
                <?php if (!empty($successMessage)): ?>
                    <div class="text-green-500 text-sm text-center">
                        <p><?php echo htmlspecialchars($successMessage); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="text-red-500 text-sm text-center">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Form Login -->
                <form method="post" class="space-y-4">

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


                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded w-full transition duration-300">
                        Masuk
                    </button>


                    <div class="text-center">
                        <a href="register.php"
                            class="text-blue-500 hover:text-blue-600 font-medium text-sm transition duration-300">
                            Belum punya akun? Daftar di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="h-full w-full bg-[url('assets/solar-panel.png')] bg-cover bg-left bg-no-repeat">
        </div>
    </main>
</body>

</html>