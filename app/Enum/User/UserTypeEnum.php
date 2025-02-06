<?php

namespace App\Enum\User;

use App\Trait\EnumTrait;

enum UserTypeEnum: string
{
    use EnumTrait;

    case COMMON = 'common';
    case ADMIN = 'admin';
}
