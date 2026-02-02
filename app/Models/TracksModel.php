<?php

declare(strict_types=1);

namespace App\Models;

use Core\Mongo;
use MongoDB\Collection;

class TracksModel
{
    private Collection $collection;

    public function __construct()
    {
        $this->collection = Mongo::getDB()->selectCollection('tracks');
    }

    public function getAllTracks(): array
    {
        return $this->collection->find()->toArray();
    }
}
