<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=shifumi;charset=utf8', 'root', '');


if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $check = $pdo->prepare("SELECT IP_Joueur FROM partie WHERE Pseudo_joueur = ?");
    $check->execute([$username]);

    if ($check->rowCount() > 0) {
        echo "Pseudo déjà utilisé.";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO partie (Pseudo_joueur, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);


    $_SESSION['user'] = [
        'IP_Joueur' => $pdo->lastInsertId(),
        'username' => $username
    ];

    header("Location: index.php");
    exit;
}
?>
