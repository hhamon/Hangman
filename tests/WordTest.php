<?php

require_once __DIR__ .'/../src/Word.php';

class WordTest extends PHPUnit_Framework_TestCase
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
        $word = new Word('gobelins');
        $this->assertEquals('gobelins', (string) $word);
        $this->assertEquals('gobelins', $word->getWord());
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