<?php

namespace App\Request\User;

use App\Request\BaseRequest;

class ListUserRequest extends BaseRequest
{
    protected bool $onlyAdmin = true;

    public function rules(): array
    {
        return [];
    }
}
