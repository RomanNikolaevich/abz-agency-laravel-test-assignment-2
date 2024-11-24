<?php

namespace App\Services\ImageProcessing\Strategies;

use App\Exceptions\ImageFetchException;

class UploadedImageSourceService implements ImageSourceInterface
{
    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function getImage(): string {
        if (!file_exists($this->file->getPathname())) {
            throw new ImageFetchException("Uploaded file does not exist: " . $this->file->getClientOriginalName());
        }

        return file_get_contents($this->file->getPathname());
    }
}
