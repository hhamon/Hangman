<?php

require_once __DIR__ .'/../src/Game.php';

$letters = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
    'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
    'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
);

$game = new Game(new Word('gobelins'));


?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Hangman Game</title>
    </head>
    <body>
        <h1>Hangman Game (<?php echo $game->getWord() ?>)</h1>

        <?php if ($game->isHanged()) : ?>
            <p>Oops, you're hanged... The word to guess was <strong><?php echo $game->getWord() ?></strong>.</p>
        <?php elseif ($game->isWon()) : ?>
            <p>Congratulations, you found the word <strong><?php echo $game->getWord() ?></strong> and won this party.</p>
        <?php else : ?>
            <p>You still have <?php echo $game->getRemainingAttempts() ?> remaining attempts.</p>
            <p>
                <?php foreach ($game->getWord()->getLetters() as $letter) : ?>
                    <?php echo $game->isLetterFound($letter) ? $letter : '?' ?>
                    &nbsp;
                <?php endforeach ?>
            </p>
        <?php endif ?>

        <h2>Try a letter</h2>

            <p>
            <?php foreach ($letters as $letter) : ?>
                <a href="index.php?letter=<?php echo $letter ?>"><?php echo $letter ?></a>&nbsp;
            <?php endforeach ?>
            </p>

        <h2>Try a word</h2>

            <form action="index.php" method="post">
                <p>
                    <label for="word">Word:</label>
                    <input type="text" name="word"/>
                    <button type="submit">Let me guess...</button>
                </p>
            </form>

    </body>
</html>