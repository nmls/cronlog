<?php

namespace Cronlog;

interface StoreInterface
{
    public function store(string $uuid): bool;
}