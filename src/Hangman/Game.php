<?php

namespace Hangman;

class Game 
{
    const MAX_ATTEMPTS = 11;

    private $word;
    private $attempts;

    public function __construct(Word $word, $attempts = 0)
    {
        $this->word = $word;
        $this->attempts = (int) $attempts;
    }

    public function getContext()
    {
        return array(
            'word'          => (string) $this->word,
            'attempts'      => $this->attempts,
            'found_letters' => $this->word->getFoundLetters(),
            'tried_letters' => $this->word->getTriedLetters()
        );
    }

    public function getRemainingAttempts()
    {
        return static::MAX_ATTEMPTS - $this->attempts;
    }

    public function isLetterFound($letter)
    {
        return in_array($letter, $this->word->getFoundLetters());
    }

    public function isHanged()
    {
        return static::MAX_ATTEMPTS === $this->attempts;
    }

    public function isWon()
    {
        return $this->word->isGuessed();
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
            $this->word->guessed();

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
        } catch (\InvalidArgumentException $e) {
            
        }

        if (false === $result) {
            $this->attempts++;
        }

        return $result;
    }
}