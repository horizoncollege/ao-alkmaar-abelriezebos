<?php
function checkWord($word)
{
    // Use regular expressions to check for numbers and symbols
    if (preg_match('/[^a-zA-Z]/', $word)) {
        echo "Sorry, je kan geen cijfers of tekens gebruiken!";
    } else {
        // Store the word in a session variable
        session_start();
        $_SESSION['word'] = $word;
        // Redirect to hangman-keuze.php page
        header("Location: hangman-keuze.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galgje - Kies woord</title>
    <link rel="stylesheet" href="hangman.css">
</head>

<body>
    <h1>GALGJE</h1>
    <form action="" method="POST">
        <input type="text" placeholder="Voer hier uw woord in" name="word">
        <input type='submit' value='word'>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the word from the form
        $word = $_POST['word'];
        // Check the word
        checkWord($word);
    }
    ?>
</body>

</html>