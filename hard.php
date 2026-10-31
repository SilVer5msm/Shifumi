<?php
$choix = ["Pierre", "Feuille", "Ciseaux"];
$image_j = [
    "Pierre" => "./image/pierre.png",
    "Feuille" => "./image/feuille.png",
    "Ciseaux" => "./image/ciseaux.png"
];
$image_o = [
    "Pierre" => "./image/ordip.png",
    "Feuille" => "./image/ordif.png",
    "Ciseaux" => "./image/ordic.png"
];
$joueurchoix = null;
$ordichoix = null;
$resultat = "";

if (!isset($_SESSION['tour'])) {
    $_SESSION['tour'] = 1;
    $_SESSION['ultron_historique'] = [];
    $_SESSION['joueur_historique'] = [];
    $_SESSION['ultron_t1'] = null;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["choice"])) {
    $joueurchoix = $_POST["choice"];
    if (!in_array($joueurchoix, $choix, true)) {
        $resultat = "Choix invalide.";
    } else {
        $tour = $_SESSION['tour'];

        switch ($tour) {
            case 1:
                $ordichoix = $choix[array_rand($choix)];
                $_SESSION['ultron_t1'] = $ordichoix;
                break;
            case 2:
                if ($joueurchoix === "Pierre") $ordichoix = "Feuille";
                if ($joueurchoix === "Feuille") $ordichoix = "Ciseaux";
                if ($joueurchoix === "Ciseaux") $ordichoix = "Pierre";
                break;
            case 3:
                $ordichoix = $_SESSION['ultron_t1'];
                break;
            case 4:
                $historique = $_SESSION['ultron_historique'];
                $nonutil = array_diff($choix, $historique);
                if (!empty($nonutil)) {
                    $ordichoix = array_values($nonutil)[0];
                } else {
                    $counts = array_count_values($historique);
                    asort($counts);
                    $ordichoix = array_keys($counts)[0];
                }
                break;
            case 5:
                $historiqueJoueur = $_SESSION['joueur_historique'];
                if (count($historiqueJoueur) >= 2) {
                    $avantDernier = array_slice($historiqueJoueur, -2, 1)[0];
                    $ordichoix = $avantDernier;
                } else {
                    $ordichoix = $choix[array_rand($choix)];
                }
                break;
        }

        $_SESSION['ultron_historique'][] = $ordichoix;
        $_SESSION['joueur_historique'][] = $joueurchoix;

        if ($joueurchoix === $ordichoix) {
            $resultat = "<p class='jaune'>Égalité</p>";
        } elseif (
            ($joueurchoix === "Pierre" && $ordichoix === "Ciseaux") ||
            ($joueurchoix === "Feuille" && $ordichoix === "Pierre") ||
            ($joueurchoix === "Ciseaux" && $ordichoix === "Feuille")
        ) {
            $resultat = "<p class='vert'>Gagné</p>";
        } else {
            $resultat = "<p class='rouge'>Perdu</p>";
        }

        $_SESSION['tour']++;
        if ($_SESSION['tour'] > 5) {
            $_SESSION['tour'] = 1;
        }
    }
}
?>