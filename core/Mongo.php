<?php

declare(strict_types=1);

namespace Core;

use MongoDB\Client;

final class Mongo
{
    public static ?Client $client = null;

    public static function connect(): Client
    {
        if (!self::$client) {
            $uri = $_ENV['MONGO_URI'] ?? getenv('MONGO_URI') ?: null;

            // Explicit TLS configuration for MongoDB Atlas inside Docker/Alpine
            // $options = [
            //     'tls' => true,
            //     'tlsCAFile' => '/etc/ssl/certs/ca-certificates.crt',
            // ];

            self::$client = new Client($uri);
        }
        return self::$client;
    }

    public static function getDB(): \MongoDB\Database
    {
        return self::$client->selectDatabase($_ENV['MONGO_DB'] ?? getenv('MONGO_DB')  ?: null);
    }
}
