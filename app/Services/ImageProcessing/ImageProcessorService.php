<?php

namespace App\Services\ImageProcessing;

use App\Exceptions\ImageProcessingException;
use App\Services\ImageProcessing\Strategies\ImageSourceInterface;
use Illuminate\Support\Facades\Storage;
use Tinify\Tinify;

class ImageProcessorService
{
    private ImageSourceInterface $imageSource;

    public function __construct(ImageSourceInterface $imageSource) {
        $this->imageSource = $imageSource;
    }

    public function processAndStoreImage(): string {
        try {
            $imageData = $this->imageSource->getImage();

            \Tinify\setKey(config('services.tinify.key'));

            $source = \Tinify\fromBuffer($imageData);
            $resized = $source->resize([
                "method" => "cover",
                "width" => 70,
                "height" => 70
            ]);

            $path = 'images/users/'. uniqid(time()) . '.jpg';

            Storage::put($path, $resized->toBuffer());

            return $path;

        } catch (\Tinify\Exception $e) {
            \Log::error('Tinify error: ' . $e->getMessage());
            throw new ImageProcessingException("Error processing image.");
        }
    }
}
