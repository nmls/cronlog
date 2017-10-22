<?php

namespace Cronlog;

class Store implements StoreInterface
{
    private $storeFilePath;
    public $data = [];

    public function __construct($storeFilePath = null)
    {
        if (null === $storeFilePath) {
            $storeFilePath = tempnam('/tmp', 'cronlog');
        }
        $this->storeFilePath = $storeFilePath;
    }

    public function store(string $line): bool
    {
        $this->data[] = $line;
        return true;
    }

    public function __destruct()
    {
        unlink($this->storeFilePath);
    }
}