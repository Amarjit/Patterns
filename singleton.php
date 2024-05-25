<?php

declare(strict_types=1);

class DatabaseConnection
{
    private static ?DatabaseConnection $dbInstance = null;

    // Do not allow to create an instance of the class from outside.
    private function __construct()
    {
    }

    public static function getConnection(): DatabaseConnection
    {
        if (static::$dbInstance === null) {
            static::$dbInstance = new DatabaseConnection();
        }

        return static::$dbInstance;
    }

    public function query(string $sql): string
    {
        return "Query: $sql";
    }
}

$db = DatabaseConnection::getConnection();
$db2 = DatabaseConnection::getConnection();

print $db->query('SELECT * FROM users') .PHP_EOL;
$db2 = DatabaseConnection::getConnection();
print $db2->query('SELECT * FROM posts') . PHP_EOL;

if (spl_object_id($db) === spl_object_id($db2)) {
    print "Same instance\n";
} else {
    print "Different instance\n";
}