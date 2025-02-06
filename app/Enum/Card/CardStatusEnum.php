<?php

namespace App\Enum\Card;

use App\Trait\EnumTrait;

enum CardStatusEnum: string
{
    use EnumTrait;

    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case CANCELED = 'canceled';
}
