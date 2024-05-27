<?php

class Map
{
    protected ?string $a = null;
    protected ?string $b = null;
    protected Author $author;
    protected bool $deep_clone;

    public function __construct(string $a, string $b, Author $author, bool $deep_clone = false)
    {
        $this->a = $a;
        $this->b = $b;
        $this->author = $author;
        $this->deep_clone = $deep_clone;
    }

    public function __clone()
    {
        if ($this->deep_clone) {
            $this->author = new ($this->author);
        }
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }
}

class Author {
    public string $name = 'Jimmy';
}

$author = new Author();
$first = new Map('a', 'a', $author);
$second = new Map('b', 'b', $author);
$clone_first = clone $first;
$fourth = new Map('d', 'd', $author, true);
$clone_fourth = clone $fourth;

print("ID:" . spl_object_id($first) . PHP_EOL);
print("Author ID:" . spl_object_id($first->getAuthor()) . PHP_EOL);
print_r($first);

print("ID:" . spl_object_id($second) . PHP_EOL);
print("Author ID:" . spl_object_id($second->getAuthor()) . PHP_EOL);
print_r($second);

// Shallow copy.
print("ID:" . spl_object_id($clone_first) . PHP_EOL);
print("Author ID:" . spl_object_id($clone_first->getAuthor()) . PHP_EOL);
print_r($clone_first);

print("ID:" . spl_object_id($clone_first) . PHP_EOL);
print("Author ID:" . spl_object_id($clone_first->getAuthor()) . PHP_EOL);
print_r($clone_first);

print("ID:" . spl_object_id($fourth) . PHP_EOL);
print("Author ID:" . spl_object_id($fourth->getAuthor()) . PHP_EOL);
print_r($fourth);

// Deep copy
print("ID:" . spl_object_id($clone_fourth) . PHP_EOL);
print("Author ID:" . spl_object_id($clone_fourth->getAuthor()) . PHP_EOL);
print_r($clone_fourth);