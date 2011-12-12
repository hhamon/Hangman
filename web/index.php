<?php

require __DIR__.'/../autoload.php';

use Hangman\Word;
use Hangman\WordList;
use Hangman\GameContext;
use Hangman\Loader\TextFileLoader;
use Hangman\Loader\XmlFileLoader;
use Hangman\Storage\SessionStorage;

$letters = array(
    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
    'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
    'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
);

$list = new WordList();
$list->load(new TextFileLoader(__DIR__.'/../data/words.txt'));
$list->load(new XmlFileLoader(__DIR__.'/../data/words.xml'));
$list->addWord('programming');

$context = new GameContext(new SessionStorage('hangman'));

// New Game?
if (isset($_GET['new'])) {
    $context->reset();
}

// Restore Game?
if (!$game = $context->loadGame()) {
    $game = $context->newGame(new Word($list->getRandomWord(8)));
}

if (!empty($_GET['letter'])) {
    $game->tryLetter($_GET['letter']);
} else if (!empty($_POST['word'])) {
    $game->tryWord($_POST['word']);
}

$context->save($game);

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
                <?php foreach (str_split((string) $game->getWord()) as $letter) : ?>
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