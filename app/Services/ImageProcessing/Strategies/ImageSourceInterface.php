<?php

namespace App\Services\ImageProcessing\Strategies;

interface ImageSourceInterface
{
    public function getImage(): string;
}
