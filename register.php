<?php
include 'database_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Biztonságos jelszó tárolás
    $premium = 0; // Alapesetben nem prémium

    $sql = "INSERT INTO users (name, email, password, premium) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $email, $password, $premium]);
        echo "Sikeres regisztráció! <a href='login.php'>Jelentkezz be itt.</a>";
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Teljes név" required><br>
    <input type="email" name="email" placeholder="E-mail cím" required><br>
    <input type="password" name="password" placeholder="Jelszó" required><br>
    <button type="submit">Regisztráció</button>
</form>