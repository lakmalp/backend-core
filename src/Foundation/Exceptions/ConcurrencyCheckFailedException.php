<?php

namespace Premialabs\Foundation\Exceptions;

use Exception;

class ConcurrencyCheckFailedException extends Exception
{
    public function __construct($model = null)
    {
        parent::__construct(json_encode(["err" => ["Data has been modified already. Please reload and try again."]]));
    }
}
