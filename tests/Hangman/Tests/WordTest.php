<?php

namespace Hangman\Tests;

use Hangman\Word;


class WordTest extends \PHPUnit_Framework_TestCase
{
    public function testGuessed()
    {
        $word = new Word('gobelins');
        $this->assertFalse($word->isGuessed());

        $word->guessed();
        $this->assertTrue($word->isGuessed());
    }

    public function testGetWord()
    {
        $word = new Word('php');
        $this->assertEquals(array('p', 'h'), $word->getLetters());
        $this->assertEquals('php', (string) $word);
        $this->assertEquals('php', $word->getWord());
    }

    public function testIsGuessed()
    {
        $word = new Word('php');
        $word->tryLetter('h');
        $this->assertFalse($word->isGuessed());

        $word->tryLetter('p');
        $this->assertTrue($word->isGuessed());
    }

    public function testTryLetter()
    {
        $word = new Word('gobelins');
        $this->assertTrue($word->tryLetter('g'));
        $this->assertEquals(array('g'), $word->getFoundLetters());
    }

    public function testTryLetterWithNonAsciiLetter()
    {
        $this->setExpectedException('InvalidArgumentException');

        $word = new Word('gobelins');
        $word->tryLetter('3');
    }

    public function testTryLetterWithTriedLetter()
    {
        $word = new Word('gobelins');
        $this->assertFalse($word->tryLetter('a'));

        $this->setExpectedException('InvalidArgumentException');
        $word->tryLetter('a');
    }
}