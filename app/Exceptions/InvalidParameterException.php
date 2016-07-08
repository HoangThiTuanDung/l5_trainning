<?php
namespace App\Exceptions;

class InvalidParameterException extends CustomException
{
    public function invalidParam($message, $statusCode)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
    }
}
