<?php
if (isset($_GET['difficulty'])) {
    $_SESSION['difficulty'] = $_GET['difficulty'];
}
?>
<?php if ($difficulty === 'BBT'): ?>    
        <button type="submit" name="choice" value="Lezard" class="btn btn-success btn-xyl">
            <p>🦎</p>
            <p>Lézard</p>
        </button>
        <button type="submit" name="choice" value="Spock" class="btn btn-info btn-xyl">
            <p>🖖</p>
            <p>Spock</p>
        </button>
<?php endif; ?>