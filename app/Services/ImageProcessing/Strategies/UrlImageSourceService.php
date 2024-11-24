<?php

namespace App\Services\ImageProcessing\Strategies;

use App\Exceptions\ImageFetchException;
use Illuminate\Support\Facades\Http;

class UrlImageSourceService implements ImageSourceInterface
{
    private string $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function getImage(): string
    {
        $response = Http::get($this->url);

        if ($response->failed()) {
            throw new ImageFetchException("Failed to fetch image from URL: " . $this->url);

        }

        return $response->body();
    }
}
