<?php

declare(strict_types=1);

namespace App\Services;

// use Supabase\Storage\StorageFile;
// use Psr\Http\Message\ResponseInterface;

final class SupabaseSignedUrl
{
    // public function createSignedUrl(string $path)
    // {
    //     $file = new StorageFile($_ENV['SUPABASE_API_KEY'] ?? getenv('SUPABASE_API_KEY'), $_ENV['SUPABASE_REFERENCE_ID'] ?? getenv('SUPABASE_REFERENCE_ID'), 'media');

    //     $result = $file->createSignedUrl($path, 3600);

    //     /** @var ResponseInterface $result */
    //     $body = (string) $result->getBody();
    //     $data = json_decode($body, true);

    //     return ($_ENV["SUPABASE_URL"] ?? getenv('SUPABASE_URL')) . '/storage/v1' . $data["signedURL"];
    // }

    public function createSignedUrl(string $path): string
    {
        $bucket = 'media';

        $url = ($_ENV['SUPABASE_URL'] ?? getenv('SUPABASE_URL'))
            . '/storage/v1/object/sign/' . $bucket . '/' . $path;

        $payload = json_encode(['expiresIn' => 3600], JSON_UNESCAPED_SLASHES);

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . ($_ENV['SUPABASE_API_KEY']),
                'apikey: ' . ($_ENV['SUPABASE_API_KEY']),
            ],
            CURLOPT_POSTFIELDS => $payload,
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \RuntimeException('cURL error: ' . curl_error($ch));
        }

        $data = json_decode($response, true);

        if (!isset($data['signedURL'])) {
            throw new \RuntimeException('Supabase error: ' . $response);
        }

        return rtrim($_ENV['SUPABASE_URL'], '/') . '/storage/v1' . $data['signedURL'];
    }
}
