<?php

namespace Hangman;

use Hangman\Loader\LoaderInterface;

class WordList
{
    private $words;

    public function __construct()
    {
        $this->words = array();
    }

    public function getRandomWord($length)
    {
        if (!isset($this->words[$length])) {
            throw new \InvalidArgumentException(sprintf('There is no word of length %u.', $length));
        }

        $key = array_rand($this->words[$length]);

        return $this->words[$length][$key];
    }

    public function addWord($word)
    {
        $length = strlen($word);

        if (!isset($this->words[$length])) {
            $this->words[$length] = array();
        }

        if (!in_array($word, $this->words[$length])) {
            $this->words[$length][] = $word;
        }
    }

    public function load(LoaderInterface $loader)
    {
        $loader->load();

        foreach ($loader->getWords() as $word) {
            $this->addWord($word);
        }
    }
}