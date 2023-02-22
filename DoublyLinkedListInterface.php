<?php

declare(strict_types=1);

interface DoublyLinkedListInterface
{
    public function push(mixed $value): void;
    public function pop(): mixed;
    public function shift(): mixed;
    public function unshift(mixed $value): void;
    public function insertAt(int $index, mixed $value): void;
    public function removeAt (int $index): void;
}
