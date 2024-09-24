<?php

namespace Elcomware\LocaleMaster\Exceptions;

class NotFoundException extends \Exception
{
    protected $code; // Optional: if you want to define a custom code

    protected int $httpStatusCode; // Optional: if you want to set HTTP status codes

    public function __construct(string $message, int $code = 0, int $httpStatusCode = 400, ?\Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
}
