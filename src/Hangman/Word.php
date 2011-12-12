<?php

namespace Hangman;

class Word 
{
    private $word;
    private $foundLetters;
    private $triedLetters;

    /**
     * Constructor.
     *
     * @param string $word The word to guess.
     */
    public function __construct($word, array $foundLetters = array(), array $triedLetters = array())
    {
        $this->word = $word;
        $this->foundLetters = $foundLetters;
        $this->triedLetters = $triedLetters;
    }

    public function __toString()
    {
        return $this->word;
    }

    public function guessed()
    {
        $this->foundLetters = $this->getLetters();
    }

    public function getFoundLetters()
    {
        return $this->foundLetters;
    }

    public function getTriedLetters()
    {
        return $this->triedLetters;
    }

    public function getLetters()
    {
        return array_unique(str_split($this->word));
    }

    /**
     * Returns whether or not the word has been guessed.
     *
     * @return Boolean
     */
    public function isGuessed()
    {
        $diff = array_diff($this->getLetters(), $this->foundLetters);

        return 0 === count($diff);
    }

    /**
     * Tries to guess a letter.
     *
     * @param string $letter A letter to try
     * @return Boolean
     * @throws InvalidArgumentException
     */
    public function tryLetter($letter)
    {
        $letter = strtolower($letter);
        if (0 === preg_match('/^[a-z]$/', $letter)) {
            throw new \InvalidArgumentException(sprintf('The letter "%s" is not a valid ASCII character matching [a-z].', $letter));
        }

        if (in_array($letter, $this->triedLetters)) {
            throw new \InvalidArgumentException(sprintf('The letter "%s" has already been tried.', $letter));
        }

        $this->triedLetters[] = $letter;

        if (false !== strpos($this->word, $letter)) {
            $this->foundLetters[] = $letter;

            return true;
        }

        return false;
    }

    /**
     * Returns the word to guess.
     *
     * @return string The word to guess.
     */
    public function getWord()
    {
        return $this->word;
    }
}