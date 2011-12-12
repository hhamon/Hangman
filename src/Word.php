<?php

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
    public function __construct($word)
    {
        $this->word = $word;
        $this->foundLetters = array();
        $this->triedLetters = array();
    }

    public function __toString()
    {
        return $this->word;
    }

    /**
     * Returns whether or not the word has been guessed.
     *
     * @return Boolean
     */
    public function isGuessed()
    {
        $nbLetters = strlen($this->word);
        for ($i = 0; $i < $nbLetters; $i++) {
            if (!in_array($this->word[$i], $this->foundLetters)) {
                return false;
            }
        }

        return true;
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
            throw new InvalidArgumentException(sprintf('The letter "%s" is not a valid ASCII character matching [a-z].', $letter));
        }

        if (in_array($letter, $this->triedLetters)) {
            throw new InvalidArgumentException(sprintf('The letter "%s" has already been tried.', $letter));
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