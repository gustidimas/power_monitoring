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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-gray-100 flex flex-row justify-start items-center px-4">
        <img src="assets/itk.png" alt="ITK" class="w-36 h-24">
    </header>
    <div class="h-full flex flex-col justify-center items-center flex-grow">
        <div class="border rounded min-w-[32rem] max-w-4xl p-4">
            <h1 class="text-2xl font-bold text-center w-full">Register</h1>

            <form method="post" id="registrationForm" class="space-y-2">
                <label for="username" class="text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="block border rounded w-full px-2 py-3" required>

                <label for="password" class="text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="block border rounded w-full px-2 py-3" required>

                <label for="reenterPassword" class="text-gray-700">Re-enter Password</label>
                <input type="password" id="reenterPassword" name="reenterPassword" class="block border rounded w-full px-2 py-3" required>

                <?php if (!empty($errors)): ?>
                    <div class="text-red-500 text-sm text-center mb-4">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo htmlspecialchars($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="flex flex-col justify-center items-center space-y-2">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Daftar</button>
                    <a href="login.php" class="border border-blue-600 text-blue-600 font-semibold py-2 px-4 rounded hover:bg-blue-100 transition duration-300">Sudah punya akun</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>