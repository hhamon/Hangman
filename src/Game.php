<?php

require_once __DIR__.'/Word.php';

class Game 
{
    const MAX_ATTEMPTS = 11;

    private $word;
    private $attempts;

    public function __construct(Word $word)
    {
        $this->word = $word;
        $this->attempts = 0;
    }

    public function isHanged()
    {
        return static::MAX_ATTEMPTS === $this->attempts;
    }

    public function getWord()
    {
        return $this->word;
    }

    public function getAttempts()
    {
        return $this->attempts;
    }

    public function tryWord($word)
    {
        if ($word === $this->word->getWord()) {
            return true;
        }

        $this->attempts = self::MAX_ATTEMPTS;

        return false;
    }

    public function tryLetter($letter)
    {
        $result = false;

        try {
            $result = $this->word->tryLetter($letter);
        } catch (InvalidArgumentException $e) {
            
        }

        if (false === $result) {
            $this->attempts++;
        }

        return $result;
    }
}