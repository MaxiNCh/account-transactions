<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class UnprocessableTransactionException extends ConflictHttpException
{
    public function __construct()
    {
        parent::__construct('Unprocessable transaction');
    }
}
