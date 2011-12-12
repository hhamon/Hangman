<?php

namespace Hangman\Loader;

class XmlFileLoader extends FileLoader
{
    public function load()
    {
        $xml = new \SimpleXmlElement(file_get_contents($this->file));
        foreach ($xml->word as $word) {
            $this->words[] = (string) $word;
        }
    }
}