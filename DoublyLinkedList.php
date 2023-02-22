<?php

declare(strict_types=1);

class DoublyLinkedList implements DoublyLinkedListInterface
{
    private ?Node $head = null;
    private ?Node $tail = null;

    public function push(mixed $value): void
    {
        $node = new Node($value);
        $prev = $this->tail;
        if ($prev) {
            $prev->next = $node;
        }
        $node->prev = $prev;
        $this->tail = $node;
        $this->head = $this->head ?? $node;
    }

    public function pop(): mixed
    {
        $lastNode = $this->tail ?? throw new RuntimeException();
        $prev = $lastNode->prev;
        if ($prev) {
            $prev->next = null;
        }
        $this->tail = $prev;
        $this->head = $this->head === $lastNode ? null : $this->head;
        return $lastNode->data;
    }

    public function shift(): mixed
    {
        $firstNode = $this->head ?? throw new RuntimeException();
        $next = $firstNode->next;
        if ($next) {
            $next->prev = null;
        }
        $this->head = $next;
        $this->tail = $this->tail === $firstNode ? null : $this->tail;
        return $firstNode->data;
    }

    public function unshift(mixed $value): void
    {
        $node = new Node($value);
        $next = $this->head;
        if ($next) {
            $next->prev = $node;
        }
        $node->next = $next;
        $this->head = $node;
        $this->tail = $this->tail ?? $node;
    }

    public function insertAt(int $index, mixed $value): void
    {
        if ($index < 0) {
            throw new OutOfRangeException();
        }

        if ($index === 0) {
            $this->unshift($value);
            return;
        }

        $currentNode = $this->head;

        $currentIndex = 0;
        while ($currentIndex++ < $index) {
            if (!$currentNode) {
                throw new OutOfRangeException();
            }
            $currentNode = $currentNode->next;
        }

        if (!$currentNode) {
            $this->push($value);
        } else {
            $node = new Node($value);
            $currentNode->prev->next = $node;
            $node->prev = $currentNode->prev;
            $node->next = $currentNode;
        }
    }

    public function removeAt(int $index): void
    {
        $currentNode = $this->head;

        if ($index < 0 || !$currentNode) {
            throw new OutOfRangeException();
        }

        for ($i = 0; $i <= $index; $i++) {
            if ($i === $index) {
                if ($currentNode->prev) {
                    $currentNode->prev->next = $currentNode->next;
                } else {
                    $this->head = $currentNode->next;
                }

                if ($currentNode->next) {
                    $currentNode->next->prev = $currentNode->prev;
                } else {
                    $this->tail = $currentNode->prev;
                }
                return;
            }
            $currentNode = $currentNode->next ?? throw new OutOfRangeException();
        }
    }

    public function toArray(): array
    {
        $result = [];
        $currentNode = $this->head;
        while ($currentNode !== null) {
            $result[] = $currentNode->data;
            $currentNode = $currentNode->next;
        }
        return $result;
    }
}
