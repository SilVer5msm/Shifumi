<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=shifumi;charset=utf8', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM partie WHERE Pseudo_joueur = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['Pseudo_joueur'];
            header('Location: index.php');
            exit();
        }
        if ($user['password'] === $password) {

            $newHash = password_hash($password, PASSWORD_DEFAULT);

            $update = $pdo->prepare("UPDATE partie SET password = ? WHERE IP_Joueur = ?");
            $update->execute([$newHash, $user['IP_Joueur']]);

            $_SESSION['user'] = $user['Pseudo_joueur'];
            header('Location: index.php');
            exit();
        }
    }
    echo "<script>alert('Identifiants incorrects'); window.location.href='index.php';</script>";
}
?>