<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CustomException extends HttpException{

    protected $message;
    protected $statusCode;

    public function __construct($statusCode, $message)
    {
        parent::__construct();
        $this->statusCode = $statusCode;
        $this->message = $message;

    }
}
