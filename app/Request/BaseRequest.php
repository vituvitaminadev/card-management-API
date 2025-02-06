<?php

namespace App\Request;

use App\Enum\User\UserTypeEnum;
use App\Exception\Auth\UnauthorizedException;
use App\Model\User;
use Hyperf\Context\Context;
use Hyperf\Validation\Request\FormRequest;

class BaseRequest extends FormRequest
{
    protected bool $onlyAdmin = false;

    public function authorize(): bool
    {
        $this->prepareForValidation();
        $token = Context::get('jwt_token');

        if ($token->type !== UserTypeEnum::ADMIN->value && $this->onlyAdmin) {
            throw new UnauthorizedException();
        }

        return true;
    }

    public function getUser(): User
    {
        $token = Context::get('jwt_token');

        return User::find($token->sub);
    }
}
