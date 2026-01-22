<?php
session_start();
include 'database_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php"); // Irány a főoldal
        exit;
    } else {
        echo "Hibás e-mail vagy jelszó!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="E-mail" required><br>
    <input type="password" name="password" placeholder="Jelszó" required><br>
    <button type="submit">Belépés</button>
</form>