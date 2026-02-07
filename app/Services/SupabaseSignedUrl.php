<?php

declare(strict_types=1);

namespace App\Services;

use Supabase\Storage\StorageFile;
use Psr\Http\Message\ResponseInterface;

final class SupabaseSignedUrl
{
    public function createSignedUrl(string $path)
    {
        $file = new StorageFile($_ENV['SUPABASE_API_KEY'] ?? getenv('SUPABASE_API_KEY'), $_ENV['SUPABASE_REFERENCE_ID'] ?? getenv('SUPABASE_REFERENCE_ID'), 'media');

        $result = $file->createSignedUrl($path, 60);

        /** @var ResponseInterface $result */
        $body = (string) $result->getBody();
        $data = json_decode($body, true);

        return ($_ENV["SUPABASE_URL"] ?? getenv('SUPABASE_URL')) . $data["signedURL"];
    }
}
