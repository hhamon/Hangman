<?php

namespace Hangman\Loader;

interface LoaderInterface
{
    /**
     * Loads a words list data source.
     *
     * @return void
     */
    public function load();

    /**
     * Returns an array of words.
     *
     * @return array
     */
    public function getWords();
}