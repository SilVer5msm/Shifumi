<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Shifumi</title>
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
                                    <?php include 'consign.php' ?>
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
                <ul class="navbar-nav ms-auto">

                    <?php if (!isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Connexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <span class="nav-link">Bonjour, <?= htmlspecialchars($_SESSION['user']) ?></span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="logout.php">Déconnexion</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="login.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <p class="mt-3">
                            <a href="#" data-bs-target="#registerModal" data-bs-toggle="modal" data-bs-dismiss="modal">
                                Créer un compte
                            </a>
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Inscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="register.php" method="POST">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Pseudo :</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Créer un compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="titre" style="display: block; width: auto; height: auto;">
        <p>SHIFUMI</p>
    </div>
    <div class="bloc-jeu" style="display: block; width: auto; height: auto;">
        <div class="jeu">
            <form method="post">
                <button type="submit" name="choice" value="Pierre" class="btn btn-primary btn-xyl">
                    <p>🗿</p>
                    <p>Pierre</p>
                </button>
                <button type="submit" name="choice" value="Feuille" class="btn btn-warning btn-xyl">
                    <p>📄</p>
                    <p>Feuille</p>
                </button>
                <button type="submit" name="choice" value="Ciseaux" class="btn btn-danger btn-xyl">
                    <p>✂</p>
                    <p>Ciseaux</p>
                </button>
                <?php include 'Bibath.php'; ?>
            </form>

            <?php
            if (isset($_GET['difficulty'])) {
                $_SESSION['difficulty'] = $_GET['difficulty'];
            }

            $difficulty = $_SESSION['difficulty'] ?? 'classic';

            switch ($difficulty) {
                case 'classic':
                    include 'classic.php';
                    break;
                case 'hard':
                    include 'hard.php';
                    break;
                case 'BBT':
                    include 'BBT.php';
                    break;
            }
            ?>

            <?php if ($joueurchoix !== null && $ordichoix !== null): ?>
                <div class="block_result">
                    <div class="result" style="display: flex; margin-top: 40px; flex-direction: column; align-items: center;">
                        <p>Vous avez choisi : <?= htmlspecialchars($joueurchoix) ?></p>
                        <?php if (isset($image_j[$joueurchoix])): ?>
                            <img src="<?= $image_j[$joueurchoix] ?>" width="300">
                        <?php endif; ?>
                    </div>
                    <div class="result" style="display: flex; margin-top: 40px; flex-direction: column; align-items: center;">
                        <?php if ($difficulty === 'hard'): ?>
                            <p>Ultron a choisi : <?= htmlspecialchars($ordichoix) ?></p>
                        <?php else : ?>
                            <p>L'ordinateur a choisi : <?= htmlspecialchars($ordichoix) ?></p>
                        <?php endif; ?>
                        <?php if (isset($image_o[$ordichoix])): ?>
                            <img src="<?= $image_o[$ordichoix] ?>" width="300">
                        <?php endif; ?>
                    </div>
                </div>
                <p><?= $resultat ?></p>
            <?php elseif ($resultat !== ""): ?>
                <div class="result"><?= $resultat ?></div>
            <?php endif; ?>

            <form method="post">
                <button type="submit" name="relancer" class="btn btn-light btn-xl">🔄 Reset</button>
            </form>
        </div>
    </div>
    <div class="bloc-score" style="display: block; width: auto; height: auto;">
        <p>Tableau des scores</p>
        <?php
        if (isset($_POST["relancer"])) {
            $_SESSION["scores"] = [
                "player" => 0,
                "ordi" => 0
            ];
            $_SESSION['tours'] = 0;
        }
        if (!isset($_SESSION['tours'])) {
            $_SESSION['tours'] = 0;
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["choice"])) {
            $joueurchoix = $_POST["choice"];
            $_SESSION['tours']++;
        }
        echo "<p>Tour n° : " . $_SESSION['tours'] . "</p>";
        ?>
        <div class="score">
            <?php
            if (!isset($_SESSION["scores"])) {
                $_SESSION["scores"] = [
                    "player" => 0,
                    "ordi" => 0
                ];
            }
            if ($joueurchoix === $ordichoix) {
            } elseif (
                ($joueurchoix === "Pierre" && ($ordichoix === "Ciseaux" || $ordichoix === "Lezard")) ||
                ($joueurchoix === "Feuille" && ($ordichoix === "Pierre" || $ordichoix === "Spock")) ||
                ($joueurchoix === "Ciseaux" && ($ordichoix === "Feuille" || $ordichoix === "Lezard")) ||
                ($joueurchoix === "Lezard" && ($ordichoix === "Spock" || $ordichoix === "Feuille")) ||
                ($joueurchoix === "Spock" && ($ordichoix === "Ciseaux" || $ordichoix === "Pierre"))
            ) {
                $_SESSION["scores"]["player"]++;
            } else {
                $_SESSION["scores"]["ordi"]++;
            }
            ?>
            <div class="tableau">
                <div class="affichage">
                    <p>Vous</p>
                    <?php echo $_SESSION["scores"]["player"]; ?>
                </div>
                <div class="affichage">
                    <?php if ($difficulty === 'hard'): ?>
                        <p>Ultron</p>
                    <?php else : ?>
                        <p>Ordinateur</p>
                    <?php endif; ?>
                    <?php echo $_SESSION["scores"]["ordi"]; ?>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>