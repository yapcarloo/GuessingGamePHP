<?php
session_start();

// Initialize the game
if (!isset($_SESSION['target_number'])) {
    $_SESSION['target_number'] = rand(1, 100); // Random number between 1 and 100
    $_SESSION['attempts'] = 0;
    $message = "Guess a number between 1 and 100!";
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $guess = intval($_POST['guess']);
        $_SESSION['attempts']++;

        if ($guess < $_SESSION['target_number']) {
            $message = "Too low! Try again.";
        } elseif ($guess > $_SESSION['target_number']) {
            $message = "Too high! Try again.";
        } else {
            $message = "Congratulations! You guessed the number in {$_SESSION['attempts']} attempts.";
            session_destroy(); // End the session to reset the game
        }
    } else {
        $message = "Enter your guess!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>
    <p><?php echo $message; ?></p>

    <?php if (isset($_SESSION['target_number'])): ?>
        <form method="POST">
            <label for="guess">Your Guess:</label>
            <input type="number" name="guess" id="guess" required>
            <button type="submit">Submit</button>
        </form>
    <?php else: ?>
        <a href="guessing_game.php">Play Again</a>
    <?php endif; ?>
</body>
</html>
