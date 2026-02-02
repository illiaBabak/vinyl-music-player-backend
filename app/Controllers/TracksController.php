<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\TracksModel;
use Core\Response;

final class TracksController 
{
    public function getAllTracks()
    {
        $tracks = (new TracksModel())->getAllTracks();

        if (empty($tracks)) {
            return Response::error("No tracks found", 404);
        }

        return Response::json($tracks);
    }
}
