<?php

namespace Hangman\Loader;

class TextFileLoader extends FileLoader
{
    public function load()
    {
        $this->words = array_map('trim', file($this->file));
    }
}