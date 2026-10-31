<?php
// Connexion à la base
$conn = new mysqli("localhost", "root", "", "shifumi");

// Données récupérées celon taux de réussite
$sql = "SELECT Pseudo_joueur, Nb_tours, Nb_victoire, Taux_reussite, Timestamp_
        FROM partie
        ORDER BY Taux_reussite DESC, Nb_tours DESC
        LIMIT 20";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Classement</title>
    <style>
        body {
            background-image: url("image/arene.avif");
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Règles</a>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Règle du jeu</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="classement.php">Classement</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Modes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?difficulty=classic">Classique</a></li>
                            <li><a class="dropdown-item" href="index.php?difficulty=hard">Difficile</a></li>
                            <li><a class="dropdown-item" href="index.php?difficulty=BBT">Big Bang Theory</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mb-4">🏆 Classement Shifumi</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Pseudo</th>
                    <th>Tours joués</th>
                    <th>Victoires</th>
                    <th>Taux de réussite (%)</th>
                    <th>Dernière partie</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Pseudo_joueur'] ?? 'Anonyme') ?></td>
                        <td><?= $row['Nb_tours'] ?></td>
                        <td><?= $row['Nb_victoire'] ?></td>
                        <td><?= number_format($row['Taux_reussite'], 2) ?></td>
                        <td><?= $row['Timestamp_'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>

</html>