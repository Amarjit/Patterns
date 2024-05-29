<?php

interface EmailPrototype
{
    public function __clone();
}

class Email implements EmailPrototype
{
    public function __construct(
        private ?string $template = null,
        private ?string $email = null,
        private ?DB $db = null,
        private bool $deep_clone = false
    ) {}

    public function __clone() {
        // Blank email due to privacy reasons.
        $this->email = null;

        // Deep copy the DB object, only.
        if ($this->deep_clone) {
            $this->db = new DB();
        }
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getDB(): DB
    {
        return $this->db;
    }
}

class Template
{
    public function getTemplate(): string
    {
        return "Expensive Template loaded";
    }
}

class DB
{
    public function getConnection(): string
    {
        return "DB Connection established";
    }
}

function shallowCopy(): void
{
    $template = new Template();
    $db = new DB();

    print "Shallow Copy" . PHP_EOL;

    $prototype = new Email('send@mail', $template->getTemplate(), $db, false);
    print ($prototype->getEmail() . " : " . $prototype->getTemplate() . " : DB Obj=" . spl_object_id($prototype->getDB()) . PHP_EOL);

    // No need to set the template again.
    $prototype_2 = clone $prototype;
    print ($prototype_2->getEmail() . " : " . $prototype_2->getTemplate() . " : DB Obj=" . spl_object_id($prototype_2->getDB()) . PHP_EOL);
    $prototype_2->setEmail('send2@mail');
    print ($prototype_2->getEmail() . " : " . $prototype_2->getTemplate() . " : DB Obj=" . spl_object_id($prototype_2->getDB()) . PHP_EOL);
}

function deepCopy(): void
{
    $template = new Template();
    $db = new DB();

    print PHP_EOL . "Deep Copy" . PHP_EOL;

    $prototype = new Email('send@mail', $template->getTemplate(), $db, true);
    print ($prototype->getEmail() . " : " . $prototype->getTemplate() . " : DB Obj=" . spl_object_id($prototype->getDB()) . PHP_EOL);

    $prototype_2 = clone $prototype;
    print ($prototype_2->getEmail() . " : " . $prototype_2->getTemplate() . " : DB Obj=" . spl_object_id($prototype_2->getDB()) . PHP_EOL);
}

shallowCopy();
deepCopy();
