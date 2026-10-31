<?php
if (isset($_GET['difficulty'])) {
    $_SESSION['difficulty'] = $_GET['difficulty'];
}
$difficulty = $_SESSION['difficulty'] ?? 'BBT';
?>
<?php if ($difficulty === 'classic'): ?>
    <div class="modal-body">
        <p>Vous connaisez tous le jeu du Shifumi ! Pierre, Feuille, Ciseaux,
        l'un l'emporte sur l'autre. En mode classique, jouez à ce jeu de
        la récré contre L'ordinateur. Voici un rappel des règles :</p>
        <p>• Les ciseaux battent la feuille.</p>
        <p>• La feuille bat la pierre.</p>
        <p>• La pierre bat les ciseaux.</p>
    </div>

<?php elseif ($difficulty === 'BBT'): ?>
    <div class="modal-body">
        <p>Dans le mode Big Bang Theory, jouez à une nouvelle
            version populaire du jeu avec deux nouveaux choix : le lézard et le Spock !</p>
        <p>• Les ciseaux battent la feuille et le lézard.</p>
        <p>• La feuille bat la pierre et Spock.</p>
        <p>• La pierre bat le lézard et les ciseaux.</p>
        <p>• Le lézard bat Spock et la feuille.</p>
        <p>• Spock bat les ciseaux et la pierre.</p>
    </div>

<?php else : ?>
    <div class="modal-body">
        <p>Oh non ! Ultron est sur le point d'envahir notre monde
            avec son armée de robot ! Heuresement, cette grosse boite de
            conserve nous laisse une chance à nous les humains, à condition
            que nous le battions au jeu du Shifumi. C'est à vous que revient
            la tâche de sauvez l'humanité, mais attention, Ultron ne se laissera
            pas faire et est beaucoup plus corriace que tous ceux que vous avez
            affrontez jusqu'à maintenant. Voici un rappel des règles :</p>
        <p>• Les ciseaux battent la feuille.</p>
        <p>• La feuille bat la pierre.</p>
        <p>• La pierre bat les ciseaux.</p>
    </div>

<?php endif; ?>