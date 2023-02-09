<!DOCTYPE html>
<html>

<head>
    <script>
        function hidePlayer1() {
            document.getElementById("player1choice").style.display = "none";
        }

        function showPlayer1() {
            document.getElementById("player1choice").style.display = "block";
        }

        function hidePlayer2() {
            document.getElementById("player2choice").style.display = "none";
        }

        function showPlayer2() {
            document.getElementById("player2choice").style.display = "block";
        }
    </script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>1-Player Rock-Paper-Scissors Game</h1>
    <form>
        <h2>Player 1</h2>
        <button type="button" onclick="hidePlayer1()">Hide Choice</button>
        <button type="button" onclick="showPlayer1()">Reveal Choice</button>
        <div id="player1choice">
            <br>
            <input type="radio" id="rock" name="choice" value="rock">
            <label for="rock">Rock</label>
            <br>
            <input type="radio" id="paper" name="choice" value="paper">
            <label for="paper">Paper</label>
            <br>
            <input type="radio" id="scissors" name="choice" value="scissors">
            <label for="scissors">Scissors</label>
            <br>

            <?php
            if (isset($_GET['choice'])) {
                echo "Player 1 chose: " . $_GET['choice'];
            }
            ?>
        </div>
        <br>
        <input type="submit" value="Submit">
        <?php
        function declareWinner($playerchoice, $botchoice)
        {
            if ($playerchoice == $botchoice) {
                return "It's a tie!";
            } elseif ($playerchoice == "rock" && $botchoice == "scissors") {
                return "You win with rock!";
            } elseif ($playerchoice == "rock" && $botchoice == "paper") {
                return "Bot wins with paper!";
            } elseif ($playerchoice == "paper" && $botchoice == "rock") {
                return "You win with paper!";
            } elseif ($playerchoice == "paper" && $botchoice == "scissors") {
                return "Bot wins with scissors!";
            } elseif ($playerchoice == "scissors" && $botchoice == "rock") {
                return "Bot wins with rock!";
            } elseif ($playerchoice == "scissors" && $botchoice == "paper") {
                return "You win with scissors!";
            }
        }

        if (isset($_GET['choice'])) {
            $choices = array("rock", "paper", "scissors");
            $randomIndex = array_rand($choices);
            $botchoice = $choices[$randomIndex];
            $result = declareWinner($_GET['choice'], $botchoice);
            echo $result;
        }
        ?><br>
        <div class="home">
            <button><a href="index.php">Home</a></button>
        </div>
    </form>

</body>

</html>