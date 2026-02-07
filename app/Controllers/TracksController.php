<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\TracksModel;
use App\Services\SupabaseSignedUrl;
use Core\Response;

final class TracksController
{
    public function getAllTracks()
    {
        $tracks = (new TracksModel())->getAllTracks();

        if (empty($tracks)) {
            return Response::error("No tracks found", 404);
        }

        $signer = new SupabaseSignedUrl();

        $tracks_with_signed_url = array_map(function ($track) use ($signer) {
            $track['audioPath'] = $signer->createSignedUrl($track['audioPath']);
            $track['previewPath'] = $signer->createSignedUrl($track['previewPath']);

            return $track;
        }, $tracks);

        return Response::json($tracks_with_signed_url);
    }
}
