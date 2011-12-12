<?php

require_once __DIR__ .'/../src/Game.php';
require_once __DIR__ .'/../src/Word.php';

class GameTest extends PHPUnit_Framework_TestCase
{
    public function testIsHangedWithWordTrial()
    {
        $game = new Game(new Word('php'));
        $this->assertFalse($game->isHanged());

        $game->tryWord('foo');
        $this->assertTrue($game->isHanged());
    }

    public function testIsHangedWithLetterTrial()
    {
        $game = new Game(new Word('php'));

        $i = $game->getAttempts();
        do {
            $this->assertFalse($game->isHanged());
            $game->tryLetter('a');
            $i++;
        } while ($i < Game::MAX_ATTEMPTS);

        $this->assertTrue($game->isHanged());
    }

    public function testTryWord()
    {
        $game = new Game(new Word('php'));
        $this->assertInstanceOf('Word', $game->getWord());
        $this->assertTrue($game->tryWord('php'));
        $this->assertEquals(0, $game->getAttempts());
    }

    public function testTryInvalidWord()
    {
        $game = new Game(new Word('php'));
        $this->assertFalse($game->tryWord('html'));
        $this->assertEquals(Game::MAX_ATTEMPTS, $game->getAttempts());
    }

    public function testTryLetter()
    {
        $game = new Game(new Word('php'));

        $this->assertFalse($game->tryLetter('3'));
        $this->assertEquals(1, $game->getAttempts());

        $this->assertFalse($game->tryLetter('e'));
        $this->assertEquals(2, $game->getAttempts());

        $this->assertTrue($game->tryLetter('p'));
        $this->assertEquals(2, $game->getAttempts());

        $this->assertFalse($game->tryLetter('p'));
        $this->assertEquals(3, $game->getAttempts());
    }
}