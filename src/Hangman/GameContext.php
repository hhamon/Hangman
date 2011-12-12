<?php

namespace Hangman;

use Hangman\Storage\StorageInterface;

class GameContext
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function reset()
    {
        $this->storage->write('hangman', array());
    }

    public function newGame(Word $word)
    {
        return new Game($word);
    }

    public function loadGame()
    {
        $data = $this->storage->read('hangman');

        if (!count($data)) {
            return false;
        }

        $word = new Word(
            $data['word'],
            $data['found_letters'],
            $data['tried_letters']
        );

        return new Game($word, $data['attempts']);
    }

    public function save(Game $game)
    {
        $data = $game->getContext();

        $this->storage->write('hangman', $data);
    }
}