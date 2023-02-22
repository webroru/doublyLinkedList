<?php

declare(strict_types=1);

spl_autoload_register(fn ($className) => include $className . '.php');

$list = new DoublyLinkedList();

$list->push(1);
$list->push(2);
$list->push(3);

print_r($list->toArray());

echo $list->pop() . PHP_EOL;
echo $list->pop() . PHP_EOL;
echo $list->pop() . PHP_EOL;

$list->unshift('foo');
$list->unshift('bar');
$list->unshift('baz');

print_r($list->toArray());

echo $list->shift() . PHP_EOL;
echo $list->shift() . PHP_EOL;
echo $list->shift() . PHP_EOL;

print_r($list->toArray());

$list->push(1);
$list->push(2);
$list->push(3);
$list->insertAt(0, 0);

print_r($list->toArray());

$list->removeAt(0);

print_r($list->toArray());
