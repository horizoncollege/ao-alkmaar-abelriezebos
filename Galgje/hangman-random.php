<!DOCTYPE html>
<html>

<head>
    <title>Galgje - random</title>
    <link rel="stylesheet" href="hangman.css">
</head>

<body>
    <h1>Galgje</h1>
    <?php
    session_start();

    if (isset($_SESSION['word'])) {
        // Use the previously selected word
        $random_word = $_SESSION['word'];
    } else {
        // Open the readme.txt file in read mode
        $file = fopen('words.txt', 'r');

        // Read the contents of the file into an array
        $words = explode("\n", fread($file, filesize('words.txt')));

        // Close the file
        fclose($file);

        // Pick a random word from the array
        $random_word = rtrim($words[array_rand($words)], "\t\n\r\0\x0B");

        // Store the selected word in the session
        $_SESSION['word'] = $random_word;
    }

    $word = $random_word;
    $letters_guessed = [];
    $incorrect_guesses = 0;
    $max_incorrect_guesses = 10;



    if (!isset($_SESSION['letters_guessed'])) {
        $_SESSION['letters_guessed'] = [];
    }

    if (!isset($_SESSION['incorrect_guesses'])) {
        $_SESSION['incorrect_guesses'] = 0;
    }

    if (isset($_GET['guess'])) {
        $guess = $_GET['guess'];
        if (in_array($guess, $letters_guessed)) {
            echo "You've already used the letter '$guess', please try again.";
        } elseif (strpos($guess, " ") !== false) {
            echo "You cannot use a space for a guess. Please try again.<br>";
        } else {
            if (!in_array($guess, $_SESSION['letters_guessed'])) {
                $_SESSION['letters_guessed'][] = $guess;
                if (!in_array($guess, str_split($word))) {
                    $_SESSION['incorrect_guesses']++;
                }
            }
        }
    }

    $letters_guessed = $_SESSION['letters_guessed'];
    $incorrect_guesses = $_SESSION['incorrect_guesses'];
    // Check if the player has won or lost
    if ($incorrect_guesses >= $max_incorrect_guesses) {
        echo "Je hebt verloren, het woord was $word.";
        $guess = '';
        $_GET = '';
        echo "<form>";
        echo "<a href='index.php'>Home</a>";
        echo "<a href='hangman-random.php'>Play Again</a>";
        echo "</form>";
        session_destroy();
    } else {
        $word_is_complete = true;
        foreach (str_split($word) as $letter) {
            if (!in_array($letter, $letters_guessed)) {
                $word_is_complete = false;
                break;
            }
        }

        if ($word_is_complete) {
            echo "Je hebt gewonnen, het woord was $word.";
            $guess = '';
            $_GET = '';
            echo "<form>";
            echo "<a href='index.php'>Home</a>";
            echo "<a href='hangman-random.php'>Play Again</a>";
            echo "</form>";
            session_destroy();
        } else {
            // Display the current state of the game
            echo "Woord: ";
            foreach (str_split($word) as $letter) {
                if (in_array($letter, $letters_guessed)) {
                    echo $letter;
                } else {
                    echo "_";
                }
            }
            echo "<br>";
            echo "Incorrect Guesses: $incorrect_guesses/$max_incorrect_guesses<br>";
            echo "Letters Guessed: " . implode(", ", $letters_guessed) . "<br>";

            // Display the form for guessing a letter
            echo "<form action='hangman-random.php' method='get'>";
            echo "Guess a letter:";
            echo "<input type='text' name='guess'>";
            echo "<input type='submit' value='guess'>";
            echo "</form>";
        }
    }
    if ($incorrect_guesses == 1) {
        echo '<img src="img/stand.png" alt="stand">';
    } elseif ($incorrect_guesses == 2) {
        echo '<img src="img/standarm.png" alt="stand">';
    } elseif ($incorrect_guesses == 3) {
        echo '<img src="img/standarmtop.png" alt="stand">';
    } elseif ($incorrect_guesses == 4) {
        echo '<img src="img/standarmtopstick.png" alt="stand">';
    } elseif ($incorrect_guesses == 5) {
        echo '<img src="img/head.png" alt="stand">';
    } elseif ($incorrect_guesses == 6) {
        echo '<img src="img/body.png" alt="stand">';
    } elseif ($incorrect_guesses == 7) {
        echo '<img src="img/feet1.png" alt="stand">';
    } elseif ($incorrect_guesses == 8) {
        echo '<img src="img/feet2.png" alt="stand">';
    } elseif ($incorrect_guesses == 9) {
        echo '<img src="img/arm1.png" alt="stand">';
    } elseif ($incorrect_guesses == 10) {
        echo '<img src="img/complete.png" alt="stand">';
    }
    ?>
</body>

</html>