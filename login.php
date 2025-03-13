<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'db_config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = "Registrasi berhasil!";
}

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
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
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
</head>

<body class="w-full min-h-screen flex flex-col justify-start items-center">
    <header class="w-full bg-gray-100 flex flex-row justify-start items-center px-4">
        <img src="assets/itk.png" alt="ITK" class="w-36 h-24">
    </header>
    <div class="h-full flex flex-col justify-center items-center flex-grow">
        <div class="border rounded min-w-[32rem] max-w-4xl p-4">
            <h1 class="text-2xl font-bold text-center w-full">Login</h1>

            <form method="post" class="space-y-2">
                <label for="username" class="text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="block border rounded w-full px-2 py-3" required>

                <label for="password" class="text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="block border rounded w-full px-2 py-3" required>

                <?php if (!empty($successMessage)): ?>
                    <div class="text-green-500 text-sm text-center mb-4">
                        <p><?php echo htmlspecialchars($successMessage); ?></p>
                    </div>
                <?php endif; ?>

                <div class="flex flex-col justify-center items-center space-y-2">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Masuk</button>
                    <a href="register.php" class="border border-blue-600 text-blue-600 font-semibold py-2 px-4 rounded hover:bg-blue-100 transition duration-300">Belum punya akun</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>