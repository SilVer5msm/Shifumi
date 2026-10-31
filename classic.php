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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["choice"])) {
    $joueurchoix = $_POST["choice"];
    if (!in_array($joueurchoix, $choix, true)) {
        $resultat = "Choix invalide.";
    } else {
        $ordichoix = $choix[array_rand($choix)];
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
    }
}
?>