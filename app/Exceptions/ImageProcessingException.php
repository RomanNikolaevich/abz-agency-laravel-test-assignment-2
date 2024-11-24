<?php

namespace App\Exceptions;

use Exception;

class ImageProcessingException extends Exception
{
    public function __construct($message = "Error processing the image.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
