<?php

namespace App\Exception\Card;

use App\Enum\ExceptionMessageCodeEnum;
use App\Exception\AbstractException;
use Swoole\Http\Status;

class CardNotFoundException extends AbstractException
{
    public function __construct()
    {
        $code = Status::NOT_FOUND;
        $message = ExceptionMessageCodeEnum::CARD_NOT_FOUND;
        parent::__construct($message, $code);
    }
}
