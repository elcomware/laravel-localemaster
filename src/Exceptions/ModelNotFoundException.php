<?php

namespace Elcomware\LocaleMaster\Exceptions;

class ModelNotFoundException extends \Exception
{
    public function __construct(string $model)
    {
        $message = "The model : '{$model}' does not exist. Please create it.";
        $code = ExceptionCodes::MODEL_NOTFOUND;

        parent::__construct($message, $code);
    }
}
