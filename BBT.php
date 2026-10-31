<?php
$choix = ["Pierre", "Feuille", "Ciseaux", "Lezard", "Spock"];
$image_j = [
    "Pierre" => "./image/pierre.png",
    "Feuille" => "./image/feuille.png",
    "Ciseaux" => "./image/ciseaux.png",
    "Lezard" => "./image/lezard.png",
    "Spock" => "./image/spock.png"
];
$image_o = [
    "Pierre" => "./image/ordip.png",
    "Feuille" => "./image/ordif.png",
    "Ciseaux" => "./image/ordic.png",
    "Lezard" => "./image/ordil.png",
    "Spock" => "./image/ordis.png"
];
$joueurchoix = null;
$ordichoix = null;
$resultat = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["choice"])) {
    $joueurchoix = $_POST["choice"];
    if (!in_array($joueurchoix, $choix, true)) {
        $resultat = "Choix invalide.";
    } else {
        $ordichoix = $choix[array_rand($choix)];
        if ($joueurchoix === $ordichoix) {
            $resultat = "<p class='jaune'>Égalité</p>";
        } elseif (
            ($joueurchoix === "Pierre" && ($ordichoix === "Ciseaux" || $ordichoix === "Lezard")) ||
            ($joueurchoix === "Feuille" && ($ordichoix === "Pierre" || $ordichoix === "Spock")) ||
            ($joueurchoix === "Ciseaux" && ($ordichoix === "Feuille" || $ordichoix === "Lezard")) ||
            ($joueurchoix === "Lezard" && ($ordichoix === "Spock" || $ordichoix === "Feuille")) ||
            ($joueurchoix === "Spock" && ($ordichoix === "Ciseaux" || $ordichoix === "Pierre"))
        ) {
            $resultat = "<p class='vert'>Gagné</p>";
        } else {
            $resultat = "<p class='rouge'>Perdu</p>";
        }
    }
}
?>